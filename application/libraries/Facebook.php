<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (session_status() == PHP_SESSION_NONE) {
    echo "session";die;
    session_start();
}

require_once( __DIR__ . '/Vendor/Facebook/GraphObject.php' );
require_once( __DIR__ . '/Vendor/Facebook/GraphSessionInfo.php' );
require_once( __DIR__ . '/Vendor/Facebook/FacebookSession.php' );
require_once( __DIR__ . '/Vendor/Facebook/FacebookCurl.php' );
require_once( __DIR__ . '/Vendor/Facebook/FacebookHttpable.php' );
require_once( __DIR__ . '/Vendor/Facebook/FacebookCurlHttpClient.php' );
require_once( __DIR__ . '/Vendor/Facebook/FacebookResponse.php' );
require_once( __DIR__ . '/Vendor/Facebook/FacebookSDKException.php' );
require_once( __DIR__ . '/Vendor/Facebook/FacebookRequestException.php' );
require_once( __DIR__ . '/Vendor/Facebook/FacebookAuthorizationException.php' );
require_once( __DIR__ . '/Vendor/Facebook/FacebookRequest.php' );
require_once( __DIR__ . '/Vendor/Facebook/FacebookRedirectLoginHelper.php' );

use Facebook\GraphSessionInfo;
use Facebook\FacebookSession;
use Facebook\FacebookCurl;
use Facebook\FacebookHttpable;
use Facebook\FacebookCurlHttpClient;
use Facebook\FacebookResponse;
use Facebook\FacebookAuthorizationException;
use Facebook\FacebookRequestException;
use Facebook\FacebookRequest;
use Facebook\FacebookSDKException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\GraphObject;

class Facebook {

    var $ci;
    var $helper;
    var $session;

    public function __construct() {
        $this->ci = & get_instance();
        FacebookSession::setDefaultApplication($this->ci->config->item('api_id', 'facebook'), $this->ci->config->item('app_secret', 'facebook'));
        $this->helper = new FacebookRedirectLoginHelper($this->ci->config->item('redirect_url', 'facebook'));

        if ($this->ci->session->userdata('fb_token')) {
            echo "if";;
            $this->session = new FacebookSession($this->ci->session->userdata('fb_token'));

            // Validate the access_token to make sure it's still valid
            try {
                echo "if try";
                if (!$this->session->validate()) {
                    echo "if try if";
                    $this->session = false;
                }
            } catch (Exception $e) {
                // Catch any exceptions
                $this->session = false;
                echo "if catch";
            }
        } else {
            echo "else";
            try {                
                $this->session = $this->helper->getSessionFromRedirect();
                echo "else try";
            } catch (FacebookRequestException $ex) {
                echo "else catch1";
                // When Facebook returns an error
            } catch (\Exception $ex) {
                echo "else catch2";
                // When validation fails or other local issues
            }
        }

        if ($this->session) {
            $this->ci->session->set_userdata('fb_token', $this->session->getToken());

            $this->session = new FacebookSession($this->session->getToken());
        }
    }

    public function get_login_url() {
        return $this->helper->getLoginUrl($this->ci->config->item('permissions', 'facebook'));
    }

    public function get_logout_url() {
        if ($this->session) {
            $this->ci->session->set_userdata('fb_token', "");
            return $this->helper->getLogoutUrl($this->session, base_url() . 'login');
        }
        return false;
    }

    public function get_user() {
        if ($this->session) {
            echo "if";
            try {
                $request = (new FacebookRequest($this->session, 'GET', '/me?fields=id,name,email,first_name,last_name,education,gender,location'))->execute();
                $user = $request->getGraphObject()->asArray();
                pr($user);
                return $user;
            } catch (FacebookRequestException $e) {
                return false;
            }
        }else{
            echo "else";die;
        }
    }

}
