<?php

add_action('wp_ajax_send_mail', 'send_mail');
add_action('wp_ajax_nopriv_send_mail', 'send_mail');

function send_mail() {
    var_dump($_POST['msg']);
    $msg = 'Name:' . $_POST['msg']['name'] . '<br> Email:' . $_POST['msg']['email'] . '<br> Phone:' . $_POST['msg']['phone'] . '<br> Hotel:' . $_POST['msg']['hotel'] . '<br> Message:' . $_POST['msg']['message'];
    wp_mail('milos.vasiljevic@zyrgon.com', 'subject', $msg);
    die();   
}
