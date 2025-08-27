<?php foreach($getClient->result() as $row):
	$client_id=$row->login_id;
	$names=$row->name;
	$email=$row->email;
	endforeach;
	$phone=$this->db->get_where('profiles' , array('login_id'=>$id))->row()->phone;
	$address=$this->db->get_where('profiles' , array('login_id'=>$id))->row()->address;

?>
<div class="row">
	<!-- <div class="col-md-8"> -->
	<div class="col-md-12">

		<!-- <h4>Tabs</h4> -->

		<!-- Nav tabs -->
		<ul class="nav nav-tabs" role="tablist">
			<li class="active"><a href="#tab1" role="tab" data-toggle="tab"><i class="fa fa-plus"></i> Add New Dispose</a></li>
		</ul>

		<!-- Tab panes -->
		<div class="tab-content tab-custom top-color-border">
			<div class="tab-pane fade in active" id="tab1">
				<div class="row">
					<div class="col-xs-12 col-md-12">
					  <!-- <div class="with_border with_padding"> -->
						<!-- <h4 class="divider_40">Registered disposable gadgets</h4> -->
						<div class="success-messages"></div>
<form enctype="multipart/form-data" method="post" id="disposeForm" action="<?php echo base_url()?>client/disposes_crud/add">
  <input type="hidden" name="lat" id="dispose-lat">
  <input type="hidden" name="lng" id="dispose-lng">
							<input type="hidden" name="base_url" value="<?php echo base_url() ?>" id="base_url">
							<div class="row">
								<div class="col-xs-6 col-md-4">
									<div class="form-group">
										<label><b>Name</b></label>
										<input type="text" name="name" value="<?php echo ucwords($name) ?>" id="name" class="form-control" autocomplete="off" placeholder="Name">
									</div>
								</div>
								<div class="col-xs-6 col-md-4">
									<div class="form-group">
										<label><b>Email</b></label>
										<input type="text" name="email" value="<?php echo $email ?>" id="email" class="form-control" readonly placeholder="Email">
									</div>
								</div>

								<div class="col-xs-6 col-md-4">
									<!-- <div class="input-group">
										<span class="input-group-addon" style="border:none;"><b>+63</b></span>
										<input type="text" class="form-control" placeholder="Username">
									</div> -->
									<div class="form-group">
										<label><b>Phone Number</b></label>
										<!-- <input type="text" name="phone" value="<?php echo $phone ?>" id="phone" class="form-control" placeholder="Phone Number" autocomplete="off"> -->
<div class="input-group">
  <span class="input-group-addon" style="border:none;"><b>+63</b></span>
  <input type="text" class="form-control" placeholder="Phone Number" name="phone" value="<?php echo htmlspecialchars($phone ?? '', ENT_QUOTES); ?>" id="phone">
  <p class="help-block" id="phoneHelp">Input a valid phone number</p>
</div>
<script>
// Accepts 09969788581 or 9969788581, always stores as 9969788581
document.addEventListener('DOMContentLoaded', function() {
  var phoneInput = document.getElementById('phone');
  var phoneHelp = document.getElementById('phoneHelp');
  function normalizePhone(val) {
	val = val.replace(/\D/g, '');
	if (val.length === 11 && val.startsWith('09')) {
	  val = val.slice(1);
	}
	return val;
  }
  phoneInput.addEventListener('input', function(e) {
	var val = normalizePhone(this.value);
	if (val.length > 10) val = val.slice(0, 10);
	this.value = val;
	if (val.length === 10 && /^9\d{9}$/.test(val)) {
	  phoneHelp.textContent = 'Valid phone number.';
	  phoneHelp.style.color = 'green';
	} else {
	  phoneHelp.textContent = 'Input a valid phone number';
	  phoneHelp.style.color = '';
	}
  });
  var disposeForm = document.getElementById('disposeForm');
  disposeForm.addEventListener('submit', function(e) {
	var val = normalizePhone(phoneInput.value.trim());
	phoneInput.value = val;
	if (!/^9\d{9}$/.test(val)) {
	  phoneHelp.textContent = 'Please enter a valid Philippine mobile number: 10 digits starting with 9.';
	  phoneHelp.style.color = 'red';
	  phoneInput.focus();
	  e.preventDefault();
	} else {
	  phoneHelp.textContent = 'Valid phone number.';
	  phoneHelp.style.color = 'green';
	}
  });
});
</script>
									</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6 col-md-4">
