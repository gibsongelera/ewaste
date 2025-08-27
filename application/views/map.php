<!DOCTYPE html>
<h2>Map</h2>
<div id="map" style="height: 500px; width: 100%;"></div>
<script>
// Wait for DOM ready
document.addEventListener('DOMContentLoaded', function() {
  // Dynamically load Google Maps script with callback
  var script = document.createElement('script');
  script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB3rwqujTHETw5DjpFJ3h4qSWO3ak9mJq0&libraries=places&callback=initMap';
  script.async = true;
  script.defer = true;
  document.body.appendChild(script);
});

let map, marker;
window.initMap = function() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: { lat: 6.9214, lng: 122.0790 }, // Zamboanga City, Philippines
    zoom: 12,
    mapId: '2216e6e19a396f7914d973a3',
    mapTypeId: 'roadmap'
  });
  map.addListener('click', function(e) {
    placeMarker(e.latLng, map);
    savePin(e.latLng.lat(), e.latLng.lng());
  });
  // Try to load user's pin if available
  fetch(window.location.origin + '/e-waste-master/client/get_pin')
    .then(response => {
      if (!response.ok) throw new Error('404');
      return response.json();
    })
    .then(pin => {
      if (pin && pin.lat && pin.lng) {
        placeMarker(new google.maps.LatLng(pin.lat, pin.lng), map);
        map.setCenter({lat: parseFloat(pin.lat), lng: parseFloat(pin.lng)});
      } else {
        // Place a test marker at Zamboanga City by default
        placeMarker(new google.maps.LatLng(6.9214, 122.0790), map);
      }
    })
    .catch((err)=>{
      // Place a test marker at Zamboanga City if fetch fails
      placeMarker(new google.maps.LatLng(6.9214, 122.0790), map);
      // Show a friendly error if 404
      if (err && err.message === '404') {
        const msg = document.createElement('div');
        msg.style.color = 'red';
        msg.style.margin = '10px 0';
        msg.textContent = 'User pin endpoint not found (404). Map loaded with default location.';
        document.body.insertBefore(msg, document.getElementById('map'));
      }
    });
}
function placeMarker(position, map) {
  if (marker) marker.setMap(null);
  marker = new google.maps.Marker({
    position: position,
    map: map
  });
}
function savePin(lat, lng) {
  fetch(window.location.origin + '/e-waste-master/client/save_pin', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ lat: lat, lng: lng })
  });
}
</script>
