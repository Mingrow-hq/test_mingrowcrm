<?php defined('BASEPATH') or exit('No direct script access allowed');
$route['publish/(:any)'] = 'zillapage/publishlandingpage/index/$1'; 
$route['publish/thankyou/(:any)'] = 'zillapage/publishlandingpage/thankyou/$1';//perfex-saas:start:my_routes.php
//dont remove/change above line
require_once(FCPATH.'modules/perfex_saas/config/my_routes.php');
//dont remove/change below line
//perfex-saas:end:my_routes.php//affiliate-management:start:my_routes.php
//dont remove/change above line
require_once(FCPATH.'modules/affiliate_management/config/my_routes.php');
//dont remove/change below line
//affiliate-management:end:my_routes.php
//poly_utilities:start:my_routes.php
//Do not delete or modify the code in this block
if (file_exists(FCPATH.'modules/poly_utilities/config/my_routes.php')) {require_once(FCPATH.'modules/poly_utilities/config/my_routes.php');}
//END: Do not delete or modify the code in this block
//poly_utilities:end:my_routes.php