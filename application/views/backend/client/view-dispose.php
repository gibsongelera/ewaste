<?php
// Use $dispose array from controller
if (isset($dispose) && is_array($dispose) && count($dispose) > 0) {
    $transaction_id = $dispose['transaction_id'] ?? '';
    $transaction_code = $dispose['transaction_code'] ?? '';
    $name = $dispose['name'] ?? '';
    $email = $dispose['email'] ?? '';
    $phone = $dispose['phone'] ?? '';
    $location = $dispose['location'] ?? '';
    $who = $dispose['who'] ?? '';
    $collection_date = $dispose['collection_date'] ?? '';
    $description = $dispose['description'] ?? '';
    $date_created = $dispose['date_created'] ?? '';
    $transaction_status = $dispose['transaction_status'] ?? '';
    $countGadgets = isset($dispose['gadgets']) ? count($dispose['gadgets']) : 0;
    $gadgets = isset($dispose['gadgets']) ? $dispose['gadgets'] : [];
} else {
    $transaction_id = '';
    $transaction_code = '';
    $name = '';
    $email = '';
    $phone = '';
    $location = '';
    $who = '';
    $collection_date = '';
    $description = '';
    $date_created = '';
    $transaction_status = '';
    $countGadgets = 0;
    $gadgets = [];
}
?>
<div class="row">
    <div class="col-xs-12 col-md-3">
        <div class="row">
            <div class="col-sm-12">
                <div class="panel-group bottommargin_0" id="contact-info-accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="icon-tab" data-toggle="collapse" data-parent="#contact-info-accordion" href="#user-info-collapse1">
                                    <i class="highlight fontsize_16 fa fa-phone"></i>
                                    <b>Overview</b>
                                </a>
                            </h4>
                        </div>
                        <div id="user-info-collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <table>
                                    <tr>
                                        <td><b>Status:</b></td>
                                        <td>
                                            <?php if($transaction_status==0){ ?>
                                                <span class="label label-warning"><i class="fa fa-check-circle-o"></i> Pending</span>
                                            <?php }elseif($transaction_status==1){?>
                                                <span class="label label-primary"><i class="fa fa-clock-o"></i> Scheduled</span>
                                            <?php }else{?>
                                                <span class="label label-default"><i class="fa fa-check"></i> Collected</span>
                                            <?php }?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-md-9">
        <h4>Client Info</h4>
        <ul class="list1 no-bullets">
            <li><b>Client:</b> <?php echo ucwords($name) ?></li>
            <li><b>Email:</b> <?php echo $email ?></li>
            <li><b>Phone:</b> <?php echo $phone ?></li>
            <li><b>Category:</b> <?php echo ($who=="1" ? "Individual" : "Business") ?></li>
            <li><b>Location:</b> <?php echo $location ?></li>
        </ul>
        <h4>Dispose info</h4>
        <ul class="list1 no-bullets">
            <li><b>Dispose id:</b> <?php echo $transaction_code; ?></li>
            <li><b>Total Disposed:</b> <?php echo $countGadgets; ?></li>
            <li><b>Creation Date:</b> <?php echo (is_numeric($date_created) && $date_created > 0) ? date("m/d/Y", $date_created) : "-"; ?></li>
            <li><b>Collection Date:</b> <?php echo (is_numeric($collection_date) && $collection_date > 0) ? date("m/d/Y", $collection_date) : "-"; ?></li>
        </ul>
        <h4>Gadgets</h4>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-right">#</th>
                    <th class="text-center">Garbage</th>
                    <!-- <th class="text-right">Price ()</th> -->
                    <th class="text-right">Quantity</th>
                    <!-- <th class="text-right">Sub Total</th> -->
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($gadgets)) { $i=1; foreach($gadgets as $row): ?>
                <tr>
                    <td class="text-right"><?php echo $i++ ?>.</td>
                    <td class="text-center"><?php echo $row['gadget_name'] ?></td>
                    <!-- <td class="text-right"><?php echo isset($row['gadget_price']) ? number_format($row['gadget_price'],2) : ''; ?></td> -->
                    <td class="text-right"><?php echo $row['quantity']  ?></td>
                    <!-- <td class="text-right"><?php echo isset($row['gadget_price']) ? number_format($row['gadget_price']*$row['quantity'],2) : ''; ?></td> -->
                </tr>
                <?php endforeach; } ?>
                <!-- <tr>
                    <td colspan="4" class="text-right">
                        <b>Total Price ()</b>
                    </td>
                    <td class="text-right"><b><?php echo isset($gadgets[0]['gadget_price']) ? number_format(array_sum(array_map(function($g){return $g['gadget_price']*$g['quantity'];},$gadgets)),2) : '0.00'; ?></b></td>
                </tr> -->
            </tbody>
        </table>
    </div>
</div>