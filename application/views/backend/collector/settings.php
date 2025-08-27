<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
  <div class="col-md-12">
    <h3 class="dashboard-page-title">Collector Settings</h3>
    <p class="text-muted">Manage system settings and preferences</p>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="with_border with_padding">
      <h3 class="module-title darkgrey_bg_color">System Information</h3>
      <div class="row">
        <div class="col-sm-6">
          <p><strong>System Name:</strong></p>
          <p class="text-muted">E-Waste Management System</p>
        </div>
        <div class="col-sm-6">
          <p><strong>Version:</strong></p>
          <p class="text-muted">1.0.0</p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <p><strong>Current User:</strong></p>
          <p class="text-muted"><?php echo ucwords($this->session->userdata('name')); ?></p>
        </div>
        <div class="col-sm-6">
          <p><strong>Role:</strong></p>
          <p class="text-muted"><?php echo ucwords($this->session->userdata('role')); ?></p>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-6">
          <p><strong>Last Login:</strong></p>
          <p class="text-muted"><?php echo date('M d, Y g:i A'); ?></p>
        </div>
        <div class="col-sm-6">
          <p><strong>Session ID:</strong></p>
          <p class="text-muted"><?php echo session_id(); ?></p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-6">
    <div class="with_border with_padding">
      <h3 class="module-title darkgrey_bg_color">Quick Statistics</h3>
      <div class="row">
        <div class="col-sm-6">
          <div class="teaser info_bg_color text-center">
            <h3><?php echo isset($total_clients) ? $total_clients : 0; ?></h3>
            <p>Total Clients</p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="teaser success_bg_color text-center">
            <h3><?php echo isset($approved_disposes) ? $approved_disposes : 0; ?></h3>
            <p>Approved Disposes</p>
          </div>
        </div>
      </div>
      <div class="row" style="margin-top: 15px;">
        <div class="col-sm-6">
          <div class="teaser warning_bg_color text-center">
            <h3><?php echo isset($pending_disposes) ? $pending_disposes : 0; ?></h3>
            <p>Pending Disposes</p>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="teaser danger_bg_color text-center">
            <h3><?php echo isset($total_gadgets) ? $total_gadgets : 0; ?></h3>
            <p>Total Gadgets</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row" style="margin-top: 30px;">
  <div class="col-md-12">
    <div class="with_border with_padding">
      <h3 class="module-title darkgrey_bg_color">System Status</h3>
      <div class="row">
        <div class="col-md-3">
          <div class="text-center">
            <i class="fa fa-database fa-3x text-success"></i>
            <h4>Database</h4>
            <p class="text-success">Connected</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="text-center">
            <i class="fa fa-map-marker fa-3x text-info"></i>
            <h4>Maps API</h4>
            <p class="text-info">Active</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="text-center">
            <i class="fa fa-users fa-3x text-warning"></i>
            <h4>User Sessions</h4>
            <p class="text-warning">Active</p>
          </div>
        </div>
        <div class="col-md-3">
          <div class="text-center">
            <i class="fa fa-shield fa-3x text-danger"></i>
            <h4>Security</h4>
            <p class="text-danger">Protected</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>