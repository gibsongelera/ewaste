<!DOCTYPE html>
<html class="no-js" lang="eng">
<head>
		<title>Disposes :: E-WASTE</title>
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
<!-- Approve Modal -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="approveModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="approveModalLabel">Approve Dispose</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body">
				Are you sure you want to approve this dispose?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
				<a id="approveModalConfirm" href="#" class="btn btn-success">Approve</a>
			</div>
		</div>
	</div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="deleteModalLabel">Delete Dispose</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this dispose? This action cannot be undone.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <a id="deleteModalConfirm" href="#" class="btn btn-danger">Delete</a>
      </div>
    </div>
  </div>
</div>

<script>
function confirm_modal(url) {
  $('#deleteModalConfirm').attr('href', url);
  $('#deleteModal').modal('show');
}
</script>

	<div class="preloader"><div class="preloader_image"></div></div>
	<div id="canvas"><div id="box_wrapper">
		<header class="page_header_side page_header_side_sticked active-slide-side-header ds">
			<div class="side_header_logo ds ms">
				<a href="http://localhost/e-waste-master/">
					<span class="logo_text playfair margin_0">E-Waste</span>
				</a>
			</div>
			<span class="toggle_menu_side toggler_light header-slide"><span></span></span>
			<div class="scrollbar-macosx"><div class="side_header_inner">
				<div class="user-menu">
					<ul class="menu-click">
						<li>
							<a href="#">
								<div class="media">
									<div class="media-left media-middle">
										<img src="http://localhost/e-waste-master/uploads/temp.jpg" alt="profile_image">
									</div>
									<div class="media-body media-middle">
										<h4>Collector</h4>
										Collector
									</div>
								</div>
							</a>
							<ul class="dark_bg_color">
								<li><a href="http://localhost/e-waste-master/collector/profile"><i class="fa fa-user"></i>Profile</a></li>
								<li><a href="http://localhost/e-waste-master/collector/settings"><i class="fa fa-cog"></i>Settings</a></li>
								<li><a href="http://localhost/e-waste-master/logout"><i class="fa fa-sign-out"></i>Log Out</a></li>
							</ul>
						</li>
					</ul>
				</div>
				<nav class="mainmenu_side_wrapper">
					<ul class="menu-click">
						<li><a class="" href="http://localhost/e-waste-master/collector/dashboard"><i class="fa fa-th-large"></i>Dashboard</a></li>
					</ul>
					<ul class="menu-click">
						<li><a href="http://localhost/e-waste-master/collector/gadgets"><i class="rt-icon2-tv"></i>Garbage</a></li>
						<li class="active-submenu"><a class="active-link" href="http://localhost/e-waste-master/collector/disposes"><i class="rt-icon2-cup"></i>Disposes</a></li>
					</ul>
				</nav>
			</div></div>
		</header>
		<header class="page_header header_darkgrey">
			<div class="pull-right big-header-buttons">
				<li class="dropdown user-dropdown-menu">
					<a class="header-button" id="user-dropdown-menu" data-target="#" href="./profile" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
						<i class="fa fa-user grey"></i> <b style="color: #fff">Collector <i class="fa fa-caret-down"></i></b>
					</a>
					<div class="dropdown-menu ls">
						<ul class="nav darklinks">
							<li><a href="http://localhost/e-waste-master/collector/profile"><i class="fa fa-user"></i>Profile</a></li>
							<li><a href="http://localhost/e-waste-master/collector/settings"><i class="fa fa-cog"></i>Settings</a></li>
							<li><a href="http://localhost/e-waste-master/logout"><i class="fa fa-sign-out"></i>Log Out</a></li>
						</ul>
					</div>
				</li>
			</div>
		</header>
		<section class="ls with_bottom_border">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-6">
						<ol class="breadcrumb darklinks">
							<li><a href="javascript:void(0);" style="pointer-events:none; color:inherit;">Homepage</a></li>
							<li class="active">Disposes</li>
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
		
				<title>Disposes</title>
				<div class="row">
					<div class="col-md-4">
						<h3 class="dashboard-page-title">Disposes</h3>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<ul class="nav nav-tabs" role="tablist">
							<li class="active"><a href="#tab1" role="tab" data-toggle="tab"><i class="rt-icon2-microwave"></i> All Disposes</a></li>
							<li><a href="#tab2" role="tab" data-toggle="tab"><i class="rt-icon2-tick"></i> Colletected Disposes</a></li>
							<li><a href="#tab3" role="tab" data-toggle="tab"><i class="rt-icon2-watch"></i> Pending Disposes</a></li>
						</ul>
						<div class="tab-content tab-custom top-color-border">
							<div class="tab-pane fade in active" id="tab1">
								<div class="row">
									<div class="col-xs-12 col-md-12">
										<h4>All E-waste Disposes</h4>
										<hr>
										<div class="table-responsive">
											<table class="table table-hover" id="example23">
												<thead>
													<tr>
														<th>#</th>
														<th>Dispose_id</th>
														<th>Summary</th>
														<th>Collection Date</th>
														<!-- <th>Payment</th> -->
														<th>Stage</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$i=1;
													if (isset($getClientDispose)) {
														foreach($getClientDispose as $row):
															$transaction_id=$row['transaction_id'];
															$transaction_code=$row['transaction_code'];
															$payment_status=$row['payment_status'];
															$transaction_status=$row['transaction_status'];
															$transaction_total=$row['transaction_total'];
															$collection_date=$row['collection_date'];
															$name=$row['name'];
															$phone=$row['phone'];
													?>
													<tr>
														<td><?php echo $i++;?>.</td>
														<td><a href="<?php echo base_url()?>collector/disposes/view/<?php echo $transaction_code ?>"><b><?php echo $transaction_code; ?></b></a></td>
														<td class="">
															<b>Client:</b> <?php echo ucwords($name)?><br>
															<b>Phone:</b> <?php echo $phone ?><br>
															<b>Garbages:</b> <?php echo $this->qm->disposes('countDisposes',$transaction_id)?>
														</td>
														<td><?php echo date("m/d/Y",$collection_date) ?></td>
														<!-- Payment info hidden
														<td>
															<b>Amount ():</b> <?php echo $this->qm->formatMoney($transaction_total,true); ?><br>
															<b>Status:</b>
															<?php if($payment_status==0){ ?>
																<span class="label label-danger"><i class="rt-icon2-close"></i> Unconfirmed</span>
															<?php }else{?>
																<span class="label label-success"><i class="rt-icon2-check"></i> Approved</span>
															<?php }?>
														</td>
														-->
														<td>
															<?php if($transaction_status==0){ ?>
																<span class="label label-warning"><i class="fa fa-check-circle-o"></i> Pending</span>
															<?php }elseif($transaction_status==1){?>
																<span class="label label-info"><i class="fa fa-check-circle-o"></i> Scheduled</span>
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
																	<?php if($payment_status==0 && $transaction_status==0){ ?>
																	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
																		<li role="presentation">
																			<a role="menuitem" tabindex="-1" href="<?php echo base_url();?>disposes_crud/view/<?php echo $transaction_code ?>">
																				<i class="fa fa-angle-double-right"></i> View More
																			</a>
																		</li>
																		<!-- Payment action hidden
																		<li role="presentation">
																			<a role="menuitem" tabindex="-1" href="#" onclick="showPaidModal('<?php echo base_url();?>disposes_crud/markPaid/<?php echo $transaction_code;?>')">
																				<i class="fa fa-angle-double-right"></i> Mark Paid (Collector)
																			</a>
																		</li>
																		-->
																		<li role="presentation">
																			<a role="menuitem" tabindex="-1" href="#" onclick="showApproveModal('<?php echo base_url();?>disposes_crud/approve/<?php echo $transaction_code;?>')">
																				<i class="fa fa-angle-double-right"></i> Approve (Collector)
																			</a>
																		</li>
																		<li role="presentation">
																			<a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>disposes_crud/delete/<?php echo $transaction_code;?>')">
																				<i class="fa fa-angle-double-right"></i> Delete?
																			</a>
																		</li>
																	</ul>
																	<?php }else{?>
																	<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
																		<li role="presentation">
																			<a role="menuitem" tabindex="-1" href="<?php echo base_url();?>disposes_crud/view/<?php echo $transaction_code ?>">
																				<i class="fa fa-angle-double-right"></i> View More
																			</a>
																		</li>
																		<?php if($transaction_status==1){ ?>
																		<li role="presentation">
																			<a role="menuitem" tabindex="-1" href="#" onclick="showCollectModal('<?php echo base_url();?>disposes_crud/markCollected/<?php echo $transaction_code;?>')">
																				<i class="fa fa-angle-double-right"></i> Mark Collected (Collector)
																			</a>
																		</li>
																		<?php }?>
																		<li role="presentation">
																			<a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>disposes_crud/delete/<?php echo $transaction_code;?>')">
																				<i class="fa fa-angle-double-right"></i> Delete?
																			</a>
																		</li>
																	</ul>
																	<?php }?>
																</div>
															</div>
														</td>
													</tr>
													<?php endforeach;
													} ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="tab2">
								<h4>Collected Disposes</h4>
								<hr>
								<div class="table-responsive">
									<table class="table table-hover" id="approved">
										<thead>
											<tr>
												<th>#</th>
												<th>Dispose_id</th>
												<th>Summary</th>
												<th>Collection Date</th>
												<!-- <th>Payment</th> -->
												<th>Stage</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$i=1;
											if (isset($getClientDisposeCollected)) {
												foreach($getClientDisposeCollected as $row) {
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
												<td><?php echo $i++;?>.</td>
												<td><a href="<?php echo base_url()?>collector/disposes/view/<?php echo $transaction_code ?>"><b><?php echo $transaction_code; ?></b></a></td>
												<td>
													<b>Client:</b> <?php echo ucwords($name)?><br>
													<b>Phone:</b> <?php echo $phone ?><br>
													<b>Gadgets:</b> <?php echo $this->qm->disposes('countDisposes',$transaction_id)?></td>
												<td><?php echo date("m/d/Y",$collection_date) ?></td>
												<!-- Payment info hidden 
												<td>
													<b>Amount ():</b> <?php echo $this->qm->formatMoney($transaction_total,true); ?><br>
													<b>Status:</b>
													<span class="label label-success"><i class="rt-icon2-check"></i> Paid</span>
												</td>
												-->
												<td>
													<span class="label label-default"><i class="fa fa-check"></i> Collected</span>
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
																<li role="presentation">
																	<a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>collector/disposes_crud/delete/<?php echo $transaction_code;?>')">
																		<i class="fa fa-angle-double-right"></i> Delete?
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</td>
											</tr>
											<?php }
											} ?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="tab-pane" id="tab3">
								<h4>Pending Disposes</h4>
								<hr>
								<div class="table-responsive">
									<table class="table table-hover" id="pending">
										<thead>
											<tr>
												<th>#</th>
												<th>Dispose_id</th>
												<th>Summary</th>
												<th>Collection Date</th>
												<!-- <th>Payment</th> -->
												<th>Stage</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											$i=1;
											if (isset($getClientDispose)) {
												foreach($getClientDispose as $row) {
													if($row['transaction_status'] == 0) { // Only show truly pending items
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
												<td><?php echo $i++;?>.</td>
												<td><a href="<?php echo base_url()?>collector/disposes/view/<?php echo $transaction_code ?>"><b><?php echo $transaction_code; ?></b></a></td>
												<td>
													<b>Client:</b> <?php echo ucwords($name)?><br>
													<b>Phone:</b> <?php echo $phone ?><br>
													<b>Garbages:</b> <?php echo $this->qm->disposes('countDisposes',$transaction_id)?></td>
												<td><?php echo date("m/d/Y",$collection_date) ?></td>
												<td>
													<b>Amount ():</b> <?php echo $this->qm->formatMoney($transaction_total,true); ?><br>
													<b>Status:</b>
													<?php if($payment_status==0){ ?>
														<span class="label label-danger"><i class="rt-icon2-close"></i> Unconfirmed</span>
													<?php }else{?>
														<span class="label label-success"><i class="rt-icon2-check"></i> Approved</span>
													<?php }?>
												</td>
												<td>
													<span class="label label-warning"><i class="fa fa-check-circle-o"></i> Pending</span>
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
																<?php if($payment_status == 1) { // Only show approve option if payment is confirmed ?>
																<li role="presentation">
																	<a role="menuitem" tabindex="-1" href="#" onclick="showApproveModal('<?php echo base_url();?>disposes_crud/approve/<?php echo $transaction_code;?>')">
																		<i class="fa fa-angle-double-right"></i> Approve
																	</a>
																</li>
																<?php } ?>
																<li role="presentation">
																	<a role="menuitem" tabindex="-1" href="#" onclick="confirm_modal('<?php echo base_url();?>collector/disposes_crud/delete/<?php echo $transaction_code;?>')">
																		<i class="fa fa-angle-double-right"></i> Delete?
																	</a>
																</li>
															</ul>
														</div>
													</div>
												</td>
											</tr>
											<?php 
													}
												}
											} 
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="page_copyright ds darkblue_bg_color"><div class="container-fluid"><div class="row"><div class="col-sm-6"><p class="grey">Copyrights &copy; 2025 | E-waste System | All Rights Reserved</p></div><div class="col-sm-6 text-sm-right"><p class="grey">Project by <i class="fa fa-user"></i> ZPPSU</p></div></div></div></section>
	</div></div>
	<script src="http://localhost/e-waste-master/components/assets/js/compressed.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/main.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/moment.min.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/fullcalendar.min.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/daterangepicker.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/Chart.bundle.min.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/jquery-jvectormap-2.0.3.min.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/jquery-jvectormap-world-mill.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/jquery.sparkline.min.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/datatables/datatables.min.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/datatables/dataTables.buttons.min.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/datatables/buttons.flash.min.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/datatables/jszip.min.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/datatables/pdfmake.min.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/datatables/vfs_fonts.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/datatables/buttons.html5.min.js"></script>
	<script src="http://localhost/e-waste-master/components/assets/js/admin/datatables/buttons.print.min.js"></script>
	<script>
	function showApproveModal(url) {
		$('#approveModalConfirm').attr('href', url);
		$('#approveModal').modal('show');
	}
	</script>
	<script>
		$(function() {
			$('#myTable').DataTable();
			$(document).ready(function() {
				var table = $('#example').DataTable({
					"columnDefs": [{
						"visible": false,
						"targets": 2
					}],
					"order": [
						[2, 'asc']
					],
					"displayLength": 25,
					"drawCallback": function(settings) {
						var api = this.api();
						var rows = api.rows({
							page: 'current'
						}).nodes();
						var last = null;
						api.column(2, {
							page: 'current'
						}).data().each(function(group, i) {
							if (last !== group) {
								$(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
								last = group;
							}
						});
					}
				});
				$('#example tbody').on('click', 'tr.group', function() {
					var currentOrder = table.order()[0];
					if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
						table.order([2, 'desc']).draw();
					} else {
						table.order([2, 'asc']).draw();
					}
				});
			});
		});
		$('#example23, #approved, #pending').DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf', 'print'
			]
		});
		$('.buttons-copy, .buttons-csv, .buttons-print, .buttons-pdf, .buttons-excel').addClass('theme_button inverse mr-1');
	</script>
</body>
</html>