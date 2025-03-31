<?php
/**
 * Plugin Name: WhatsApp Agent Messaging
 * Description: This plugin allows agents to send messages via their own WhatsApp number from the website.
 * Version: 1.0
 * Author: Your Name
 */

function wam_enqueue_scripts() {
    wp_enqueue_script('wam_script', plugin_dir_url(__FILE__) . 'assets/js/wam_script.js', array('jquery'), null, true);
    wp_enqueue_style('wam_styles', plugin_dir_url(__FILE__) . 'assets/css/styles.css');
}
add_action('wp_enqueue_scripts', 'wam_enqueue_scripts');

function wam_message_form() {
    ob_start(); ?>
    <div class="whatsapp-message-form">
        <h3>Send a WhatsApp Message</h3>
        <form id="whatsapp-form" action="" method="POST">
            <textarea name="message" placeholder="Enter your message here..." required></textarea>
            <button type="submit" name="send_message">Send Message</button>
        </form>
        <div id="response"></div>
    </div>
    <?php
    return ob_get_clean();
}
add_shortcode('whatsapp_message_form', 'wam_message_form');

function wam_handle_form_submission() {
    if (isset($_POST['send_message'])) {
        $message = sanitize_text_field($_POST['message']);
        $agent_number = get_current_user_id(); // Use agent's ID as their mobile number or customize accordingly

        $response = wam_send_whatsapp_message($agent_number, $message);
        echo '<script>document.getElementById("response").innerHTML = "' . esc_html($response) . '";</script>';
    }
}
add_action('init', 'wam_handle_form_submission');
add_action('wp_ajax_wam_send_message', 'wam_handle_form_submission');

function wam_send_whatsapp_message($agent_number, $message) {
    // Replace this simulation with actual integration using Selenium, Ultramsg, or another method.
    return 'Message sent successfully to WhatsApp number ' . $agent_number;
}
?>
