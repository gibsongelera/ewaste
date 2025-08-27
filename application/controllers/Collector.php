<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Collector extends CI_Controller {
    // Show collector profile page
    public function profile() {
        $collector_id = $this->session->userdata('id');
        $collector = $this->db->get_where('login', array('login_id' => $collector_id))->row();
        $data = array(
            'collector' => $collector
        );
        $this->load->view('backend/collector/profile', $data);
    }

    // Show collector settings page
    public function settings() {
        $settings = $this->db->get_where('settings', array('setting_id' => 1))->row();
        $data = array(
            'settings' => $settings
        );
        $this->load->view('backend/collector/settings', $data);
    }
    public function __construct(){
        parent::__construct();
        $this->load->library('session');
        $this->load->database();
        $this->load->model('Query_model', 'qm');
        // Check if user is logged in and is collector
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'collector') {
            redirect('login');
        }
    }


    // Collector dashboard: pass collector-specific data to dashboard view
    public function dashboard() {
        $collector_id = $this->session->userdata('id');
        $collector = $this->db->get_where('login', array('login_id' => $collector_id))->row();
        $profile_image = base_url('uploads/user_image/' . $collector_id . '.jpg');
        if (!file_exists(FCPATH.'uploads/user_image/' . $collector_id . '.jpg')) {
            $profile_image = base_url('uploads/temp.jpg');
        }
        $page_data = array(
            'page_name'  => 'dashboard',
            'crumb'  => '1',
            'page_title' => 'Collector Dashboard',
            'total_clients' => $this->qm->clients('countClients'),
            'total_gadgets' => $this->qm->gadgets('countGadgets'),
            'approved_earnings' => $this->qm->payments('ClientApprovedPayments'),
            'pending_earnings' => $this->qm->payments('ClientPendingPayments'),
            'approved_disposes' => $this->qm->disposes('ClientApprovedDisposes'),
            'pending_disposes' => $this->qm->disposes('ClientPendingDisposes'),
            'logs_query' => $this->qm->queryLogs('client'),
            'calendar_events' => [],
            'profile_image' => $profile_image,
            'collector_name' => isset($collector->name) ? $collector->name : '',
            'collector_role' => 'Collector',
        );
        $this->load->view('backend/collector/dashboard', $page_data, 'refresh');
    }

    public function map() {
        $pins = [];
        $disposes = $this->qm->disposes('clientQueryDisposes');
        foreach ($disposes as $dispose) {
            if (!empty($dispose['lat']) && !empty($dispose['lng'])) {
                $pins[] = [
                    'lat' => $dispose['lat'],
                    'lng' => $dispose['lng'],
                    'address' => $dispose['address'] ?? '',
                    'transaction_code' => $dispose['transaction_code'] ?? '',
                    'name' => $dispose['name'] ?? ''
                ];
            }
        }
        $data = [ 'pins' => $pins ];
        $this->load->view('backend/collector/map', $data);
    }

    public function get_pins() {
        $this->load->model('Query_model', 'qm');
        $pins = [];
        $disposes = $this->qm->disposes('clientQueryDisposes');
        foreach ($disposes as $dispose) {
            if (!empty($dispose['lat']) && !empty($dispose['lng'])) {
                $pins[] = [
                    'lat' => $dispose['lat'],
                    'lng' => $dispose['lng'],
                    'address' => $dispose['address'] ?? '',
                    'transaction_code' => $dispose['transaction_code'] ?? '',
                    'name' => $dispose['name'] ?? ''
                ];
            }
        }
        header('Content-Type: application/json');
        echo json_encode($pins);
    }

    public function disposes() {
        $this->load->model('Query_model', 'qm');
        // Show all disposes for collector, like admin (including hidden/collected)
        $getAllDispose = $this->qm->disposes('adminQueryDisposesAll');
        $getClientDisposeApproved = [];
        $getClientDisposePending = [];
        $getClientDisposeCollected = [];
        foreach ($getAllDispose as $row) {
            if (isset($row['transaction_status']) && ($row['transaction_status'] == 1 || $row['transaction_status'] == 2)) {
                $getClientDisposeCollected[] = $row;
            }
            if (isset($row['payment_status']) && $row['payment_status'] == 1 && $row['transaction_status'] == 0) {
                $getClientDisposeApproved[] = $row;
            }
            if (isset($row['payment_status']) && $row['payment_status'] == 0 && $row['transaction_status'] == 0) {
                $getClientDisposePending[] = $row;
            }
        }
        $data = [
            'getClientDispose' => $getAllDispose,
            'getAdminDisposeApproved' => $getClientDisposeApproved,
            'getAdminDisposePending' => $getClientDisposePending,
            'getClientDisposeCollected' => $getClientDisposeCollected,
        ];
        $this->load->view('backend/collector/disposes', $data);
    }
    // Restrict all other views
    public function __call($method, $params) {
        show_error('Unauthorized access', 403);
    }
}
