<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $route['feed/(:any)'] = 'feed/post/$1';
$route['post/(:any)'] = 'nf_post/post/$1';
$route['default_controller'] = 'feed/index';
$route['(:any)'] = 'feed/index/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
