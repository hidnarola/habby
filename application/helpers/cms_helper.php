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
        'smtp_host' => 'ssl://smtp.googlemail.com',
        'smtp_port' => 465,
        'smtp_user' => 'hpa.narola@gmail.com',
        'smtp_pass' => 'narola21',
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

function curl_redir_exec($ch) {
    static $curl_loops = 0;
    static $curl_max_loops = 20;
    if ($curl_loops++ >= $curl_max_loops) {
        $curl_loops = 0;
        return FALSE;
    }
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    @list($header, $data) = @explode("\n\n", $data, 2);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    if ($http_code == 301 || $http_code == 302) {
        $matches = array();
        preg_match('/Location:(.*?)\n/', $header, $matches);
        $url = @parse_url(trim(array_pop($matches)));
        if (!$url) {
            //couldn't process the url to redirect to
            $curl_loops = 0;
            return $data;
        }
        $last_url = parse_url(curl_getinfo($ch, CURLINFO_EFFECTIVE_URL));
        if (!$url['scheme'])
            $url['scheme'] = $last_url['scheme'];
        if (!$url['host'])
            $url['host'] = $last_url['host'];
        if (!$url['path'])
            $url['path'] = $last_url['path'];
        $new_url = $url['scheme'] . '://' . $url['host'] . $url['path'] . (@$url['query'] ? '?' . $url['query'] : '');
        return $new_url;
    } else {
        $curl_loops = 0;
        return $data;
    }
}

function get_right_url($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    return curl_redir_exec($curl);
}

?>