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
$route['default_controller'] = 'admin/admin';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * admin
 */
$route['dashboard'] = 'admin/admin/index';
$route['login'] = 'auth/auth';
$route['test'] = 'admin/test/index';
$route['admin/logout'] = 'admin/admin/admin_logout';


/*
 * activities routes
 */
$route['activities/all-activities'] = 'admin/activities/all_activities';
$route['activities/add-activity'] = 'admin/activities/add_activity';


/*
 * business-types routes
 */
$route['business-types/all-business-types'] = 'admin/business_types/index';
$route['business-types/add-business-types'] = 'admin/business_types/add_business_type';
$route['business-types/all-business-types/(:any)/(:any)'] = 'admin/business_types/index/$1/$2';
$route['business-types/all-business-types/(:any)/(:any)/(:num)'] = 'admin/business_types/index/$1/$2/$3';

/*
 * propietors routes
 */
$route['proprietors/all-proprietors'] = 'admin/proprietors/index';
$route['proprietors/add-proprietors'] = 'admin/proprietors/add_proprietor';
$route['proprietors/close-form'] = 'admin/proprietors/close_form';