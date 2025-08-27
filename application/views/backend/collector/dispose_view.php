<!DOCTYPE html>
<html class="no-js" lang="eng">
<head>
    <title>View Disposes :: E-WASTE</title>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="http://localhost/e-waste-master/components/assets/images/favicon.png">
    <link href="http://localhost/e-waste-master/components/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/e-waste-master/components/assets/css/animations.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/e-waste-master/components/assets/css/fonts.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/e-waste-master/components/assets/css/main.css" rel="stylesheet" type="text/css" />
    <link href="http://localhost/e-waste-master/components/assets/css/datatables/datatable.css" rel="stylesheet" type="text/css" />
    <script src="http://localhost/e-waste-master/components/assets/js/vendor/modernizr-2.6.2.min.js"></script>
    <link href="http://localhost/e-waste-master/components/assets/css/dashboard.css" rel="stylesheet" type="text/css" />
</head>
<body class="admin">
<?php
$CI =& get_instance();
$CI->$load->model('Query_model', 'qm');
$transaction_code = isset($transaction_code) ? $transaction_code : $this->uri->segment(4);
$trans_code = $CI->$db->get_where('transaction', array('transaction_code' => $transaction_code));
if ($trans_code->num_rows() > 0) {
    $row = $trans_code->row();
    $transaction_id = $row->transaction_id;
    $transaction_code = $row->transaction_code;
    $name = $row->name;
    $email = $row->email;
    $phone = $row->phone;
    $location = $row->location;
    $who = $row->who;
    $collection_date = $row->collection_date;
    $description = $row->description;
    $date_created = $row->date_created;
    $transaction_status = $row->transaction_status;
    $oc = "transaction_id=" . $transaction_id;
    $CI->$db->select('*');
    $CI->$db->from('disposes');
    $CI->$db->where($oc);
    $desc = $CI->$db->get()->result_array();
    $countGadgets = count($desc);
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
    $desc = [];
    $countGadgets = 0;
}

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
<div id="canvas">
  <div id="box_wrapper">
    <!-- Sidebar/Header/Breadcrumbs (copy from your template as needed) -->
    <section class="ls with_bottom_border">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <ol class="breadcrumb darklinks">
              <li><a href="javascript:void(0);" style="pointer-events:none; color:inherit;">Homepage</a></li>
              <li><a href="<?php echo base_url('collector/disposes'); ?>">Disposes</a></li>
              <li class="active">View Disposes</li>
            </ol>
          </div>
          <div class="col-md-6 text-md-right">
            <span class="dashboard-daterangepicker">
              <i class="fa fa-calendar"></i>
              <span style="cursor: text;">Wednesday 13, Aug-2025</span>
            </span>
          </div>
        </div>
      </div>
    </section>
    <section class="ls section_padding_top_50 section_padding_bottom_50 columns_padding_10">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4">
            <h3 class="dashboard-page-title">View Disposes</h3>
          </div>
        </div>
        <div class="row">
          <div class="col-md-9">
            <div class="row" id="print">
              <div class="col-xs-12 col-sm-12">
                <div class="with_border with_padding">
                  <div class="row">
                    <div class="col-xs-12 col-sm-12">
                      <div class="media big-left-media">
                        <div class="media-left">
                          <img src="<?php echo base_url('components/assets/images/favicon.png'); ?>" alt="...">
                        </div>
                        <div class="media-body">
                          <div class="row">
                            <div class="col-sm-8">
                              <h4>Dispose id: #<?php echo $transaction_code ?></h4>
                              <p><?php echo $description ?></p>
                            </div>
                            <div class="col-sm-4">
                              
                              <a href="#" title="Print" onclick="printDiv('print')" class="theme_button inverse"><i class="fa fa-print"></i></a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-xs-6 col-sm-6">
                      <h4>Client Info</h4>
                      <!-- Client Info -->
                      <ul class="list1 no-bullets">
                        <li><b>Client:</b> <?php echo ucwords($name) ?></li>
                        <li><b>Email:</b> <?php echo $email ?></li>
                        <li><b>Phone:</b> <?php echo $phone ?></li>
                        <li><b>Category:</b> <?php echo ($who=="1" ? "Individual" : "Business") ?></li>
                        <li><b>Location:</b> <?php echo $location ?></li>
                      </ul>
                    </div>
                    <div class="col-xs-6 col-sm-6">
                      <h4>Dispose info</h4>
                      <!-- Dispose Info -->
                      <ul class="list1 no-bullets">
                        <li><b>Dispose id:</b> <?php echo $transaction_code; ?></li>
                        <li><b>Total Disposed:</b> <?php echo $countGadgets; ?></li>
                        <li><b>Creation Date:</b> <?php echo (is_numeric($date_created) && $date_created > 0) ? date("m/d/Y", $date_created) : "-"; ?></li>
                        <li><b>Collection Date:</b> <?php echo (is_numeric($collection_date) && $collection_date > 0) ? date("m/d/Y", $collection_date) : "-"; ?></li>
                      </ul>
                    </div>
                  </div>
                  <!-- Table of Gadgets -->
                  <div class="row">
                    <div class="col-xs-12 col-sm-12">
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
                            <!-- <td class="text-right"><?php echo number_format($row['gadget_price'],2); ?></td> -->
                            <td class="text-right"><?php echo $row['quantity']  ?></td>
                            <!-- <td class="text-right"><?php echo number_format($row['gadget_price']*$row['quantity'],2) ?></td> -->
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
                </div>
              </div>
            </div>
          </div>
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
        </div>
      </div>
    </section>
  </div>
</div>
