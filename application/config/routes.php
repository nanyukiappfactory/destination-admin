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
$route['activities/all-activities'] = 'admin/activities/index';
$route['activities/add-activity'] = 'admin/activities/add_activity';
$route['activities/all-activities/(:any)/(:any)'] = 'admin/activities/index/$1/$2';
$route['activities/all-activities/(:any)/(:any)/(:num)'] = 'admin/activities/index/$1/$2/$3';
$route['activities/search-activities'] = 'admin/activities/index';
$route['activities/delete-activity/(:num)'] = 'admin/activities/delete_activity/$1';
$route['activities/deactivate-activity/(:num)/(:num)'] = 'admin/activities/deactivate_activity/$1/$2';
$route['activities/activate-activity/(:num)/(:num)'] = 'admin/activities/activate_activity/$1/$2';
$route['activities/close-search'] = 'admin/activities/close_search';
$route['activities/edit-activity/(:num)'] = 'admin/activities/edit_activity/$1';


/*
 * business-types routes
 */
$route['business-types/all-business-types'] = 'admin/business_types/index';
$route['business-types/add-business-types'] = 'admin/business_types/add_business_type';
$route['business-types/edit-business-types/(:num)'] = 'admin/business_types/edit_business_type/$1';
$route['business-types/deactivate-business-types/(:num)/(:num)'] = 'admin/business_types/deactivate_business_type/$1/$2';
$route['business-types/activate-business-types/(:num)/(:num)'] = 'admin/business_types/activate_business_type/$1/$2';
$route['business-types/all-business-types/(:any)/(:any)'] = 'admin/business_types/index/$1/$2';
$route['business-types/delete-business-types/(:num)'] = 'admin/business_types/delete_business_type/$1';  
$route['business-types/all-business-types/(:any)/(:any)/(:num)'] = 'admin/business_types/index/$1/$2/$3';
$route['business-types/search-business-types'] = 'admin/business_types/search_business_type';
$route['business-types/close-search'] = 'admin/business_types/close_search';
/*
 * propietors routes
 */
$route['proprietors/all-proprietors'] = 'admin/proprietors/index';
$route['proprietors/all-proprietors/(:any)/(:any)'] = 'admin/proprietors/index/$1/$2';
$route['proprietors/all-proprietors/(:any)/(:any)/(:num)'] = 'admin/proprietors/index/$1/$2/$3';
$route['proprietors/add-proprietors'] = 'admin/proprietors/add_proprietor';
$route['proprietors/search-proprietors'] = 'admin/proprietors/search_proprietor';
$route['proprietors/close-search'] = 'admin/proprietors/close_search';
$route['proprietors/edit-proprietors/(:num)'] = 'admin/proprietors/edit_proprietor/$1';
$route['proprietors/delete-proprietors/(:num)'] = 'admin/proprietors/delete_proprietor/$1';
$route['proprietors/activate-proprietors/(:num)/(:num)'] = 'admin/proprietors/activate_proprietor/$1/$2';
$route['proprietors/deactivate-proprietors/(:num)/(:num)'] = 'admin/proprietors/deactivate_proprietor/$1/$2';
