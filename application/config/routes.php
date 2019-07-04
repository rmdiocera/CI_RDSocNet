<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['feed/(:any)'] = 'feed/post/$1';
$route['feed/(:num)'] = 'feed/index/$1';	
$route['logout'] = 'users/logout';
$route['login'] = 'users/login';
$route['register'] = 'users/register';
$route['post/(:any)'] = 'nf_post/post/$1';
$route['feed'] = 'feed/index';
$route['about'] = 'pages/about';
// $route['default_controller'] = 'feed/index';
$route['default_controller'] = 'pages/home';
// $route['(:any)'] = 'feed/index/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
