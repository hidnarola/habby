<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
  | -------------------------------------------------------------------------
  | URI ROUTING
  | -------------------------------------------------------------------------
  | This file lets you re-map URI requests to specific controller functions.
  |
  | Typically there is a one-to-one relationship between a URL string
  | and its corresponding controller class/method. The segments in a
  | URL normally follow this pattern:
  |
  |	example.com/class/method/id/
  |
  | In some instances, however, you may want to remap this relationship
  | so that a different class/function is called than the one
  | corresponding to the URL.
  |
  | Please see the user guide for complete details:
  |
  |	https://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There are three reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router which controller/method to use if those
  | provided in the URL cannot be matched to a valid route.
  |
  |	$route['translate_uri_dashes'] = FALSE;
  |
  | This is not exactly a route, but allows you to automatically route
  | controller and method names that contain dashes. '-' isn't a valid
  | class or method name character, so it requires translation.
  | When you set this option to TRUE, it will replace ALL dashes in the
  | controller and method URI segments.
  |
  | Examples:	my-controller/index	-> my_controller/index
  |		my-controller/my-method	-> my_controller/my_method
 */
// ------------------------------------------------------------------------
// ------------------------------------------------------------------------
$route['login'] = "login/index";
$route['register'] = "login/register";

$route["home"] = "user/home";
$route["home/(:any)"] = "user/home/$1";

$route["post"] = "user/post";
$route["post/(:any)"] = "user/post/$1";
$route["post/(:any)/(:any)"] = "user/post/$1/$2";

$route["topichat"] = "user/topichat";
$route["topichat/(:any)"] = "user/topichat/$1";
$route["topichat/(:any)/(:any)"] = "user/topichat/$1/$2";

$route["soulmate"] = "user/soulmate";
$route["soulmate/(:any)"] = "user/soulmate/$1";
$route["soulmate/(:any)/(:any)"] = "user/soulmate/$1/$2";

$route["groupplan"] = "user/groupplan";
$route["groupplan/(:any)"] = "user/groupplan/$1";
$route["groupplan/(:any)/(:any)"] = "user/groupplan/$1/$2";

$route["league"] = "user/league";
$route["league/(:any)"] = "user/league/$1";
$route["league/(:any)/(:any)"] = "user/league/$1/$2";

$route["challenge"] = "user/challenge";
$route["challenge/(:any)"] = "user/challenge/$1";
$route["challenge/(:any)/(:any)"] = "user/challenge/$1/$2";

$route['user/forgot_password'] = "user/user/forgot_password";
$route['user/(:any)'] = "user/user/$1";
$route['user/reset_password/(:any)'] = "user/user/reset_password/$1";
$route['user/verify_email/(:any)'] = "user/user/verify_email/$1";
$route['user_profile/topichat/(:any)'] = 'user/Home/topichat/$1';
$route['user_profile/challenges/(:any)'] = 'user/Home/challenges/$1';
$route['user_profile/league/(:any)'] = 'user/Home/league/$1';
$route['user_profile/(:any)'] = "user/Home/user_profile/$1";

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/* Routes For the Admin Start */
$route['admin'] = "admin/login";
$route['admin/logout'] = "admin/dashboard/log_out";
$route['admin/edit_profile'] = "admin/dashboard/edit";
$route['admin/change_password'] = "admin/dashboard/change_password";
$route['admin/(:any)'] = "admin/$1";

$route['admin/(:any)/add'] = 'admin/$1/edit';
$route['admin/(:any)/(:any)'] = "admin/$1/$2";

$route['admin/(:any)/delete/(:any)'] = 'admin/$1/action/delete/$2';
$route['admin/(:any)/activate/(:any)'] = 'admin/$1/action/activate/$2';
$route['admin/(:any)/block/(:any)'] = 'admin/$1/action/block/$2';
$route['admin/(:any)/(:any)/(:any)'] = "admin/$1/$2/$3";