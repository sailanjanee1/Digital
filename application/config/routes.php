<?php
$route['default_controller'] = 'user';
$route['register'] = 'user/register';
$route['login'] = 'user/login';
 
$route['news'] = 'school';
$route['news/create'] = 'news/create';
 
$route['news/edit/(:any)'] = 'news/edit/$1';
 
$route['news/view/(:any)'] = 'news/view/$1';
$route['news/(:any)'] = 'news/view/$1';


$route['school'] = "school/index";
$route['school/create'] = "school/create";
$route['school/store']['post'] = "school/store";
$route['school/edit/(:num)'] = "school/edit/$1";
$route['school/update/(:num)']['put'] = "school/update/$1";
$route['school/delete/(:num)']['delete'] = "school/delete/$1";

?>
