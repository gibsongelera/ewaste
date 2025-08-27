<!-- Admin Dashboard Embedded Client Pin Map -->
<div class="with_border with_padding" style="margin-top:30px;">
    <h3 class="module-title darkgrey_bg_color">Client Pin Map</h3>
    <div id="admin-client-map" style="height: 400px; width: 100%;"></div>
    <div id="debug-info" style="margin-top:10px;"></div>
</div>

<script>
function initMap() {
    const map = new google.maps.Map(document.getElementById('admin-client-map'), {
        center: { lat: 6.9214, lng: 122.0790 },
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        mapTypeControl: true,
        streetViewControl: true,
        fullscreenControl: true
    });

    const bounds = new google.maps.LatLngBounds();
    const debugDiv = document.getElementById('debug-info');
    debugDiv.innerHTML = ''; // Clear previous debug info

    // Fetch and display client pins
    fetch('<?php echo base_url('admin/get_pins'); ?>', {
        headers: { 'Accept': 'application/json' }
    })
    .then(async response => {
        debugDiv.innerHTML += `Response status: ${response.status}<br>`;
        const text = await response.text();
        
        // Try to clean the response if it contains PHP errors
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
        console.log('Pins data:', pins);

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

                // Add info window with details
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
                    // Navigation: get user's location and open Google Maps directions
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
        console.error('Error:', error);
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
