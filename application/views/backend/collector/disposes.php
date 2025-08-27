<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
  <div class="col-md-12">
    <h3 class="dashboard-page-title">Collector Disposes</h3>
    <p class="text-muted">Manage all disposal requests and collections</p>
  </div>
</div>

<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
  <li class="active"><a href="#all" role="tab" data-toggle="tab"><i class="fa fa-list"></i> All Disposes</a></li>
  <li><a href="#approved" role="tab" data-toggle="tab"><i class="fa fa-check"></i> Approved</a></li>
  <li><a href="#pending" role="tab" data-toggle="tab"><i class="fa fa-clock-o"></i> Pending</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content tab-custom top-color-border">
  <!-- All Disposes Tab -->
  <div class="tab-pane fade in active" id="all">
    <div class="row">
      <div class="col-xs-12">
        <div class="with_border with_padding">
          <h4>All Disposes (<?php echo count($getAdminDispose); ?>)</h4>
          <hr>
          <div class="table-responsive">
            <table class="table table-hover" id="allDisposesTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Transaction Code</th>
                  <th>Summary</th>
                  <th>Collection Date</th>
                  <th>Payment Status</th>
                  <th>Transaction Status</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i = 1;
                if(isset($getAdminDispose) && is_array($getAdminDispose)):
                  foreach($getAdminDispose as $dispose): 
                ?>
                <tr>
                  <td><?php echo $i++; ?>.</td>
                  <td>
                    <a href="<?php echo base_url(); ?>collector/disposes/view/<?php echo $dispose['transaction_code']; ?>">
                      <b><?php echo $dispose['transaction_code']; ?></b>
                    </a>
                  </td>
                  <td>
                    <b>Client:</b> <?php echo ucwords($dispose['name']); ?><br>
                    <b>Phone:</b> <?php echo isset($dispose['phone']) ? $dispose['phone'] : 'N/A'; ?><br>
                    <b>Gadgets:</b> <?php echo $this->qm->disposes('countDisposes', $dispose['transaction_id']); ?><br>
                    <b>Amount:</b> ₱<?php echo number_format($dispose['transaction_total'], 2); ?>
                  </td>
                  <td><?php echo date('M d, Y', $dispose['collection_date']); ?></td>
                  <td>
                    <?php if($dispose['payment_status'] == 1): ?>
                      <span class="label label-success"><i class="fa fa-check"></i> Paid</span>
                    <?php else: ?>
                      <span class="label label-warning"><i class="fa fa-clock-o"></i> Pending</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <?php if($dispose['transaction_status'] == 0): ?>
                      <span class="label label-info"><i class="fa fa-info"></i> New</span>
                    <?php elseif($dispose['transaction_status'] == 1): ?>
                      <span class="label label-primary"><i class="fa fa-truck"></i> Collected</span>
                    <?php elseif($dispose['transaction_status'] == 2): ?>
                      <span class="label label-success"><i class="fa fa-check-circle"></i> Completed</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="<?php echo base_url(); ?>collector/disposes/view/<?php echo $dispose['transaction_code']; ?>" 
                       class="btn btn-info btn-sm">
                      <i class="fa fa-eye"></i> View
                    </a>
                    <?php if($dispose['payment_status'] == 0): ?>
                      <button onclick="showApproveModal('<?php echo base_url(); ?>collector/disposes_crud/approve/<?php echo $dispose['transaction_code']; ?>')" 
                              class="btn btn-success btn-sm">
                        <i class="fa fa-check"></i> Approve
                      </button>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php 
                  endforeach; 
                endif;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Approved Disposes Tab -->
  <div class="tab-pane fade" id="approved">
    <div class="row">
      <div class="col-xs-12">
        <div class="with_border with_padding">
          <h4>Approved Disposes (<?php echo count($getAdminDisposeApproved); ?>)</h4>
          <hr>
          <div class="table-responsive">
            <table class="table table-hover" id="approvedDisposesTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Transaction Code</th>
                  <th>Summary</th>
                  <th>Collection Date</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i = 1;
                if(isset($getAdminDisposeApproved) && is_array($getAdminDisposeApproved)):
                  foreach($getAdminDisposeApproved as $dispose): 
                ?>
                <tr>
                  <td><?php echo $i++; ?>.</td>
                  <td>
                    <a href="<?php echo base_url(); ?>collector/disposes/view/<?php echo $dispose['transaction_code']; ?>">
                      <b><?php echo $dispose['transaction_code']; ?></b>
                    </a>
                  </td>
                  <td>
                    <b>Client:</b> <?php echo ucwords($dispose['name']); ?><br>
                    <b>Phone:</b> <?php echo isset($dispose['phone']) ? $dispose['phone'] : 'N/A'; ?><br>
                    <b>Gadgets:</b> <?php echo $this->qm->disposes('countDisposes', $dispose['transaction_id']); ?><br>
                    <b>Amount:</b> ₱<?php echo number_format($dispose['transaction_total'], 2); ?>
                  </td>
                  <td><?php echo date('M d, Y', $dispose['collection_date']); ?></td>
                  <td>
                    <a href="<?php echo base_url(); ?>collector/disposes/view/<?php echo $dispose['transaction_code']; ?>" 
                       class="btn btn-info btn-sm">
                      <i class="fa fa-eye"></i> View
                    </a>
                    <?php if($dispose['transaction_status'] == 0): ?>
                      <button onclick="showCollectModal('<?php echo base_url(); ?>collector/disposes_crud/collect/<?php echo $dispose['transaction_code']; ?>')" 
                              class="btn btn-primary btn-sm">
                        <i class="fa fa-truck"></i> Mark Collected
                      </button>
                    <?php endif; ?>
                  </td>
                </tr>
                <?php 
                  endforeach; 
                endif;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pending Disposes Tab -->
  <div class="tab-pane fade" id="pending">
    <div class="row">
      <div class="col-xs-12">
        <div class="with_border with_padding">
          <h4>Pending Disposes (<?php echo count($getAdminDisposePending); ?>)</h4>
          <hr>
          <div class="table-responsive">
            <table class="table table-hover" id="pendingDisposesTable">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Transaction Code</th>
                  <th>Summary</th>
                  <th>Collection Date</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $i = 1;
                if(isset($getAdminDisposePending) && is_array($getAdminDisposePending)):
                  foreach($getAdminDisposePending as $dispose): 
                ?>
                <tr>
                  <td><?php echo $i++; ?>.</td>
                  <td>
                    <a href="<?php echo base_url(); ?>collector/disposes/view/<?php echo $dispose['transaction_code']; ?>">
                      <b><?php echo $dispose['transaction_code']; ?></b>
                    </a>
                  </td>
                  <td>
                    <b>Client:</b> <?php echo ucwords($dispose['name']); ?><br>
                    <b>Phone:</b> <?php echo isset($dispose['phone']) ? $dispose['phone'] : 'N/A'; ?><br>
                    <b>Gadgets:</b> <?php echo $this->qm->disposes('countDisposes', $dispose['transaction_id']); ?><br>
                    <b>Amount:</b> ₱<?php echo number_format($dispose['transaction_total'], 2); ?>
                  </td>
                  <td><?php echo date('M d, Y', $dispose['collection_date']); ?></td>
                  <td>
                    <a href="<?php echo base_url(); ?>collector/disposes/view/<?php echo $dispose['transaction_code']; ?>" 
                       class="btn btn-info btn-sm">
                      <i class="fa fa-eye"></i> View
                    </a>
                    <button onclick="showApproveModal('<?php echo base_url(); ?>collector/disposes_crud/approve/<?php echo $dispose['transaction_code']; ?>')" 
                            class="btn btn-success btn-sm">
                      <i class="fa fa-check"></i> Approve
                    </button>
                  </td>
                </tr>
                <?php 
                  endforeach; 
                endif;
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function showApproveModal(url) {
  jQuery('#approveModal').modal('show', {backdrop: 'static'});
  document.getElementById('approve_link').setAttribute('href', url);
}

function showCollectModal(url) {
  jQuery('#collectModal').modal('show', {backdrop: 'static'});
  document.getElementById('collect_link').setAttribute('href', url);
}

// Initialize DataTables
$(document).ready(function() {
  $('#allDisposesTable').DataTable();
  $('#approvedDisposesTable').DataTable();
  $('#pendingDisposesTable').DataTable();
});
</script>

<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="approveModalLabel">Approve Dispose</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to approve this dispose?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a id="approve_link" href="#" class="btn btn-success">Approve</a>
      </div>
    </div>
  </div>
</div>

<!-- Collect Modal -->
<div class="modal fade" id="collectModal" tabindex="-1" role="dialog" aria-labelledby="collectModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="collectModalLabel">Mark as Collected</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to mark this dispose as collected?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a id="collect_link" href="#" class="btn btn-primary">Mark Collected</a>
      </div>
    </div>
  </div>
</div>