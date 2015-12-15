<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['newdelivery'] 							= 'inventory/newdelivery';

$route['factory/stock'] 						= 'inventory/stock';
$route['factory/editdelivery/(:any)'] 			= 'inventory/editdelivery/$1';
$route['factory/printdelivery/(:any)'] 			= 'inventory/printdelivery/$1';
$route['factory/printchallan/(:any)'] 			= 'inventory/printchallan/$1';
$route['factory/delivery'] 						= 'inventory/delivery';

$route['commercial/lcstatements'] 				= 'marketing/lcstatements';
$route['commercial/editlcstatements/(:any)'] 	= 'marketing/editlcstatements/$1';
$route['commercial/updatelcstatements'] 		= 'marketing/updatelcstatements';

$route['commercial/expissues'] 					= 'marketing/expissues';
$route['commercial/dataexpissues'] 				= 'marketing/dataexpissues';
$route['commercial/addexp'] 					= 'marketing/addexp';
$route['commercial/addexpissues'] 				= 'marketing/addexpissues';
$route['commercial/editexpissues/(:any)'] 		= 'marketing/editexpissues/$1';
$route['commercial/updateexpissues'] 			= 'marketing/updateexpissues';
$route['commercial/deleteexpissues/(:any)'] 	= 'marketing/deleteexpissues/$1';


$route['settings/products/article'] 			= 'article';
$route['settings/products/construction'] 		= 'construction';
$route['settings/products/width'] 				= 'width';
$route['settings/products/softness'] 			= 'softness';
$route['settings/products/color'] 				= 'color';
$route['settings/products/source'] 				= 'source';
$route['settings/products/description'] 		= 'description';

$route['settings/address'] 						= 'address';
$route['settings/addressprice'] 				= 'addressprice';
$route['settings/price'] 						= 'price';
$route['settings/issuetype'] 					= 'issue';

$route['admin/users'] 							= 'user';
$route['admin/groups'] 							= 'groups';

$route['default_controller'] 					= 'dashboard/index';
$route['404_override'] 							= '';


/* End of file routes.php */
/* Location: ./application/config/routes.php */