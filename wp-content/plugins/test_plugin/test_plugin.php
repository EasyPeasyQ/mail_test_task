<?php
/*
Plugin Name: test 
*/

define( 'LOG_FILE', ABSPATH  . 'wp-content/plugins/test_plugin/form.log' );

add_action( 'wp_ajax_send_email', 'send_email' );
add_action( 'wp_ajax_nopriv_send_email', 'send_email' );

function valid_email($str) {
    return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
}

function write_log($log) {
    file_put_contents(LOG_FILE, $log, FILE_APPEND);
}
 
function send_email() {
    if ($_POST['subject'] != '' && $_POST['email'] != '' && valid_email($_POST['email']) == TRUE && strlen($_POST['message']) > 1) {
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $firstname = $_POST['firstName'];
        $lastname = $_POST['lastName'];
        $to = 'example@example.com';
        $headers = array('Content-Type: text/html; charset=UTF-8');
        
        if(wp_mail($to, $subject, $message, $headers)) {

            $log = "[" . date('Y.m.d H:i:s') . "] Mail send - [email]: {$email}, [subject]: {$subject}\n";
            write_log($log);

            $arr = array(
                'properties' => array(
                    array(
                        'property' => 'email',
                        'value' => $email
                    ),
                    array(
                        'property' => 'firstname',
                        'value' => $firstname ? $firstname : null
                    ),
                    array(
                        'property' => 'lastname',
                        'value' => $lastname ? $lastname : null
                    )
                )
            );
            $post_json = json_encode($arr);
            $endpoint = 'https://api.hubapi.com/contacts/v1/contact?hapikey=' . HUBSPOT_KEY;
            $ch = @curl_init();
            @curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            @curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            @curl_setopt($ch, CURLOPT_POST, true);
            @curl_setopt($ch, CURLOPT_POSTFIELDS, $post_json);
            @curl_setopt($ch, CURLOPT_URL, $endpoint);
            @curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
            @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = @curl_exec($ch);
            $status_code = @curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curl_errors = curl_error($ch);
            @curl_close($ch);
            $send_response = array(
                "error" => false,
                "header" => "Success!",
                "message" => "The mail was sent successfully"
            );
            echo json_encode($send_response);
        } else {
            $send_response = array(
                "error" => true,
                "header" => "Error!",
                "message" => "An error occurred while sending the mail"
            );
            echo json_encode($send_response);
        }
    } else {
        $send_response = array(
            "error" => true,
            "header" => "Error!",
            "message" => "Empty requaered fields"
        );
        echo json_encode($send_response);
    }

    wp_die();
}