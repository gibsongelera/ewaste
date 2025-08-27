<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Disposes_crud extends CI_Controller {
    public function __construct() {
        parent::__construct();
        // Only allow logged-in collectors
        if (!$this->session->userdata('logged_in') || $this->session->userdata('role') !== 'collector') {
            redirect('login');
        }
        $this->load->model('Query_model', 'qm');
    }

    // Mark a dispose as paid
    public function markPaid($transaction_code) {
        $this->db->where('transaction_code', $transaction_code);
        $this->db->update('transaction', ['payment_status' => 1]);
        redirect('collector/disposes');
    }

    // Approve a dispose
    public function approve($transaction_code) {
    $this->db->where('transaction_code', $transaction_code);
    $this->db->update('transaction', ['transaction_status' => 2, 'hidden' => 1]); // 2 = Collected/Approved, hide pin
    redirect('collector/disposes');
    }

    // Mark a dispose as collected
    public function markCollected($transaction_code) {
    $this->db->where('transaction_code', $transaction_code);
    $this->db->update('transaction', ['transaction_status' => 2, 'hidden' => 1]);
    redirect('collector/disposes');
    }

    // Delete a dispose
    public function delete($transaction_code) {
        $this->db->where('transaction_code', $transaction_code);
        $this->db->delete('transaction');
        redirect('collector/disposes');
    }

    // View more details
    public function view($transaction_code) {
        $this->load->model('Query_model', 'qm');
        // Fetch dispose details from transaction table
        $dispose = $this->db->get_where('transaction', array('transaction_code' => $transaction_code))->row_array();
        if (!$dispose) {
            $dispose = [];
        }
        // Fetch gadgets/items for this dispose
        $gadgets = [];
        if (isset($dispose['transaction_id'])) {
            $this->db->select('gadgets.gadget_name, gadgets.gadget_price, disposes.quantity');
            $this->db->from('disposes');
            $this->db->join('gadgets', 'gadgets.gadget_id = disposes.gadget_id');
            $this->db->where('disposes.transaction_id', $dispose['transaction_id']);
            $gadgets = $this->db->get()->result_array();
        }
        $dispose['gadgets'] = $gadgets;
        $this->load->view('backend/collector/dispose_view', compact('dispose'));
    }
}
