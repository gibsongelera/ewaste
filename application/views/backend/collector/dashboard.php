<div class="row">



            <!DOCTYPE html>
            <html class="no-js" lang="eng">
            <head>
                <title>Collector Dashboard :: E-WASTE</title>
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
              <div class="preloader"><div class="preloader_image"></div></div>
              <div id="canvas"><div id="box_wrapper">
                <header class="page_header_side page_header_side_sticked active-slide-side-header ds">
                  <div class="side_header_logo ds ms">
                    <a href="#">
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
                            <li><a href="http://localhost/e-waste-master/logout"><i class="fa fa-sign-out"></i>Log Out</a></li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                    <nav class="mainmenu_side_wrapper">
                      <ul class="menu-click">
                        <li class="active-submenu"><a class="active-link" href="http://localhost/e-waste-master/collector/dashboard"><i class="fa fa-th-large"></i>Dashboard</a></li>
                      </ul>
                      <ul class="menu-click">
                        <li><a href="http://localhost/e-waste-master/collector/disposes"><i class="rt-icon2-cup"></i>Disposes</a></li>
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
                          <li><a href="http://localhost/e-waste-master/logout"><i class="fa fa-sign-out"></i>Log Out</a></li>
                        </ul>
                      </div>
                    </li>
                  </div>
                </header>
                <section class="ls section_padding_top_50 section_padding_bottom_50 columns_padding_10">
                  <div class="container-fluid">
                    <title>Collector Dashboard</title>
                    <div class="row">
                      <div class="col-md-4"><h3 class="dashboard-page-title">Collector Dashboard</h3></div>
                      <div class="col-md-8 text-md-right">
                        <h3 class="sparklines-title"><sup>Approved Total Disposal:</sup> <?php echo isset($approved_disposes) ? $approved_disposes : 0; ?></h3>
                        <h3 class="sparklines-title"><sup>Pending Total Disposal: </sup> <?php echo isset($pending_disposes) ? $pending_disposes : 0; ?></h3>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-lg-3 col-sm-6">
                        <div class="teaser info_bg_color counter-background-teaser text-center">
                          <span class="counter counter-background" data-from="0" data-to="<?php echo isset($total_clients) ? $total_clients : 0; ?>" data-speed="300"><?php echo isset($total_clients) ? $total_clients : 0; ?></span>
                          <h3 class="counter-wrap highlight" data-from="0" data-to="<?php echo isset($total_clients) ? $total_clients : 0; ?>" data-speed="300"><span class="counter" data-from="0" data-to="<?php echo isset($total_clients) ? $total_clients : 0; ?>" data-speed="350"><?php echo isset($total_clients) ? $total_clients : 0; ?></span></h3>
                          <p>Registered Clients</p>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="teaser warning_bg_color counter-background-teaser text-center">
                          <span class="counter counter-background" data-from="0" data-to="<?php echo isset($total_gadgets) ? $total_gadgets : 0; ?>" data-speed="300"><?php echo isset($total_gadgets) ? $total_gadgets : 0; ?></span>
                          <h3 class="counter highlight" data-from="0" data-to="<?php echo isset($total_gadgets) ? $total_gadgets : 0; ?>" data-speed="350"><?php echo isset($total_gadgets) ? $total_gadgets : 0; ?></h3>
                          <p>Disposable Garbage</p>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="teaser warning_bg_color counter-background-teaser text-center">
                          <span class="counter counter-background" data-from="0" data-to="<?php echo isset($approved_disposes) ? $approved_disposes : 0; ?>" data-speed="300"><?php echo isset($approved_disposes) ? $approved_disposes : 0; ?></span>
                          <h3 class="counter highlight" data-from="0" data-to="<?php echo isset($approved_disposes) ? $approved_disposes : 0; ?>" data-speed="350"><?php echo isset($approved_disposes) ? $approved_disposes : 0; ?></h3>
                          <p>Approved Disposes</p>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="teaser success_bg_color counter-background-teaser text-center">
                          <span class="counter counter-background" data-from="0" data-to="<?php echo isset($pending_disposes) ? $pending_disposes : 0; ?>" data-speed="300"><?php echo isset($pending_disposes) ? $pending_disposes : 0; ?></span>
                          <h3 class="counter highlight" data-from="0" data-to="<?php echo isset($pending_disposes) ? $pending_disposes : 0; ?>" data-speed="350"><?php echo isset($pending_disposes) ? $pending_disposes : 0; ?></h3>
                          <p>Pending Disposes</p>
                        </div>
                      </div>
                      <div class="col-lg-3 col-sm-6">
                        <div class="teaser danger_bg_color counter-background-teaser text-center">
                          <span class="counter counter-background" data-from="0" data-to="1" data-speed="300">0</span>
                          <h3 class="counter highlight" data-from="0" data-to="1" data-speed="350">0</h3>
                          <p>Pending Disposes</p>
                        </div>
                      </div>
                    </div>
                    <!-- Embedded Client Pin Map Section -->
                    <div class="with_border with_padding" style="margin-top:30px;">
                      <h3 class="module-title darkgrey_bg_color">Client Pin Map</h3>
                      <div id="collector-client-map" style="height: 400px; width: 100%;"></div>
                      <div id="debug-info" style="margin-top:10px;"></div>
                    </div>
                    <script>
                    // Similar map logic as admin, but fetches collector pins if needed
                    function initMap() {
                      const map = new google.maps.Map(document.getElementById('collector-client-map'), {
                        center: { lat: 6.9214, lng: 122.0790 },
                        zoom: 12,
                        mapTypeId: google.maps.MapTypeId.ROADMAP,
                        mapTypeControl: true,
                        streetViewControl: true,
                        fullscreenControl: true
                      });
                      const bounds = new google.maps.LatLngBounds();
                      const debugDiv = document.getElementById('debug-info');
                      debugDiv.innerHTML = '';
                      fetch('<?php echo base_url(); ?>collector/get_pins', {
                        headers: { 'Accept': 'application/json' }
                      })
                      .then(async response => {
                        debugDiv.innerHTML += `Response status: ${response.status}<br>`;
                        const text = await response.text();
                        const jsonStart = text.indexOf('[');
                        const jsonEnd = text.lastIndexOf(']');
                        if (jsonStart >= 0 && jsonEnd >= 0) {
                          const cleanJson = text.substring(jsonStart, jsonEnd + 1);
                          return JSON.parse(cleanJson);
                        }
                        return JSON.parse(text);
                      })
                      .then(pins => {
                        if (!Array.isArray(pins)) {
                          throw new Error('Invalid pins data received');
                        }
                        debugDiv.innerHTML += `Received ${pins.length} pins<br>`;
                        if (pins.length === 0) {
                          debugDiv.innerHTML += 'No pins available<br>';
                          return;
                        }
                        pins.forEach(pin => {
                          if (pin.lat && pin.lng) {
                            debugDiv.innerHTML += `Creating marker at ${pin.lat}, ${pin.lng}<br>`;
                            const position = new google.maps.LatLng(
                              parseFloat(pin.lat),
                              parseFloat(pin.lng)
                            );
                            const marker = new google.maps.Marker({
                              position: position,
                              map: map,
                              title: pin.name || 'Client Location'
                            });
                            const infoWindow = new google.maps.InfoWindow({
                              content: `
                                <div style="padding:10px;">
                                  <h4 style="margin:0 0 5px 0;">${pin.name}</h4>
                                  <p style="margin:0 0 5px 0;"><strong>Transaction:</strong> ${pin.transaction_code}</p>
                                  <p style="margin:0;"><strong>Location:</strong> ${pin.location}</p>
                                </div>
                              `
                            });
                            marker.addListener('click', () => {
                              infoWindow.open(map, marker);
                              if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(function(position) {
                                  const origin = position.coords.latitude + ',' + position.coords.longitude;
                                  const destination = pin.lat + ',' + pin.lng;
                                  const url = `https://www.google.com/maps/dir/?api=1&origin=${origin}&destination=${destination}`;
                                  window.open(url, '_blank');
                                }, function(error) {
                                  alert('Could not get your location for navigation.');
                                });
                              } else {
                                alert('Geolocation is not supported by your browser.');
                              }
                            });
                            bounds.extend(position);
                          }
                        });
                        map.fitBounds(bounds);
                        debugDiv.innerHTML += `Created ${bounds.getLength()} markers<br>`;
                      })
                      .catch(error => {
                        debugDiv.innerHTML += `Error: ${error.message}<br>`;
                      });
                    }
                    document.addEventListener('DOMContentLoaded', function() {
                      var script = document.createElement('script');
                      script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB3rwqujTHETw5DjpFJ3h4qSWO3ak9mJq0&libraries=places&callback=initMap';
                      script.async = true;
                      script.defer = true;
                      document.body.appendChild(script);
                    });
                    </script>
                    <div class="row">
                      <div class="col-xs-12 col-md-8">
                        <h3 class="module-title darkgrey_bg_color">My Calendar</h3>
                        <div class="events_calendar"></div>
                      </div>
                      <div class="col-xs-12 col-md-4">
                        <div class="with_border with_padding">
                          <h4>Latest Updates</h4>
                          <div class="admin-scroll-panel scrollbar-macosx">
                            <ul class="list1 no-bullets">
                              <li><div class="media small-teaser"><div class="media-left media-middle"><div class="teaser_icon label-success round"><i class="fa fa-check"></i></div></div><div class="media-body media-left"><span class="grey">You marked dispose <b></b> as paid on <small><b>Wed, 13/Aug/2025</b> at <b>02:05:am</b></small></span></div></div></li>
                              <li><div class="media small-teaser"><div class="media-left media-middle"><div class="teaser_icon label-success round"><i class="fa fa-check"></i></div></div><div class="media-body media-left"><span class="grey">You marked dispose <b></b> as paid on <small><b>Wed, 13/Aug/2025</b> at <b>02:05:am</b></small></span></div></div></li>
                              <li><div class="media small-teaser"><div class="media-left media-middle"><div class="teaser_icon label-success round"><i class="fa fa-check"></i></div></div><div class="media-body media-left"><span class="grey">You marked dispose <b></b> as paid on <small><b>Wed, 13/Aug/2025</b> at <b>02:00:am</b></small></span></div></div></li>
                              <li><div class="media small-teaser"><div class="media-left media-middle"><div class="teaser_icon label-success round"><i class="fa fa-check"></i></div></div><div class="media-body media-left"><span class="grey">You marked dispose <b></b> as paid on <small><b>Wed, 13/Aug/2025</b> at <b>02:00:am</b></small></span></div></div></li>
                              <li><div class="media small-teaser"><div class="media-left media-middle"><div class="teaser_icon label-warning round"><i class="rt-icon2-cup"></i></div></div><div class="media-body media-left"><span class="grey">New dispose <b>250322</b> initiated on <small><b>Wed, 06/Aug/2025</b> at <b>03:38:pm</b></small></span></div></div></li>
                            </ul>
                          </div>
                          <br>
                          <div class="row"><div col-sm-12><button class="btn btn-success" onclick="showLogsUrl('http://localhost/e-waste-master/collector/logs')"> see all logs</button></div></div>
                        </div>
                      </div>
                    </div>
                    <script src="http://localhost/e-waste-master/components/assets/js/admin/jquery-jvectormap-2.0.3.min.js"></script>
                    <script src="http://localhost/e-waste-master/components/assets/js/admin/jquery-jvectormap-world-mill.js"></script>
                    <script type="text/javascript">function showLogsUrl(url=null) {if(url){location.replace(url)}} </script>
                    <script>function showAjaxModal(url){jQuery('#modal_ajax').modal('show', {backdrop: 'true'});$.ajax({url: url,success: function(response){jQuery('#modal_ajax .modal-body').html(response);}});}</script>
                    <div class="modal fade" id="modal_ajax" data-backdrop="static"><div class="modal-dialog"><div class="modal-content"><div class="modal-header" style=" background-color:#54be73;"><button type="button" class="close" style="color:white;" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" style="text-align:center; font-weight:bold; color:#fff;"><i class="fa fa-edit"></i> Edit Details</h4></div><div class="modal-body" style="height:470px; overflow:auto;"></div><div class="modal-footer"><button type="button" class="btn btn-info" data-dismiss="modal">Close</button></div></div></div></div></div>
                    <script>function confirm_modal(delete_url){jQuery('#flexModal').modal('show', {backdrop: 'static'});document.getElementById('delete_link').setAttribute('href' , delete_url);$(this).parents(".odd").animate({ backgroundColor: "#fbc7c7" }, "fast").animate({ opacity: "hide" }, "slow");}function showPaidModal(payment_url){jQuery('#paymentModal').modal('show', {backdrop: 'static'});document.getElementById('payment_link').setAttribute('href' , payment_url);}function showApproveModal(approve_url){jQuery('#approveModal').modal('show', {backdrop: 'static'});document.getElementById('approve_link').setAttribute('href' , approve_url);}function showCollectModal(collect_url){jQuery('#collectModal').modal('show', {backdrop: 'static'});document.getElementById('collect_link').setAttribute('href' , collect_url);}</script>
                    <div class="modal fade primary" id="flexModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true"><div class="modal-dialog"><div class="modal-content" style="margin-top:100px;"><div class="modal-header" style=" background-color:#54be73;"><button type="button" style="color:#fff;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" style="text-align:center; font-weight:bold; color:#fff;">Are you sure to delete this information ?</h4></div><div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;"><a href="#" class="btn btn-danger" id="delete_link">DELETE</a><button type="button" class="btn btn-primary" data-dismiss="modal">cancel</button></div></div></div></div></div>
                    <div class="modal fade primary" id="paymentModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true"><div class="modal-dialog"><div class="modal-content" style="margin-top:100px;"><div class="modal-header" style=" background-color:#54be73;"><button type="button" style="color:#fff;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" style="text-align:center; font-weight:bold; color:#fff;">Mark as Paid? There is no reverse for this action!</h4></div><div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;"><a href="#" class="btn btn-danger" id="payment_link">MARK PAID</a><button type="button" class="btn btn-primary" data-dismiss="modal">cancel</button></div></div></div></div></div>
                    <div class="modal fade primary" id="approveModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true"><div class="modal-dialog"><div class="modal-content" style="margin-top:100px;"><div class="modal-header" style=" background-color:#54be73;"><button type="button" style="color:#fff;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" style="text-align:center; font-weight:bold; color:#fff;">Approve this Dispose? This will mark as paid and collected!</h4></div><div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;"><a href="#" class="btn btn-danger" id="approve_link">APPROVE</a><button type="button" class="btn btn-primary" data-dismiss="modal">cancel</button></div></div></div></div></div>
                    <div class="modal fade primary" id="collectModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="ultraModal-Label" aria-hidden="true"><div class="modal-dialog"><div class="modal-content" style="margin-top:100px;"><div class="modal-header" style=" background-color:#54be73;"><button type="button" style="color:#fff;" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><h4 class="modal-title" style="text-align:center; font-weight:bold; color:#fff;">Are you sure you want to Mark as Collected?</h4></div><div class="modal-footer" style="margin:0px; border-top:0px; text-align:center;"><a href="#" class="btn btn-danger" id="collect_link">MARK COLLECTED</a><button type="button" class="btn btn-primary" data-dismiss="modal">cancel</button></div></div></div></div></div>
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
              <script src="components/assets/js/admin/jquery-jvectormap-2.0.3.min.js"></script>
              <script src="components/assets/js/admin/jquery-jvectormap-world-mill.js"></script>
              <script src="http://localhost/e-waste-master/components/assets/js/admin/jquery.sparkline.min.js"></script>
              <script type="text/javascript">jQuery('.events_calendar').fullCalendar({header:{left:'prev,next today',center:'title',right:'month,agendaWeek,agendaDay,listWeek'},editable:true,firstDay:1,height:530,droppable:false,eventLimit:true,navLinks:true,aspectRatio:1,events:[{className:'fc-green',title:'Dispose ID:  98385C',url:'http://localhost/e-waste-master/collector/disposes/view/98385C',start:'2025-08-05'},{className:'fc-green',title:'Dispose ID:  4647B8',url:'http://localhost/e-waste-master/collector/disposes/view/4647B8',start:'2025-08-06'},{className:'fc-green',title:'Dispose ID:  EED73D',url:'http://localhost/e-waste-master/collector/disposes/view/EED73D',start:'2025-08-06'},{className:'fc-green',title:'Dispose ID:  EF5DCE',url:'http://localhost/e-waste-master/collector/disposes/view/EF5DCE',start:'2025-08-06'},{className:'fc-orange',description:'first description sahchajajskcjkasjkk',title:'Dispose ID: 250322',url:'http://localhost/e-waste-master/collector/disposes/view/250322',start:'2025-08-06'}]});</script>
            </body>
            </html>