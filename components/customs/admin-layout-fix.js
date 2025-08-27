// Admin Layout Fix - Prevents vertical text display
(function() {
    'use strict';
    
    // Function to fix text orientation
    function fixTextOrientation() {
        // Fix all text elements in admin dashboard
        var adminElements = document.querySelectorAll('.admin h1, .admin h2, .admin h3, .admin h4, .admin h5, .admin h6, .dashboard-page-title, .module-title, .sparklines-title');
        
        adminElements.forEach(function(element) {
            // Remove any transform styles
            element.style.transform = 'none';
            element.style.webkitTransform = 'none';
            element.style.mozTransform = 'none';
            element.style.msTransform = 'none';
            element.style.oTransform = 'none';
            
            // Set proper writing mode
            element.style.writingMode = 'horizontal-tb';
            element.style.webkitWritingMode = 'horizontal-tb';
            element.style.mozWritingMode = 'horizontal-tb';
            element.style.msWritingMode = 'horizontal-tb';
            
            // Set proper text orientation
            element.style.textOrientation = 'mixed';
            element.style.webkitTextOrientation = 'mixed';
            element.style.mozTextOrientation = 'mixed';
            
            // Ensure proper display
            element.style.display = 'block';
        });
        
        // Fix any container elements that might be causing issues
        var containers = document.querySelectorAll('.admin .row, .admin .col-md-4, .admin .col-md-8, .admin .text-md-right');
        containers.forEach(function(container) {
            container.style.transform = 'none';
            container.style.writingMode = 'horizontal-tb';
            container.style.textOrientation = 'mixed';
        });
    }
    
    // Run fix when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', fixTextOrientation);
    } else {
        fixTextOrientation();
    }
    
    // Run fix after a short delay to catch any dynamic content
    setTimeout(fixTextOrientation, 100);
    setTimeout(fixTextOrientation, 500);
    setTimeout(fixTextOrientation, 1000);
    
    // Run fix when window loads
    window.addEventListener('load', fixTextOrientation);
    
    // Run fix periodically to catch any dynamically added content
    setInterval(fixTextOrientation, 2000);
    
})();
