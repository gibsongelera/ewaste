<?php
// Collector Map View - based on admin_map.php
?>
<div class="container">
    <h2>Collector Map</h2>
    <p>This is the collector's map interface. Only collectors can access this page.</p>
    <!-- You can add map logic here, or copy from admin_map.php if needed -->
    <?php 
    // Example: include the pin map embed if needed
    $this->load->view('backend/collector/_client_pin_map_embed'); 
    ?>
</div>
