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
$route['default_controller'] = 'home';
$route['404_override'] = 'errors';
$route['translate_uri_dashes'] = FALSE;
//STUDENTS
$route['view-students'] = "students/view_students";
$route['view-students'] = "students/view_students";
$route['view-student'] = "students/view_students";
$route['add-student']['GET'] = "students/add_student";
$route['add-student']['POST'] = "students/add_student_submission";

$route['edit-student/(:any)'] = "students/edit_student/$1";
$route['edit-student/parent/(:any)'] = "students/edit_student_parent/$1";
$route['edit-student/previous/(:any)'] = "students/edit_student_previous/$1";
$route['edit-student/doc/(:any)'] = "students/edit_student_doc/$1";

$route['view-student/(:any)'] = "students/view_student/$1";

$route['user_login'] = "login/login_submission";
$route['user_update'] = "login/user_update";
$route['user_forgot_password'] = "login/forgot_password";
$route['my_bookings'] = "login/my_bookings";
$route['my_account'] = "login/my_account";
$route['logout'] = "login/logout";

//API
$route['api/get_all_student'] = "api/get_all_student";
$route['api/get_student'] = "api/get_student";
$route['api/get_student_pagination'] = "api/get_student_pagination";
$route['api/get_parents_list'] = "api/get_parents_list";
$route['api/update_student_status'] = "api/update_student_status";
$route['api/delete_student'] = "api/delete_student";
$route['api/get_states_by_country'] = "api/get_states_by_country";
$route['api/get_cities_by_state'] = "api/get_cities_by_state";
$route['api/add-student'] = "api/add_student";
$route['api/add-parent'] = "api/add_parent";

