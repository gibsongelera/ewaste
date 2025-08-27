<h2>Map</h2>
<div id="map" style="height: 500px; width: 100%;"></div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var script = document.createElement('script');
  script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB3rwqujTHETw5DjpFJ3h4qSWO3ak9mJq0&libraries=places&callback=initMap';
  script.async = true;
  script.defer = true;
  document.body.appendChild(script);
});

let map, marker;
window.initMap = function() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: { lat: 6.9214, lng: 122.0790 },
    zoom: 12,
    mapId: '2216e6e19a396f7914d973a3',
    mapTypeId: 'roadmap'
  });
  map.addListener('click', function(e) {
    placeMarker(e.latLng, map);
    savePin(e.latLng.lat(), e.latLng.lng());
  });
  fetch('<?php echo base_url('client/get_pin'); ?>')
    .then(response => response.json())
    .then(pin => {
      if (pin && pin.lat && pin.lng) {
        placeMarker(new google.maps.LatLng(pin.lat, pin.lng), map);
        map.setCenter({lat: parseFloat(pin.lat), lng: parseFloat(pin.lng)});
      } else {
        placeMarker(new google.maps.LatLng(6.9214, 122.0790), map);
      }
    })
    .catch(()=>{
      placeMarker(new google.maps.LatLng(6.9214, 122.0790), map);
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
  fetch('<?php echo base_url('client/save_pin'); ?>', {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ lat: lat, lng: lng })
  });
}
</script>
