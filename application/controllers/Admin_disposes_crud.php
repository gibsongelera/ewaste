<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_disposes_crud extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Load session library
        $this->load->library('session');
        // Only allow logged-in admins
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'admin') {
            redirect('login');
        }
        $this->load->model('Query_model', 'qm');
    }

    // Mark a dispose as paid
    public function markPaid($transaction_code) {
        $this->db->where('transaction_code', $transaction_code);
        $this->db->update('transaction', ['payment_status' => 1]);
        redirect('admin/disposes');
    }

    // Approve a dispose
    public function approve($transaction_code) {
        $this->db->where('transaction_code', $transaction_code);
        $this->db->update('transaction', ['transaction_status' => 2]); // 2 = Collected/Approved
        redirect('admin/disposes');
    }

    // Mark a dispose as collected
    public function markCollected($transaction_code) {
    $this->db->where('transaction_code', $transaction_code);
    $this->db->update('transaction', ['transaction_status' => 2, 'hidden' => 1]);
    redirect('admin/disposes');
    }

    // Delete a dispose
    public function delete($transaction_code) {
        $this->db->where('transaction_code', $transaction_code);
        $this->db->delete('transaction');
        redirect('admin/disposes');
    }

    // View more details
    public function view($transaction_code) {
        $data = [];
        $data['dispose'] = $this->qm->disposes('adminQuerySpecificDisposes', $transaction_code);
        $this->load->view('backend/admin/dispose_view', $data);
    }
}
