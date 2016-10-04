<?php

function pr($data, $is_die = null) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    if (!empty($is_die)) {
        die();
    }
}

function check_loggedin($data) {
    $CI = & get_instance();
    if (!empty($data['user_data'])) {
        $CI->Users_model->update_user_data($data['user_data']['id'], ['last_login' => date('Y-m-d H:i:s')]);
        redirect('home');
    }
}

?>