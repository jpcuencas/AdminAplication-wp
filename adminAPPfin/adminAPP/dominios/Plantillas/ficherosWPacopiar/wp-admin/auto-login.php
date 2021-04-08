<?php

require('../wp-load.php');
require('./includes/taxonomy.php');


if ($_POST) {
	
   /* header('Access-Control-Allow-Origin: *');*/

    $errors = array();

    $username = esc_sql($_REQUEST['username']);
    $password = esc_sql($_REQUEST['password']);
    $remember = esc_sql($_REQUEST['rememberme']);
    $remember = ($remember) ? "true" : "false";

    $login_data = array();
    $login_data['user_login'] = $username;
    $login_data['user_password'] = $password;
    $login_data['remember'] = $remember;
    $user_verify = wp_signon($login_data, true);

    if (is_wp_error($user_verify)) {
        $errors[] = 'Invalid username or password. Please try again!';
    } else {
        wp_set_auth_cookie($user_verify->ID);
        wp_redirect(admin_url());
        exit;
    }

}
?>
