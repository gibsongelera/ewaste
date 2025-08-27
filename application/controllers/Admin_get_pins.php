<?php
// Controller endpoint to return all pin locations for admin map
// URL: /admin/get_pins

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_get_pins extends CI_Controller {
    // ...existing code...
    public function get_pins() {
        $this->load->model('Query_model', 'qm');
        $pins = array();
        $disposes = $this->qm->disposes('adminQueryDisposes');
        $debug = [];
        foreach ($disposes as $dispose) {
            $isCollected = isset($dispose['transaction_status']) && (string)$dispose['transaction_status'] === '2';
            $debug[] = [
                'transaction_code' => $dispose['transaction_code'] ?? '',
                'lat' => $dispose['lat'] ?? '',
                'lng' => $dispose['lng'] ?? '',
                'transaction_status' => $dispose['transaction_status'] ?? '',
                'isCollected' => $isCollected ? 'yes' : 'no'
            ];
            if (
                !empty($dispose['lat']) &&
                !empty($dispose['lng']) &&
                !$isCollected
            ) {
                $pins[] = [
                    'lat' => $dispose['lat'],
                    'lng' => $dispose['lng'],
                    'address' => $dispose['address'] ?? ($dispose['location'] ?? ''),
                    'transaction_code' => $dispose['transaction_code'] ?? '',
                    'name' => $dispose['name'] ?? ''
                ];
            }
        }
    // Output debug info to browser console (disabled for AJAX/JSON)
        header('Content-Type: application/json');
        echo json_encode($pins);
    }

        // Manual delete pin endpoint
        public function delete_pin() {
            $transaction_code = $this->input->post('transaction_code');
            if (!$transaction_code) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Missing transaction_code']);
                return;
            }
            $this->load->model('Query_model', 'qm');
            $result = $this->qm->hide_pin_by_code($transaction_code);
            header('Content-Type: application/json');
            if ($result) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Hide failed']);
            }
        }
    // ...existing code...
}
