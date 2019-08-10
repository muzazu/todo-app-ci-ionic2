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
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Mahasiswa Routes
$route['mahasiswa']['GET'] = 'MhsController/getMahasiswa';
$route['filtered-mahasiswa']['GET'] = 'MhsController/filteredMahasiswa';
$route['getcustom']['GET'] = 'MhsController/getCustom';
$route['mahasiswa']['POST'] = 'MhsController/saveMahasiswa';
$route['mahasiswa/(:any)']['get'] = 'MhsController/showMahasiswa/$1';
$route['mahasiswa/(:any)']['POST'] = 'MhsController/updateMahasiswa/$1';
$route['mahasiswa/(:any)']['DELETE'] = 'MhsController/deleteMahasiswa/$1';

//Dosen Routes
$route['dosen']['GET'] = 'DosenController/getDosen';
$route['dosen']['POST'] = 'DosenController/saveDosen';
$route['dosen/(:any)']['get'] = 'DosenController/showDosen/$1';
$route['dosen/(:any)']['POST'] = 'DosenController/updateDosen/$1';
$route['dosen/(:any)']['DELETE'] = 'DosenController/deleteDosen/$1';

//Matkul Routes
$route['matkul']['GET'] = 'MatkulController/getMatkul';
$route['matkul']['POST'] = 'MatkulController/saveMatkul';
$route['matkul/(:any)']['get'] = 'MatkulController/showMatkul/$1';
$route['matkul/(:any)']['POST'] = 'MatkulController/updateMatkul/$1';
$route['matkul/(:any)']['DELETE'] = 'MatkulController/deleteMatkul/$1';
$route['matkul_relation']['POST'] = 'MatkulController/relationMhs';
$route['matkul_relation/(:any)']['DELETE'] = 'MatkulController/deleteRelationMhs/$1';

//Group Routes
$route['group']['GET'] = 'GroupController/getGroup';
$route['group']['POST'] = 'GroupController/saveGroup';
$route['group/(:any)']['get'] = 'GroupController/showGroup/$1';
$route['group/(:any)']['POST'] = 'GroupController/updateGroup/$1';
$route['group/(:any)']['DELETE'] = 'GroupController/deleteGroup/$1';

//Grouplist Routes
$route['grouplist']['GET'] = 'GrouplistController/getGrouplist';
$route['grouplist']['POST'] = 'GrouplistController/saveGrouplist';
$route['grouplist/(:any)']['get'] = 'GrouplistController/showGrouplist/$1';
$route['grouplist/(:any)']['POST'] = 'GrouplistController/updateGrouplist/$1';
$route['grouplist/(:any)']['DELETE'] = 'GrouplistController/deleteGrouplist/$1';

//Todo Routes
$route['todo']['GET'] = 'TodoController/getTodo';
$route['todo']['POST'] = 'TodoController/saveTodo';
$route['todo/(:any)']['get'] = 'TodoController/showTodo/$1';
$route['todo/(:any)']['POST'] = 'TodoController/updateTodo/$1';
$route['todo/(:any)']['DELETE'] = 'TodoController/deleteTodo/$1';

//Comment Routes
$route['comment']['GET'] = 'CommentController/getComment';
$route['comment']['POST'] = 'CommentController/saveComment';
$route['comment/(:any)']['POST'] = 'CommentController/updateComment/$1';
$route['comment/(:any)']['DELETE'] = 'CommentController/deleteComment/$1';

//Login Routes
$route['login']['POST'] = 'LoginController/login';
$route['getToken']['POST'] = 'LoginController/decodeToken';