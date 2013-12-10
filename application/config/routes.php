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

$route['default_controller'] = "homepage";
$route['404_override'] = '';

# HOMEPAGE
$route['homepage'] = "homepage/index";

# TEMPLATES
$route['templates'] = "templates";
$route['templates/(:any)'] = 'templates/$1';
$route['templates/(:any)/(:any)'] = 'templates/$1/$2';

# PRODUCTOS
$route['productos'] = "productos";
$route['productos/(:any)'] = 'productos/$1';
$route['productos/(:any)/(:any)'] = 'productos/$1/$2';

# ENTRADA DE STOCK
$route['entrada_stock'] = "entrada_stock";
$route['entrada_stock/(:any)'] = 'entrada_stock/$1';
$route['entrada_stock/(:any)/(:any)'] = 'entrada_stock/$1/$2';

# STOCK ACTUAL
$route['stock_actual'] = "stock_actual";
$route['stock_actual/(:any)'] = 'stock_actual/$1';
$route['stock_actual/(:any)/(:any)'] = 'stock_actual/$1/$2';


# MODELOS
// $route['models'] = 'all_models';
// $route['models/(:any)'] = 'all_models/$1';
// $route['models/(:any)/(:any)'] = 'all_models/$1/$2';



# FRONTEND -- TRABAJOS DESTACADOS
// $route['destacados'] = 'front_destacados';
// $route['destacados/(:any)'] = 'front_destacados/$1';
// $route['destacados/(:any)/(:any)'] = 'front_destacados/$1/$2';


/* End of file routes.php */
/* Location: ./application/config/routes.php */