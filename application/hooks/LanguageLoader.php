<?php

class LanguageLoader {

    function initialize() {
        $ci = & get_instance();
        $ci->load->helper('language');
        $ci->load->library('session');
        $language_c = get_cookie('language');
        if (isset($language_c)) {
            $ci->session->set_userdata('language', $language_c);
        } else {
            if ($ci->session->userdata('language') == FALSE) {
                $ci->session->set_userdata('language', 'english');
            }
        }
        $language = $ci->session->userdata('language');
        $ci->lang->load('message', 'english');
        if ($language == 'french') {
            $ci->lang->load('message', 'french');
        } else if ($language == 'russian') {
            $ci->lang->load('message', 'russian');
        }
    }

}
