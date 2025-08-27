<h2>User Pins Map</h2>
<div id="map" style="height: 500px; width: 100%;"></div>
<script>
function loadGoogleMapsScript(callback) {
  if (typeof google !== 'undefined' && google.maps) {
    callback();
    return;
  }
  var script = document.createElement('script');
  script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyB3rwqujTHETw5DjpFJ3h4qSWO3ak9mJq0&libraries=places&callback=initMap';
  script.async = true;
  script.defer = true;
  window.initMap = callback;
  document.body.appendChild(script);
}

function initMap() {
  var map = new google.maps.Map(document.getElementById('map'), {
    center: { lat: 6.9214, lng: 122.0790 }, // Zamboanga City, Philippines
    zoom: 12,
    mapId: '2216e6e19a396f7914d973a3',
    mapTypeId: 'roadmap'
  });
  // Fetch all user pins for admin
  fetch('<?php echo base_url('admin/get_pins'); ?>')
    .then(response => {
      if (!response.ok) {
        console.error('Failed to fetch pins:', response.status, response.statusText);
        throw new Error('Network response was not ok');
      }
      return response.json();
    })
    .then(data => {
      console.log('Fetched pins:', data);
      if (!Array.isArray(data)) {
        console.error('Pin data is not an array:', data);
        return;
      }
      data.forEach(pin => {
        if (!pin.lat || !pin.lng) {
          console.warn('Invalid pin data:', pin);
          return;
        }
        new google.maps.Marker({
          position: { lat: parseFloat(pin.lat), lng: parseFloat(pin.lng) },
          map: map
        });
      });
    })
    .catch(err => {
      console.error('Error fetching or displaying pins:', err);
    });
}

document.addEventListener('DOMContentLoaded', function() {
  loadGoogleMapsScript(initMap);
});
</script>
