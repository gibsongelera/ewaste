<?php
// Disposes Table for Collector/Admin
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
    foreach ($getAdminDisposePending as $row):
        ?>
        <tr>
            <td><?php echo $i++; ?>.</td>
            <td><?php echo $row['dispose_id'] ?? 'N/A'; ?></td>
            <td>
                Client: <?php echo $row['client_name'] ?? 'N/A'; ?><br>
                Phone: <?php echo $row['client_phone'] ?? 'N/A'; ?><br>
                Garbages: <?php echo $row['gadget_count'] ?? '0'; ?>
            </td>
            <td><?php echo isset($row['collection_date']) ? date('m/d/Y', strtotime($row['collection_date'])) : 'N/A'; ?></td>
            <td>Amount (₱): <?php echo isset($row['amount']) ? number_format((float)$row['amount'], 2) : '0.00'; ?></td>
            <td>Status: <?php echo $row['status'] ?? 'N/A'; ?></td>
            <td>
                <button class="btn btn-info btn-xs" onclick="viewDispose('<?php echo $row['dispose_id'] ?? ''; ?>')">View More</button>
                <?php if(isset($is_admin) && $is_admin): ?>
                <button class="btn btn-success btn-xs" onclick="markPaidAdmin('<?php echo $row['dispose_id'] ?? ''; ?>')">Mark Paid (Admin)</button>
                <button class="btn btn-primary btn-xs" onclick="approveAdmin('<?php echo $row['dispose_id'] ?? ''; ?>')">Approve (Admin)</button>
                <?php else: ?>
                <button class="btn btn-success btn-xs" onclick="markPaidCollector('<?php echo $row['dispose_id'] ?? ''; ?>')">Mark Paid (Collector)</button>
                <button class="btn btn-primary btn-xs" onclick="approveCollector('<?php echo $row['dispose_id'] ?? ''; ?>')">Approve (Collector)</button>
                <?php endif; ?>
                <button class="btn btn-danger btn-xs" onclick="deleteDispose('<?php echo $row['dispose_id'] ?? ''; ?>')">Delete?</button>
            </td>
        </tr>
    <?php endforeach; ?>
    <?php foreach ($getAdminDisposeApproved as $row): ?>
        <tr>
            <td><?php echo $i++; ?>.</td>
            <td><?php echo $row['dispose_id'] ?? 'N/A'; ?></td>
            <td>
                Client: <?php echo $row['client_name'] ?? 'N/A'; ?><br>
                Phone: <?php echo $row['client_phone'] ?? 'N/A'; ?><br>
                Garbages: <?php echo $row['gadget_count'] ?? '0'; ?>
            </td>
            <td><?php echo isset($row['collection_date']) ? date('m/d/Y', strtotime($row['collection_date'])) : 'N/A'; ?></td>
            <td>Amount (₱): <?php echo isset($row['amount']) ? number_format((float)$row['amount'], 2) : '0.00'; ?></td>
            <td>Status: <?php echo $row['status'] ?? 'N/A'; ?></td>
            <td>
                <button class="btn btn-info btn-xs" onclick="viewDispose('<?php echo $row['dispose_id'] ?? ''; ?>')">View More</button>
                <?php if(isset($is_admin) && $is_admin): ?>
                <button class="btn btn-success btn-xs" onclick="markPaidAdmin('<?php echo $row['dispose_id'] ?? ''; ?>')">Mark Paid (Admin)</button>
                <button class="btn btn-warning btn-xs" onclick="markCollectedAdmin('<?php echo $row['dispose_id'] ?? ''; ?>')">Mark Collected (Admin)</button>
                <?php else: ?>
                <button class="btn btn-warning btn-xs" onclick="markCollectedCollector('<?php echo $row['dispose_id'] ?? ''; ?>')">Mark Collected (Collector)</button>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
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
    if(confirm('Mark this dispose as collected?')) {
        window.location.href = '<?php echo base_url("collector/disposes_crud/markCollected/"); ?>' + dispose_id;
    }
}
function markCollectedAdmin(dispose_id) {
    var collectUrl = '<?php echo base_url("admin/disposes_crud/markCollected/"); ?>' + dispose_id;
    showCollectModal(collectUrl);
}
function deleteDispose(dispose_id) {
    if(confirm('Delete this dispose?')) {
        window.location.href = '<?php echo base_url("collector/disposes_crud/delete/"); ?>' + dispose_id;
    }
}
function viewDispose(dispose_id) {
    window.location.href = '<?php echo base_url("collector/view_dispose/"); ?>' + dispose_id;
}
</script>

<?php $this->load->view('modal'); ?>