<div class="form-group">
	<label><b>Location Address</b></label>
	<input type="text" name="address" value="<?php echo $address ?>" id="address" autocomplete="off" class="form-control" placeholder="Address">
	<div style="margin-top:10px;">
		<div id="dispose-map" style="height: 200px; width: 100%; margin-bottom:10px;"></div>
		<button id="pin-dispose-location-btn" type="button" class="theme_button color2 margin_10">Pin My Location</button>
	</div>
</div>
<script>
let disposeMap, disposeMarker, disposeGeocoder;
function initDisposeMap() {
	disposeGeocoder = new google.maps.Geocoder();
	disposeMap = new google.maps.Map(document.getElementById('dispose-map'), {
		center: { lat: 6.9214, lng: 122.0790 }, // Zamboanga City
		zoom: 13
	});
	disposeMap.addListener('click', function(e) {
		placeDisposeMarker(e.latLng);
		reverseDisposeGeocode(e.latLng);
	});
}
function placeDisposeMarker(latLng) {
	if (disposeMarker) disposeMarker.setMap(null);
	disposeMarker = new google.maps.Marker({
		position: latLng,
		map: disposeMap
	});
	// Set hidden lat/lng fields
	document.getElementById('dispose-lat').value = latLng.lat();
	document.getElementById('dispose-lng').value = latLng.lng();
}
function reverseDisposeGeocode(latLng) {
	disposeGeocoder.geocode({ location: latLng }, function(results, status) {
		if (status === 'OK' && results[0]) {
			document.getElementById('address').value = results[0].formatted_address;
		}
	});
}
document.getElementById('pin-dispose-location-btn').addEventListener('click', function() {
	if (navigator.geolocation) {
	navigator.geolocation.getCurrentPosition(function(position) {
		var latLng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
		disposeMap.setCenter(latLng);
		placeDisposeMarker(latLng);
		reverseDisposeGeocode(latLng);
	});
	}
});
// Load Google Maps script for dispose map
function loadDisposeMapScript() {
	var script = document.createElement('script');
	script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB3rwqujTHETw5DjpFJ3h4qSWO3ak9mJq0&callback=initDisposeMap';
	script.async = true;
	script.defer = true;
	window.initDisposeMap = initDisposeMap;
	document.body.appendChild(script);
}
document.addEventListener('DOMContentLoaded', loadDisposeMapScript);
</script>
								</div>
								<div class="col-xs-6 col-md-4">
									<div class="form-group">
										<label><b>Who are You</b></label>
										<select name="who" class="form-control" id="who">
											<option value="" selected>Select Option</option>
											<option value="1">Individual</option>
											<option value="2">Business</option>
										</select>
									</div>
								</div>
								<div class="col-xs-6 col-md-4">
									<div class="form-group">
									<div class="form-group">
										<label><b>Date to be Collected</b></label>
										<input type="date" class="form-control" name="collectDate" id="collectDate">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-6 col-md-4">
									<label><b>Add Image</b></label>
									<input type="file" name="userfile" value="" id="userfile" class="form-control" placeholder="image">
								</div>
								<div class="col-xs-6 col-md-8">
									<div class="form-group">
										<label><b>Gadget Descriptions</b></label>
										<textarea name="description" placeholder="Add e-waste descripion here" rows="1" class="form-control" id="description"></textarea>
									</div>
								</div>

								<div class="col-xs-12 col-md-12">
									<div class="table-responsive">
										<table class="table table-condensed" id="disposeTable">
											<thead>
												<tr>
													<th>No.</th>			  			
													<th>Garbage Type</th>
													<th>Status Garbage</th>
													<th>Quantity</th>
													<th>Total</th>		  			
													<th>Delete</th>
												</tr>
											</thead>
											<tbody>
												<?php
												$arrayNumber = 0;
												for($x = 1; $x < 2; $x++) { ?>
													<tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
														<td>
															<?php echo $x ?>.
														</td>			  				
														<td>
															<div class="form-group">
																<select name="gadgetType[]" title="Select Garbage" id="gadgetType<?php echo $x; ?>" onChange="getGadgetPrice(<?php echo $x; ?>)" class="form-control">
																	<option value="" selected="">Select Garbage</option>
																	<?php
																		foreach($gadgetsQuery as $row):
																			$gadget_id=$row['gadget_id'];
																			$gadget_name=$row['gadget_name'];
																	?>
																		 <option value="<?php echo $gadget_id; ?>">
																			<?php echo $gadget_name; ?>
																		 </option>
																	<?php 
																		endforeach;
																	?>
																</select>
															</div>
														</td>			  				
														<td>
															<div class="form-group">
																<input type="text" name="gadgetPrice[]" autocomplete="off" class="form-control" disabled readonly placeholder="Garbage Status" id="gadgetPrice<?php echo $x; ?>">
																<input type="hidden" name="gadgetPriceValue[]" id="gadgetPriceValue<?php echo $x; ?>" autocomplete="off"/>
															</div>
														</td>		  				
														<td>
															<div class="form-group">
																<input type="number" name="gadgetQuantity[]" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" placeholder="Add Quantity" id="gadgetQuantity<?php echo $x; ?>">
																<input type="hidden" name="gadgetQuantityValue" value="" id="gadgetQuantityValue<?php echo $x;?>" />
															</div>
														</td>
														<td>
															<div class="form-group">
																<input type="number" name="totalPrice[]" autocomplete="off" class="form-control" disabled readonly placeholder="total Quantity"id="totalPrice<?php echo $x; ?>">
																<input type="hidden" name="totalPriceValue[]" id="totalPriceValue<?php echo $x; ?>" />
															</div>		  					
														</td>
														<td>
															<button class="btn btn-danger  removeDisposeRowBtn" type="button" id="removeDisposeRowBtn" onclick="removeDisposeRow(<?php echo $x; ?>)"data-toggle="tooltip" data-placement="top" title="Delete Row"><i class="fa fa-trash-o"></i></button>
														</td>
													</tr>
												<?php
														$arrayNumber++;
													} // /for
												?>
											</tbody>			  	
										  </table>
									  <!--end dispose table-->
									  </div>
									  <!-- table-responsive -->
									</div>
								</div>

								  <div class="row">
									<div class="col-sm-7">
										<button type="button" class="btn btn-primary text-right" onclick="addDisposeRow()" id="addDisposeRowBtn" data-loading-text="Adding..."> <i class="fa fa-plus-circle"></i> Add Row </button>
									</div>
									<div class="col-sm-4 form-horizontal">
										<div class="form-group">
										<label for="finalTotal" class="col-sm-2 control-label"><b>Total:</b></label>
											<div class="col-sm-10">
												<input  
													style="font-size: 17px; font-weight: bold;" 
													type="number" 
													name="finalTotal" 
													class="form-control"
													disabled="disabled" 
													id="finalTotal" 
													placeholder="Total Quantity"
												/>
												<input type="hidden" name="finalTotalValue" id="finalTotalValue">
											</div>
										</div>									  	
									</div>
									<div class="col-sm-1"></div>
								  </div>
								  
								  <div class="row" id="taskButtons">
									<div class="col-sm-12">
										<button type="submit" onclick="validateDisposeForm()" id="createDisposeBtn" data-loading-text="Adding..." class="btn btn-success"><i class="fa fa-plus-circle"></i> Dispose Gadgets</button>
										<button type="reset" onclick="resetDisposeForm()" class="btn btn-warning"><i class="fa fa-eraser"></i> Reset</button>
									</div>
								  </div>
						</form>
						
					  <!-- </div> -->
					  <!-- .with_border -->
					</div>
					<!-- .col-* -->
				</div>
				<!-- .row-* -->
			</div>
		</div>
		<!-- .tab-content-* -->
	</div>
	<!-- .col-* -->
</div>
<!-- .row-* -->