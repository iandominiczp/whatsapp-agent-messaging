jQuery(document).ready(function($) {
    $('#whatsapp-form').submit(function(e) {
        e.preventDefault();
        var message = $('textarea[name="message"]').val();
        $.ajax({
            url: '/wp-admin/admin-ajax.php',
            type: 'POST',
            data: {
                action: 'wam_send_message',
                message: message
            },
            success: function(response) {
                $('#response').html(response);
            }
        });
    });
});
