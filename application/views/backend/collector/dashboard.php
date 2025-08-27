<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<div class="row">
  <div class="col-md-4">
    <h3 class="dashboard-page-title">Collector Dashboard</h3>
  </div>
  <div class="col-md-8 text-md-right">
    <h3 class="sparklines-title">
      <sup>Approved Total Disposal:</sup> <?php echo isset($approved_disposes) ? $approved_disposes : 0; ?>
    </h3>
    <h3 class="sparklines-title">
      <sup>Pending Total Disposal: </sup> <?php echo isset($pending_disposes) ? $pending_disposes : 0; ?>
    </h3>
  </div>
</div>

<div class="row">
  <div class="col-lg-3 col-sm-6">
    <div class="teaser info_bg_color counter-background-teaser text-center">
      <span class="counter counter-background" data-from="0" data-to="<?php echo isset($total_clients) ? $total_clients : 0; ?>" data-speed="300">
        <?php echo isset($total_clients) ? $total_clients : 0; ?>
      </span>
      <h3 class="counter highlight" data-from="0" data-to="<?php echo isset($total_clients) ? $total_clients : 0; ?>" data-speed="350">
        <?php echo isset($total_clients) ? $total_clients : 0; ?>
      </h3>
      <p>Registered Clients</p>
    </div>
  </div>
  
  <div class="col-lg-3 col-sm-6">
    <div class="teaser warning_bg_color counter-background-teaser text-center">
      <span class="counter counter-background" data-from="0" data-to="<?php echo isset($total_gadgets) ? $total_gadgets : 0; ?>" data-speed="300">
        <?php echo isset($total_gadgets) ? $total_gadgets : 0; ?>
      </span>
      <h3 class="counter highlight" data-from="0" data-to="<?php echo isset($total_gadgets) ? $total_gadgets : 0; ?>" data-speed="350">
        <?php echo isset($total_gadgets) ? $total_gadgets : 0; ?>
      </h3>
      <p>Disposable Garbage</p>
    </div>
  </div>
  
  <div class="col-lg-3 col-sm-6">
    <div class="teaser success_bg_color counter-background-teaser text-center">
      <span class="counter counter-background" data-from="0" data-to="<?php echo isset($approved_disposes) ? $approved_disposes : 0; ?>" data-speed="300">
        <?php echo isset($approved_disposes) ? $approved_disposes : 0; ?>
      </span>
      <h3 class="counter highlight" data-from="0" data-to="<?php echo isset($approved_disposes) ? $approved_disposes : 0; ?>" data-speed="350">
        <?php echo isset($approved_disposes) ? $approved_disposes : 0; ?>
      </h3>
      <p>Approved Disposes</p>
    </div>
  </div>
  
  <div class="col-lg-3 col-sm-6">
    <div class="teaser danger_bg_color counter-background-teaser text-center">
      <span class="counter counter-background" data-from="0" data-to="<?php echo isset($pending_disposes) ? $pending_disposes : 0; ?>" data-speed="300">
        <?php echo isset($pending_disposes) ? $pending_disposes : 0; ?>
      </span>
      <h3 class="counter highlight" data-from="0" data-to="<?php echo isset($pending_disposes) ? $pending_disposes : 0; ?>" data-speed="350">
        <?php echo isset($pending_disposes) ? $pending_disposes : 0; ?>
      </h3>
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
              <p style="margin:0;"><strong>Location:</strong> ${pin.address}</p>
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
          <?php if(isset($logs_query) && is_array($logs_query)): ?>
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
            <li><span class="grey">No recent activity</span></li>
          <?php endif; ?>
        </ul>
      </div>
      <br>
      <div class="row">
        <div class="col-sm-12">
          <button class="btn btn-success" onclick="showLogsUrl('<?php echo base_url(); ?>collector/logs')">
            See all logs
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
function showLogsUrl(url=null) {
  if(url) {
    location.replace(url);
  }
}

// Initialize calendar with events
jQuery('.events_calendar').fullCalendar({
  header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month,agendaWeek,agendaDay,listWeek'
  },
  editable: true,
  firstDay: 1,
  height: 530,
  droppable: false,
  eventLimit: true,
  navLinks: true,
  aspectRatio: 1,
  events: <?php echo json_encode(isset($calendar_events) ? $calendar_events : []); ?>
});
</script>