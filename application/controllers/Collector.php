<?php
defined('BASEPATH') OR exit('No direct script access allowed');

#[\AllowDynamicProperties]
class Collector extends CI_Controller {
    
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
        
        $page_data = array(
            'page_name'  => 'dashboard',
            'crumb'  => '1',
            'page_title' => 'Collector Dashboard',
            'total_clients' => $this->qm->clients('countClients'),
            'total_gadgets' => $this->qm->gadgets('countGadgets'),
            'approved_earnings' => $this->qm->payments('AdminApprovedPayments'),
            'pending_earnings' => $this->qm->payments('AdminPendingPayments'),
            'approved_disposes' => $this->qm->disposes('CountApprovedDisposes'),
            'pending_disposes' => $this->qm->disposes('CountPendingDisposes'),
            'logs_query' => $this->qm->queryLogs('admin'),
            'calendar_events' => $this->getCalendarEvents(),
        );
        $this->load->view('index', $page_data, 'refresh');
    }

    // Show collector profile page
    public function profile() {
        $page_data = array(
            'page_name'  => 'profile',
            'crumb'  => '1',
            'page_title' => 'Collector Profile',
        );
        $this->load->view('index', $page_data, 'refresh');
    }

    // Show collector settings page
    public function settings() {
        $page_data = array(
            'page_name'  => 'settings',
            'crumb'  => '1',
            'page_title' => 'Collector Settings',
        );
        $this->load->view('index', $page_data, 'refresh');
    }

    public function map() {
        $page_data = array(
            'page_name'  => 'map',
            'crumb'  => '1',
            'page_title' => 'Collector Map',
            'pins' => $this->getMapPins(),
        );
        $this->load->view('index', $page_data, 'refresh');
    }

    public function get_pins() {
        $pins = $this->getMapPins();
        header('Content-Type: application/json');
        echo json_encode($pins);
    }

    public function disposes() {
        $page_data = array(
            'page_name'  => 'disposes',
            'crumb'  => '1',
            'page_title' => 'Collector Disposes',
            'getAdminDispose' => $this->qm->disposes('adminQueryDisposesAll'),
            'getAdminDisposeApproved' => $this->qm->disposes('adminApprovedQueryDisposes'),
            'getAdminDisposePending' => $this->qm->disposes('adminPendingQueryDisposes'),
        );
        $this->load->view('index', $page_data, 'refresh');
    }

    public function logs() {
        $page_data = array(
            'page_name'  => 'logs',
            'crumb'  => '1',
            'page_title' => 'Collector Logs',
            'logs_query' => $this->qm->queryLogs('admin'),
        );
        $this->load->view('index', $page_data, 'refresh');
    }

    public function disposes_crud($action = '', $transaction_code = '') {
        if (empty($action) || empty($transaction_code)) {
            redirect('collector/disposes');
        }

        switch ($action) {
            case 'approve':
                $this->db->where('transaction_code', $transaction_code);
                $this->db->update('transaction', ['payment_status' => 1]);
                $this->session->set_flashdata('success', 'Dispose approved successfully');
                break;
                
            case 'collect':
                $this->db->where('transaction_code', $transaction_code);
                $this->db->update('transaction', ['transaction_status' => 1]);
                $this->session->set_flashdata('success', 'Dispose marked as collected');
                break;
                
            case 'delete':
                $this->db->where('transaction_code', $transaction_code);
                $this->db->delete('transaction');
                $this->session->set_flashdata('success', 'Dispose deleted successfully');
                break;
                
            default:
                $this->session->set_flashdata('error', 'Invalid action');
        }
        
        redirect('collector/disposes');
    }

    // Helper method to get map pins
    private function getMapPins() {
        $pins = [];
        $disposes = $this->qm->disposes('adminQueryDisposes');
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
        return $pins;
    }

    // Helper method to get calendar events
    private function getCalendarEvents() {
        $events = [];
        $disposes = $this->qm->disposes('adminQueryDisposes');
        foreach ($disposes as $dispose) {
            if (!empty($dispose['collection_date'])) {
                $events[] = [
                    'title' => 'Dispose ID: ' . $dispose['transaction_code'],
                    'start' => $dispose['collection_date'],
                    'url' => base_url('collector/disposes/view/' . $dispose['transaction_code']),
                    'className' => $dispose['payment_status'] == 1 ? 'fc-green' : 'fc-orange'
                ];
            }
        }
        return $events;
    }

    // Restrict all other views
    public function __call($method, $params) {
        show_error('Unauthorized access', 403);
    }
}
