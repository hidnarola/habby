<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  |--------------------------------------------------------------------------
  | Display Debug backtrace
  |--------------------------------------------------------------------------
  |
  | If set to TRUE, a backtrace will be displayed along with php errors. If
  | error_reporting is disabled, the backtrace will not display, regardless
  | of this setting
  |
 */
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
  |--------------------------------------------------------------------------
  | File and Directory Modes
  |--------------------------------------------------------------------------
  |
  | These prefs are used when checking and setting modes when working
  | with the file system.  The defaults are fine on servers with proper
  | security, but you may wish (or even need) to change the values in
  | certain environments (Apache running a separate process for each
  | user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
  | always be used to set the mode correctly.
  |
 */
defined('FILE_READ_MODE') OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') OR define('DIR_WRITE_MODE', 0755);

/*
  |--------------------------------------------------------------------------
  | File Stream Modes
  |--------------------------------------------------------------------------
  |
  | These modes are used when working with fopen()/popen()
  |
 */
defined('FOPEN_READ') OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
  |--------------------------------------------------------------------------
  | Exit Status Codes
  |--------------------------------------------------------------------------
  |
  | Used to indicate the conditions under which the script is exit()ing.
  | While there is no universal standard for error codes, there are some
  | broad conventions.  Three such conventions are mentioned below, for
  | those who wish to make use of them.  The CodeIgniter defaults were
  | chosen for the least overlap with these conventions, while still
  | leaving room for others to be defined in future versions and user
  | applications.
  |
  | The three main conventions used for determining exit status codes
  | are as follows:
  |
  |    Standard C/C++ Library (stdlibc):
  |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
  |       (This link also contains other GNU-specific conventions)
  |    BSD sysexits.h:
  |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
  |    Bash scripting:
  |       http://tldp.org/LDP/abs/html/exitcodes.html
  |
 */
defined('EXIT_SUCCESS') OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

$servername = isset($_SERVER['SERVER_NAME'])?$_SERVER['SERVER_NAME']:'';
if ($servername == 'habby') {
    defined('Asset_path') OR define('Asset_path', 'http://habby/');
    defined("ROOT_PATH") OR define("ROOT_PATH","c:/wamp/www/habby/");
    defined("WS_SOCKET_SERVER") OR define("WS_SOCKET_SERVER","ws://192.168.1.186:9300");
} else if($servername == "clientapp.narola.online") {
    defined('Asset_path') OR define('Asset_path', 'http://clientapp.narola.online/HD/habby/');
    defined("ROOT_PATH") OR define("ROOT_PATH","D:/wamp/www/HD/habby/");
    defined("WS_SOCKET_SERVER") OR define("WS_SOCKET_SERVER","ws://192.168.1.186:9300");
}
else
{
    defined('Asset_path') OR define('Asset_path', 'https://www.habby-go.com/');
    defined("ROOT_PATH") OR define("ROOT_PATH","");
    defined("WS_SOCKET_SERVER") OR define("WS_SOCKET_SERVER","wss://habby-go.com/chat");
}

defined('DEFAULT_IMAGE_PATH') OR define('DEFAULT_IMAGE_PATH', Asset_path . 'public/front/img/'); // highest automatically-assigned error code
defined('DEFAULT_PROFILE_IMAGE_PATH') OR define('DEFAULT_PROFILE_IMAGE_PATH', Asset_path . 'uploads/user_profile/'); // highest automatically-assigned error code
defined('DEFAULT_CHAT_IMAGE_PATH') OR define('DEFAULT_CHAT_IMAGE_PATH', Asset_path . 'uploads/chat_media/');
defined('DEFAULT_EVENT_MEDIA_PATH') OR define('DEFAULT_EVENT_MEDIA_PATH', Asset_path . 'uploads/event_post/');
defined('DEFAULT_BANNER_IMAGE_PATH') OR define('DEFAULT_BANNER_IMAGE_PATH', Asset_path . 'uploads/banners/'); // highest automatically-assigned error code
defined('DEFAULT_POST_IMAGE_PATH') OR define('DEFAULT_POST_IMAGE_PATH', Asset_path . 'uploads/user_post/'); // highest automatically-assigned error code
defined('DEFAULT_CHALLENGE_IMAGE_PATH') OR define('DEFAULT_CHALLENGE_IMAGE_PATH', Asset_path . 'uploads/challenge_post/'); // highest automatically-assigned error code
defined('DEFAULT_TOPICHAT_IMAGE_PATH') OR define('DEFAULT_TOPICHAT_IMAGE_PATH', Asset_path . 'uploads/topichat_group/'); // highest automatically-assigned error code
defined('DEFAULT_SOULMATE_IMAGE_PATH') OR define('DEFAULT_SOULMATE_IMAGE_PATH', Asset_path . 'uploads/soulmate_group/'); // highest automatically-assigned error code
defined('DEFAULT_GROUPPLAN_IMAGE_PATH') OR define('DEFAULT_GROUPPLAN_IMAGE_PATH', Asset_path . 'uploads/group_plan/'); // highest automatically-assigned error code
defined('DEFAULT_LEAGUE_IMAGE_PATH') OR define('DEFAULT_LEAGUE_IMAGE_PATH', Asset_path . 'uploads/league/');
defined('DEFAULT_JS_PATH') OR define('DEFAULT_JS_PATH', Asset_path . 'public/front/js/'); // highest automatically-assigned error code
defined('DEFAULT_CSS_PATH') OR define('DEFAULT_CSS_PATH', Asset_path . 'public/front/css/'); // highest automatically-assigned error code
defined('DEFAULT_EMOGI_PATH') OR define('DEFAULT_EMOGI_PATH', Asset_path . 'public/front/includes/emoticons/'); // highest automatically-assigned error code
defined('DEFAULT_CHAT_DOC_PATH') OR define('DEFAULT_CHAT_DOC_PATH', Asset_path . 'public/chat/'); // highest automatically-assigned error code
defined('DEFAULT_CHAT_MEDIA_PATH') OR define('DEFAULT_CHAT_MEDIA_PATH', Asset_path . 'uploads/chat_media/'); // highest automatically-assigned error code
defined('USER_JS') or define('USER_JS', Asset_path . 'public/front/includes/');


defined('DEFAULT_ADMIN_IMAGE_PATH') OR define('DEFAULT_ADMIN_IMAGE_PATH', Asset_path . 'public/back/img/'); // highest automatically-assigned error code
defined('DEFAULT_ADMIN_JS_PATH') OR define('DEFAULT_ADMIN_JS_PATH', Asset_path . 'public/back/js/'); // highest automatically-assigned error code
defined('DEFAULT_ADMIN_CSS_PATH') OR define('DEFAULT_ADMIN_CSS_PATH', Asset_path . 'public/back/css/'); // highest automatically-assigned error code
defined('DEFAULT_ADMIN_CKEDITOR_PATH') OR define('DEFAULT_ADMIN_CKEDITOR_PATH', Asset_path . 'public/back/ckeditor/'); // highest automatically-assigned error code

