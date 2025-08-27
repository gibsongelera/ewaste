<?php
// Disposes Table for Collector/Admin
$page_name = isset($page_name) ? $page_name : 'disposes';
?>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Dispose_id</th>
            <th>Summary</th>
            <th>Collection Date</th>
            <th>Payment</th>
            <th>Stage</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        // Show all disposes (pending + approved)
        if (isset($getClientDispose) && is_array($getClientDispose)) {
            foreach ($getClientDispose as $row):
                $transaction_id = $row['transaction_id'];
                $transaction_code = $row['transaction_code'];
                $payment_status = $row['payment_status'];
                $transaction_status = $row['transaction_status'];
                $transaction_total = $row['transaction_total'];
                $collection_date = $row['collection_date'];
                $name = $row['name'];
                $phone = $row['phone'];
        ?>
        <tr>
            <td><?php echo $i++; ?>.</td>
            <td><a href="<?php echo base_url()?>collector/disposes/view/<?php echo $transaction_code ?>"><b><?php echo $transaction_code; ?></b></a></td>
            <td>
                <b>Client:</b> <?php echo ucwords($name)?><br>
                <b>Phone:</b> <?php echo $phone ?><br>
                <b>Gadgets:</b> <?php echo $this->qm->disposes('countDisposes',$transaction_id)?>
            </td>
            <td><?php echo date("m/d/Y",$collection_date) ?></td>
            <td>
                <b>Amount ():</b> <?php echo $this->qm->formatMoney($transaction_total,true); ?><br>
                <b>Status:</b>
                <?php if($payment_status==0){ ?>
                    <span class="label label-danger"><i class="rt-icon2-close"></i> Unconfirmed</span>
                <?php }else{?>
                    <span class="label label-success"><i class="rt-icon2-check"></i> Paid</span>
                <?php }?>
            </td>
            <td>
                <?php if($transaction_status==0){ ?>
                    <span class="label label-warning"><i class="fa fa-check-circle-o"></i> Pending</span>
                <?php }else{?>
                    <span class="label label-default"><i class="fa fa-check"></i> Collected</span>
                <?php }?>
            </td>
            <td>
                <div class="btn-group">
                    <div class="dropdown">
                        <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true">
                            Action
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="<?php echo base_url();?>collector/disposes/view/<?php echo $transaction_code ?>">
                                    <i class="fa fa-angle-double-right"></i> View More
                                </a>
                            </li>
                            <?php if($payment_status==0){ ?>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="showPaidModal('<?php echo base_url();?>collector/disposes_crud/markPaid/<?php echo $transaction_code;?>')">
                                    <i class="fa fa-angle-double-right"></i> Mark Paid (Collector)
                                </a>
                            </li>
                            <?php } ?>
                            <?php if($payment_status==1 && $transaction_status==0){ ?>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="showApproveModal('<?php echo base_url();?>collector/disposes_crud/approve/<?php echo $transaction_code;?>')">
                                    <i class="fa fa-angle-double-right"></i> Approve (Collector)
                                </a>
                            </li>
                            <?php } ?>
                            <?php if($transaction_status==1){ ?>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="showCollectModal('<?php echo base_url();?>collector/disposes_crud/markCollected/<?php echo $transaction_code;?>')">
                                    <i class="fa fa-angle-double-right"></i> Mark Collected
                                </a>
                            </li>
                            <?php } ?>
                            <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="confirm_modal('<?php echo base_url();?>collector/disposes_crud/delete/<?php echo $transaction_code;?>')">
                                    <i class="fa fa-angle-double-right"></i> Delete?
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </td>
        </tr>
        <?php
            endforeach;
        }
        ?>
    </tbody>
</table>

<!-- Paid Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="paymentModalLabel">Mark as Paid</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        Are you sure you want to mark this dispose as paid?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a id="paymentModalConfirm" href="#" class="btn btn-success">Mark Paid</a>
      </div>
    </div>
  </div>
</div>
<script>
function showPaidModal(url) {
  $('#paymentModalConfirm').attr('href', url);
  $('#paymentModal').modal('show');
}
function markPaidCollector(dispose_id) {
    if(confirm('Mark this dispose as paid?')) {
        window.location.href = '<?php echo base_url("collector/disposes_crud/markPaid/"); ?>' + dispose_id;
    }
}
function approveCollector(dispose_id) {
    var approveUrl = '<?php echo base_url("collector/disposes_crud/approve/"); ?>' + dispose_id;
    showApproveModal(approveUrl);
}
function markPaidAdmin(dispose_id) {
    var paidUrl = '<?php echo base_url("admin/disposes_crud/markPaid/"); ?>' + dispose_id;
    showPaidModal(paidUrl);
}
function approveAdmin(dispose_id) {
    var approveUrl = '<?php echo base_url("admin/disposes_crud/approve/"); ?>' + dispose_id;
    showApproveModal(approveUrl);
}
function markCollectedCollector(dispose_id) {
    var collectUrl = '<?php echo base_url("collector/disposes_crud/markCollected/"); ?>' + dispose_id;
    showCollectModal(collectUrl);
}
function markCollectedAdmin(dispose_id) {
    var collectUrl = '<?php echo base_url("admin/disposes_crud/markCollected/"); ?>' + dispose_id;
}
function deleteDispose(dispose_id) {
    var deleteUrl = '<?php echo base_url("collector/disposes_crud/delete/"); ?>' + dispose_id;
    confirm_modal(deleteUrl);
}
function viewDispose(dispose_id) {
    window.location.href = '<?php echo base_url("collector/disposes/view/"); ?>' + dispose_id;
}
</script>

<?php $this->load->view('modal', ['page_name' => $page_name]); ?>