<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
  <div class="col-md-12">
    <h3 class="dashboard-page-title">Collector Profile</h3>
    <p class="text-muted">Manage your profile information</p>
  </div>
</div>

<div class="row">
  <div class="col-md-6">
    <div class="with_border with_padding">
      <h3 class="module-title darkgrey_bg_color">Profile Information</h3>
      <div class="media">
        <div class="media-left media-middle">
          <img src="<?php echo $this->qm->get_image_url('user', $this->session->userdata('id')); ?>" 
               alt="Profile Image" class="media-object" style="width: 100px; height: 100px; border-radius: 50%;">
        </div>
        <div class="media-body">
          <h4><?php echo ucwords($this->session->userdata('name')); ?></h4>
          <p class="text-muted"><?php echo ucwords($this->session->userdata('role')); ?></p>
          <p><strong>Email:</strong> <?php echo $this->session->userdata('email'); ?></p>
          <p><strong>User ID:</strong> <?php echo $this->session->userdata('id'); ?></p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="col-md-6">
    <div class="with_border with_padding">
      <h3 class="module-title darkgrey_bg_color">Account Statistics</h3>
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
      <h3 class="module-title darkgrey_bg_color">Recent Activity</h3>
      <div class="admin-scroll-panel scrollbar-macosx" style="max-height: 300px;">
        <ul class="list1 no-bullets">
          <?php if(isset($logs_query) && is_array($logs_query) && count($logs_query) > 0): ?>
            <?php foreach(array_slice($logs_query, 0, 10) as $log): ?>
              <li>
                <div class="media small-teaser">
                  <div class="media-left media-middle">
                    <div class="teaser_icon label-success round">
                      <i class="fa fa-check"></i>
                    </div>
                  </div>
                                     <div class="media-body media-left">
                     <span class="grey"><?php echo isset($log['message']) ? $log['message'] : 'No message'; ?></span>
                     <?php if(isset($log['trigger_date'])): ?>
                       <br><small class="text-muted"><?php echo date('M d, Y g:i A', $log['trigger_date']); ?></small>
                     <?php endif; ?>
                   </div>
                </div>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <li>
              <div class="media small-teaser">
                <div class="media-left media-middle">
                  <div class="teaser_icon label-info round">
                    <i class="fa fa-info"></i>
                  </div>
                </div>
                <div class="media-body media-left">
                  <span class="grey">No recent activity</span>
                </div>
              </div>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</div>