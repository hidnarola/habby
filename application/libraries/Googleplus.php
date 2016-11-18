<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
set_include_path(__DIR__ . '/vendor/' . PATH_SEPARATOR . get_include_path());

class Googleplus {

    public function __construct() {

        $CI = & get_instance();
        require __DIR__ . '/vendor/Google/autoload.php';
        $cache_path = $CI->config->item('cache_path');
        $GLOBALS['apiConfig']['ioFileCache_directory'] = ($cache_path == '') ? APPPATH . 'cache/' : $cache_path;
        $this->client = new Google_Client();
        $this->client->setApplicationName('HabbyClient');
        $this->client->setClientId('133668988783-mvk4cfujidugai2gbj0kh1kfu1vhp86d.apps.googleusercontent.com');
        $this->client->setClientSecret('5J8BSsJC2J5gZYKWZo9u3-ik');
        
        $this->client->setRedirectUri(base_url().'/login/google_callback');
        $this->client->setDeveloperKey('AIzaSyCMB7rGcXMQgirVaq7epH6wS_usmzpdaPw');
        $this->client->setScopes(array('https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/plus.me'));
        $this->plus = new Google_Service_Plus($this->client);
    }

    public function __get($name) {
        if (isset($this->plus->$name)) {
            return $this->plus->$name;
        }
        return false;
    }

    public function __call($name, $arguments) {
        if (method_exists($this->plus, $name)) {
            return call_user_func(array($this->plus, $name), $arguments);
        }
        return false;
    }
}
?>
