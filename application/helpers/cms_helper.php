<?php

/**
 * This function is used print array in proper format.
 * develop by : HPA
 */
function pr($data, $is_die = null) {
    echo "<pre>";
    print_r($data);
    echo "</pre>";
    if (!empty($is_die)) {
        die();
    }
}

/**
 * This function is used to set details for send mail.
 * develop by : HPA
 */
function mail_config() {

    $configs = array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com',
        'smtp_port' => 465,
        'smtp_user' => 'demo.narola@gmail.com',
        'smtp_pass' => 'Ke6g7sE70Orq3Rqaqa',
        'transport' => 'Smtp',
        'charset' => 'utf-8',
        'newline' => "\r\n",
        'headerCharset' => 'iso-8859-1',
        'mailtype' => 'html'
    );

    return $configs;
}

function get_country_name($c_id = null) {
    if ($c_id != "") {
        $CI = & get_instance();
        $CI->db->select('nicename');
        $CI->db->where('id', $c_id);
        $res_data = $CI->db->get('country')->row_array();
        return $res_data['nicename'];
    }
    return false;
}

function logged_in_user_id() {
    $CI = & get_instance();
    $session_data = $CI->session->userdata('user');
    if (!empty($session_data)) {
        return $session_data['id'];
    } else {
        return false;
    }
}



?>