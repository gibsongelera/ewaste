<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
  <div class="col-md-12">
    <h3 class="dashboard-page-title">Collector Logs</h3>
    <p class="text-muted">View all system activity logs</p>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="with_border with_padding">
      <h3 class="module-title darkgrey_bg_color">System Logs</h3>
      <div class="admin-scroll-panel scrollbar-macosx" style="max-height: 600px;">
        <ul class="list1 no-bullets">
          <?php if(isset($logs_query) && is_array($logs_query) && count($logs_query) > 0): ?>
            <?php foreach($logs_query as $log): ?>
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
                  <span class="grey">No logs available</span>
                </div>
              </div>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </div>
</div>