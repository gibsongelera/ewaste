// Admin Clients Page JavaScript
$(document).ready(function() {
    
    // Initialize DataTables for both tables
    $('#clients-table').DataTable({
        "responsive": true,
        "language": {
            "search": "Search clients:",
            "lengthMenu": "Show _MENU_ clients per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ clients",
            "infoEmpty": "Showing 0 to 0 of 0 clients",
            "infoFiltered": "(filtered from _MAX_ total clients)"
        }
    });
    
    $('#collectors-table').DataTable({
        "responsive": true,
        "language": {
            "search": "Search collectors:",
            "lengthMenu": "Show _MENU_ collectors per page",
            "info": "Showing _START_ to _END_ of _TOTAL_ collectors",
            "infoEmpty": "Showing 0 to 0 of 0 collectors",
            "infoFiltered": "(filtered from _MAX_ total collectors)"
        }
    });

    // Client form submission
    $('#regform').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('#message').html('<div class="alert alert-info">Adding client...</div>');
            },
            success: function(response) {
                if(response.success) {
                    $('#message').html('<div class="alert alert-success">' + response.messages + '</div>');
                    $('#regform')[0].reset();
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    $('#message').html('<div class="alert alert-danger">' + response.messages + '</div>');
                }
            },
            error: function() {
                $('#message').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
            }
        });
    });

    // Collector form submission
    $('#collector_regform').on('submit', function(e) {
        e.preventDefault();
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('#collector_message').html('<div class="alert alert-info">Adding collector...</div>');
            },
            success: function(response) {
                if(response.success) {
                    $('#collector_message').html('<div class="alert alert-success">' + response.messages + '</div>');
                    $('#collector_regform')[0].reset();
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    $('#collector_message').html('<div class="alert alert-danger">' + response.messages + '</div>');
                }
            },
            error: function() {
                $('#collector_message').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
            }
        });
    });

    // Tab switching with DataTable refresh
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var target = $(e.target).attr("href");
        if (target === '#tab1') {
            $('#clients-table').DataTable().columns.adjust().responsive.recalc();
        } else if (target === '#tab2') {
            $('#collectors-table').DataTable().columns.adjust().responsive.recalc();
        }
    });

    // Password strength indicator for collector form
    $('#collector_password').on('keyup', function() {
        var password = $(this).val();
        var strength = 0;
        
        if (password.length >= 6) strength++;
        if (password.match(/[a-z]/)) strength++;
        if (password.match(/[A-Z]/)) strength++;
        if (password.match(/[0-9]/)) strength++;
        if (password.match(/[^a-zA-Z0-9]/)) strength++;
        
        var strengthText = '';
        var strengthClass = '';
        
        switch(strength) {
            case 0:
            case 1:
                strengthText = 'Very Weak';
                strengthClass = 'danger';
                break;
            case 2:
                strengthText = 'Weak';
                strengthClass = 'warning';
                break;
            case 3:
                strengthText = 'Medium';
                strengthClass = 'info';
                break;
            case 4:
                strengthText = 'Strong';
                strengthClass = 'success';
                break;
            case 5:
                strengthText = 'Very Strong';
                strengthClass = 'success';
                break;
        }
        
        if (password.length > 0) {
            if (!$('#password-strength').length) {
                $('#collector_password').after('<div id="password-strength" class="help-block"></div>');
            }
            $('#password-strength').html('<span class="label label-' + strengthClass + '">' + strengthText + '</span>');
        } else {
            $('#password-strength').remove();
        }
    });

    // Confirm password match for collector form
    $('#collector_password2').on('keyup', function() {
        var password = $('#collector_password').val();
        var confirmPassword = $(this).val();
        
        if (confirmPassword.length > 0) {
            if (!$('#password-match').length) {
                $('#collector_password2').after('<div id="password-match" class="help-block"></div>');
            }
            
            if (password === confirmPassword) {
                $('#password-match').html('<span class="label label-success">Passwords match</span>');
            } else {
                $('#password-match').html('<span class="label label-danger">Passwords do not match</span>');
            }
        } else {
            $('#password-match').remove();
        }
    });

    // Clear messages when switching tabs
    $('a[data-toggle="tab"]').on('click', function() {
        $('#message').html('');
        $('#collector_message').html('');
        $('#password-strength').remove();
        $('#password-match').remove();
    });

});
