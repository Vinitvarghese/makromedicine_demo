<?php
defined( 'BASEPATH' ) OR exit( 'No direct script access allowed' );

$route['default_controller']   = 'home';
$route['404_override']         = 'Errors/not_found';
$route['translate_uri_dashes'] = false;


/* Custom Routes */
$admin_url = 'admin';
//Dashboard
$route[ $admin_url ]                              = $admin_url . '/dashboard';
$route[ '^(\w{2})/' . $admin_url ]                = $admin_url . '/dashboard';
$route[ $admin_url . '/dashboard' ]               = $admin_url . '/dashboard';
$route[ '^(\w{2})/' . $admin_url . '/dashboard' ] = $admin_url . '/dashboard';

//Setting
$route[ $admin_url . '/setting' ]                      = $admin_url . '/setting';
$route[ '^(\w{2})/' . $admin_url . '/setting' ]        = $admin_url . '/setting';
$route[ $admin_url . '/setting/(:any)' ]               = $admin_url . '/setting/$1';
$route[ '^(\w{2})/' . $admin_url . '/setting/(:any)' ] = $admin_url . '/setting/$2';

//Filemanager
$route[ $admin_url . '/filemanager' ]                             = $admin_url . '/filemanager';
$route[ '^(\w{2})/' . $admin_url . '/filemanager' ]               = $admin_url . '/filemanager';
$route[ $admin_url . '/filemanager/(:any)' ]                      = $admin_url . '/filemanager/$1';
$route[ '^(\w{2})/' . $admin_url . '/filemanager/(:any)' ]        = $admin_url . '/filemanager/$2';
$route[ '^(\w{2})/' . $admin_url . '/filemanager/(:any)/(:any)' ] = $admin_url . '/filemanager/$2/$3';

//Language
$route[ $admin_url . '/language' ]                             = $admin_url . '/language';
$route[ '^(\w{2})/' . $admin_url . '/language' ]               = $admin_url . '/language';
$route[ $admin_url . '/language/(:any)' ]                      = $admin_url . '/language/$1';
$route[ $admin_url . '/language/(:any)/(:num)' ]               = $admin_url . '/language/$1/$2';
$route[ '^(\w{2})/' . $admin_url . '/language/(:any)' ]        = $admin_url . '/language/$2';
$route[ '^(\w{2})/' . $admin_url . '/language/(:any)/(:num)' ] = $admin_url . '/language/$2/$3';

//Language
$route[ $admin_url . '/translation/directory/(.*)' ]               = $admin_url . '/translation/directory/$1';
$route[ '^(\w{2})/' . $admin_url . '/translation/directory/(.*)' ] = $admin_url . '/translation/directory/$2';

//Group
$route[ $admin_url . '/group' ]                             = $admin_url . '/group';
$route[ '^(\w{2})/' . $admin_url . '/group' ]               = $admin_url . '/group';
$route[ $admin_url . '/group/(:any)' ]                      = $admin_url . '/group/$1';
$route[ $admin_url . '/group/(:any)/(:num)' ]               = $admin_url . '/group/$1/$2';
$route[ '^(\w{2})/' . $admin_url . '/group/(:any)' ]        = $admin_url . '/group/$2';
$route[ '^(\w{2})/' . $admin_url . '/group/(:any)/(:num)' ] = $admin_url . '/group/$2/$3';

//User
$route[ $admin_url . '/user' ]                             = $admin_url . '/user';
$route[ '^(\w{2})/' . $admin_url . '/user' ]               = $admin_url . '/user';
$route[ $admin_url . '/user/(:any)' ]                      = $admin_url . '/user/$1';
$route[ $admin_url . '/user/(:any)/(:num)' ]               = $admin_url . '/user/$1/$2';
$route[ '^(\w{2})/' . $admin_url . '/user/(:any)' ]        = $admin_url . '/user/$2';
$route[ '^(\w{2})/' . $admin_url . '/user/(:any)/(:num)' ] = $admin_url . '/user/$2/$3';

//Companies
$route[ $admin_url . '/companies' ]                             = $admin_url . '/companies';
$route[ '^(\w{2})/' . $admin_url . '/companies' ]               = $admin_url . '/companies';
$route[ $admin_url . '/companies/(:any)' ]                      = $admin_url . '/companies/$1';
$route[ $admin_url . '/companies/(:any)/(:num)' ]               = $admin_url . '/companies/$1/$2';
$route[ '^(\w{2})/' . $admin_url . '/companies/(:any)' ]        = $admin_url . '/companies/$2';
$route[ '^(\w{2})/' . $admin_url . '/companies/(:any)/(:num)' ] = $admin_url . '/companies/$2/$3';

//Permissions
$route[ $admin_url . '/permissions' ]                             = $admin_url . '/permissions';
$route[ '^(\w{2})/' . $admin_url . '/permissions' ]               = $admin_url . '/permissions';
$route[ $admin_url . '/permissions/(:any)' ]                      = $admin_url . '/permissions/$1';
$route[ $admin_url . '/permissions/(:any)/(:num)' ]               = $admin_url . '/permissions/$1/$2';
$route[ '^(\w{2})/' . $admin_url . '/permissions/(:any)' ]        = $admin_url . '/permissions/$2';
$route[ '^(\w{2})/' . $admin_url . '/permissions/(:any)/(:num)' ] = $admin_url . '/permissions/$2/$3';


//User field
$route[ $admin_url . '/user_field' ]                             = $admin_url . '/user_field';
$route[ '^(\w{2})/' . $admin_url . '/user_field' ]               = $admin_url . '/user_field';
$route[ $admin_url . '/user_field/(:any)' ]                      = $admin_url . '/user_field/$1';
$route[ $admin_url . '/user_field/(:any)/(:num)' ]               = $admin_url . '/user_field/$1/$2';
$route[ '^(\w{2})/' . $admin_url . '/user_field/(:any)' ]        = $admin_url . '/user_field/$2';
$route[ '^(\w{2})/' . $admin_url . '/user_field/(:any)/(:num)' ] = $admin_url . '/user_field/$2/$3';

//Permissions
$route[ $admin_url . '/permission' ]                             = $admin_url . '/permission';
$route[ '^(\w{2})/' . $admin_url . '/permission' ]               = $admin_url . '/permission';
$route[ $admin_url . '/permission/(:any)' ]                      = $admin_url . '/permission/$1';
$route[ $admin_url . '/permission/(:any)/(:num)' ]               = $admin_url . '/permission/$1/$2';
$route[ '^(\w{2})/' . $admin_url . '/permission/(:any)' ]        = $admin_url . '/permission/$2';
$route[ '^(\w{2})/' . $admin_url . '/permission/(:any)/(:num)' ] = $admin_url . '/permission/$2/$3';

//Setting
$route[ $admin_url . '/extension' ]                             = $admin_url . '/extension';
$route[ '^(\w{2})/' . $admin_url . '/extension' ]               = $admin_url . '/extension';
$route[ $admin_url . '/extension/(:any)' ]                      = $admin_url . '/extension/$1';
$route[ '^(\w{2})/' . $admin_url . '/extension/(:any)' ]        = $admin_url . '/extension/$2';
$route[ $admin_url . '/extension/(:any)/(:num)' ]               = $admin_url . '/extension/$1/$2';
$route[ '^(\w{2})/' . $admin_url . '/extension/(:any)/(:num)' ] = $admin_url . '/extension/$2/$3';

//Company_name
$route['admin/confirm_account']                        = 'admin/confirm_account';
$route['^(\w{2})/admin/confirm_account']               = 'admin/confirm_account';
$route['admin/confirm_account/(:any)']                 = 'admin/confirm_account/$1';
$route['admin/confirm_account/(:any)/(:num)']          = 'admin/confirm_account/$1/$2';
$route['^(\w{2})/admin/confirm_account/(:any)']        = 'admin/confirm_account/$2';
$route['^(\w{2})/admin/confirm_account/(:any)/(:num)'] = 'admin/confirm_account/$2/$3';

//Company_name
$route['admin/company_name']                        = 'admin/company_name';
$route['^(\w{2})/admin/company_name']               = 'admin/company_name';
$route['admin/company_name/(:any)']                 = 'admin/company_name/$1';
$route['admin/company_name/(:any)/(:num)']          = 'admin/company_name/$1/$2';
$route['^(\w{2})/admin/company_name/(:any)']        = 'admin/company_name/$2';
$route['^(\w{2})/admin/company_name/(:any)/(:num)'] = 'admin/company_name/$2/$3';

//User_standart
$route['admin/emailsender']                        = 'admin/emailsender';
$route['^(\w{2})/admin/emailsender']               = 'admin/emailsender';
$route['admin/emailsender/(:any)']                 = 'admin/emailsender/$1';
$route['admin/emailsender/(:any)/(:num)']          = 'admin/emailsender/$1/$2';
$route['^(\w{2})/admin/emailsender/(:any)']        = 'admin/emailsender/$2';
$route['^(\w{2})/admin/emailsender/(:any)/(:num)'] = 'admin/emailsender/$2/$3';

//services
$route['admin/services']                        = 'admin/services';
$route['^(\w{2})/admin/services']               = 'admin/services';
$route['admin/services/(:any)']                 = 'admin/services/$1';
$route['admin/services/(:any)/(:num)']          = 'admin/services/$1/$2';
$route['^(\w{2})/admin/services/(:any)']        = 'admin/services/$2';
$route['^(\w{2})/admin/services/(:any)/(:num)'] = 'admin/services/$2/$3';


//User_standart
$route['admin/user_standart']                        = 'admin/user_standart';
$route['^(\w{2})/admin/user_standart']               = 'admin/user_standart';
$route['admin/user_standart/(:any)']                 = 'admin/user_standart/$1';
$route['admin/user_standart/(:any)/(:num)']          = 'admin/user_standart/$1/$2';
$route['^(\w{2})/admin/user_standart/(:any)']        = 'admin/user_standart/$2';
$route['^(\w{2})/admin/user_standart/(:any)/(:num)'] = 'admin/user_standart/$2/$3';

//Permissions
$route['admin/product']                        = 'admin/product';
$route['^(\w{2})/admin/product']               = 'admin/product';
$route['admin/product/(:any)']                 = 'admin/product/$1';
$route['admin/product/(:any)/(:num)']          = 'admin/product/$1/$2';
$route['^(\w{2})/admin/product/(:any)']        = 'admin/product/$2';
$route['^(\w{2})/admin/product/(:any)/(:num)'] = 'admin/product/$2/$3';

//TENDERS
$route['admin/tender']                        = 'admin/tender';
$route['^(\w{2})/admin/tender']               = 'admin/tender';
$route['admin/tender/(:any)']                 = 'admin/tender/$1';
$route['admin/tender/(:any)/(:num)']          = 'admin/tender/$1/$2';
$route['^(\w{2})/admin/tender/(:any)']        = 'admin/tender/$2';
$route['^(\w{2})/admin/tender/(:any)/(:num)'] = 'admin/tender/$2/$3';

$route['admin/authentication/logout']          = 'admin/authentication/logout';
$route['^(\w{2})/admin/authentication/logout'] = 'admin/authentication/logout';


$route['admin/changeprocess']          = 'home/changeProcess';
$route['^(\w{2})/admin/changeprocess'] = 'home/changeProcess';

/* End custom Routes */

/* Modules */
$route[ $admin_url . '/(:any)' ]                     = $admin_url . '/module/index';
$route[ '^(\w{2})/' . $admin_url . '/(:any)' ]       = $admin_url . '/module/index';
$route[ $admin_url . '/(:any)/index' ]               = $admin_url . '/module/index';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/index' ] = $admin_url . '/module/index';
$route[ $admin_url . '/(:any)/trash' ]               = $admin_url . '/module/trash';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/trash' ] = $admin_url . '/module/trash';
//Pagination route
$route[ $admin_url . '/(:any)/index/(:num)' ]               = $admin_url . '/module/index/$1/$2';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/index/(:num)' ] = $admin_url . '/module/index/$1/$2';
//Create Route
$route[ $admin_url . '/(:any)/create' ]               = $admin_url . '/module/create/$1';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/create' ] = $admin_url . '/module/create/$2';
//Edit route
$route[ $admin_url . '/(:any)/edit/(:num)' ]               = $admin_url . '/module/edit/$2';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/edit/(:num)' ] = $admin_url . '/module/edit/$3';
//Delete Route
$route[ $admin_url . '/(:any)/delete' ]                      = $admin_url . '/module/delete';
$route[ $admin_url . '/(:any)/delete/(:num)' ]               = $admin_url . '/module/delete/$2';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/delete' ]        = $admin_url . '/module/delete';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/delete/(:num)' ] = $admin_url . '/module/delete/$3';
//Remove Route
$route[ $admin_url . '/(:any)/remove' ]                      = $admin_url . '/module/remove';
$route[ $admin_url . '/(:any)/remove/(:num)' ]               = $admin_url . '/module/remove/$2';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/remove' ]        = $admin_url . '/module/remove';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/remove/(:num)' ] = $admin_url . '/module/remove/$3';
//Restore Route
$route[ $admin_url . '/(:any)/restore' ]                      = $admin_url . '/module/restore';
$route[ $admin_url . '/(:any)/restore/(:num)' ]               = $admin_url . '/module/restore/$2';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/restore' ]        = $admin_url . '/module/restore';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/restore/(:num)' ] = $admin_url . '/module/restore/$3';
//Clean Route
$route[ $admin_url . '/(:any)/clean' ]               = $admin_url . '/module/clean';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/clean' ] = $admin_url . '/module/clean';
//Show Route
$route[ $admin_url . '/(:any)/show/(:num)' ]               = $admin_url . '/module/show/$2';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/show/(:num)' ] = $admin_url . '/module/show/$3';
//Change Status Route
$route[ $admin_url . '/(:any)/changeStatus' ]               = $admin_url . '/module/changeStatus';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/changeStatus' ] = $admin_url . '/module/changeStatus';
//Create Slug Route
$route[ $admin_url . '/(:any)/slugGenerator' ]               = $admin_url . '/module/slugGenerator';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/slugGenerator' ] = $admin_url . '/module/slugGenerator';
//Dropdown Ajax Route
$route[ $admin_url . '/(:any)/ajaxDropdownSearch' ]               = $admin_url . '/module/ajaxDropdownSearch';
$route[ '^(\w{2})/' . $admin_url . '/(:any)/ajaxDropdownSearch' ] = $admin_url . '/module/ajaxDropdownSearch';
/* End Modules */

$route['buy-capsule']          = 'pricing/buy_capsule';
$route['^(\w{2})/buy-capsule'] = 'pricing/buy_capsule';

$route['payment-successful']          = 'pricing/payment_successful';
$route['^(\w{2})/payment-successful'] = 'pricing/payment_successful';

$route['payment-cancelled']          = 'pricing/payment_cancelled';
$route['^(\w{2})/payment-cancelled'] = 'pricing/payment_cancelled';

$route['buy-capsule']          = 'pricing/buy_capsule';
$route['^(\w{2})/buy-capsule'] = 'pricing/buy_capsule';

$route['consultation']          = 'consultation/index';
$route['^(\w{2})/consultation'] = 'consultation/index';

$route['consultation/about']          = 'consultation/index';
$route['^(\w{2})/consultation/about'] = 'consultation/index';

$route['consultation/services']                 = 'consultation/services';
$route['^(\w{2})/consultation/services']        = 'consultation/services';
$route['consultation/services/(:num)']          = 'consultation/services/$1';
$route['^(\w{2})/consultation/services/(:num)'] = 'consultation/services/$2';

$route['consultation/view']                 = 'consultation/view';
$route['^(\w{2})/consultation/view']        = 'consultation/view';
$route['consultation/view/(:any)']          = 'consultation/view/$1';
$route['^(\w{2})/consultation/view/(:any)'] = 'consultation/view/$2';

$route['consultation/country']                 = 'consultation/country';
$route['^(\w{2})/consultation/country']        = 'consultation/country';
$route['consultation/country/(:num)']          = 'consultation/country/$1';
$route['^(\w{2})/consultation/country/(:num)'] = 'consultation/country/$2';

$route['consultation/legislation']                        = 'consultation/legislation';
$route['^(\w{2})/consultation/legislation']               = 'consultation/legislation';
$route['consultation/legislation/(:any)']                 = 'consultation/legislation/$2';
$route['^(\w{2})/consultation/legislation/(:any)']        = 'consultation/legislation/$2';
$route['^(\w{2})/consultation/legislation/(:any)/(:num)'] = 'consultation/legislation/$2/$3';


$route['consultation/order']          = 'consultation/order';
$route['^(\w{2})/consultation/order'] = 'consultation/order';
$route['consultation/form']           = 'consultation/form';
$route['^(\w{2})/consultation/form']  = 'consultation/form';

$route['blog']          = 'blog';
$route['^(\w{2})/blog'] = 'blog';

$route['blog/index']          = 'blog/index';
$route['^(\w{2})/blog/index'] = 'blog/index';

$route['blog/index/(:num)']          = 'blog/index/$1';
$route['^(\w{2})/blog/index/(:num)'] = 'blog/index/$2';

$route['blog/(:any)']        = 'blog/view/$1';
$route['blog/(:any)/(:num)'] = 'blog/view/$1/$2';

$route['^(\w{2})/blog/(:any)']        = 'blog/view/$2';
$route['^(\w{2})/blog/(:any)/(:num)'] = 'blog/view/$2/$3';

$route['blog/index/(:num)']          = 'blog/index/$1';
$route['^(\w{2})/blog/index/(:num)'] = 'blog/index/$2';


$route['news']          = 'news';
$route['^(\w{2})/news'] = 'news';

$route['news/index']          = 'news/index';
$route['^(\w{2})/news/index'] = 'news/index';

$route['news/index/(:num)']          = 'news/index/$1';
$route['^(\w{2})/news/index/(:num)'] = 'news/index/$2';

$route['news/(:any)']        = 'news/view/$1';
$route['news/(:any)/(:num)'] = 'news/view/$1/$2';

$route['^(\w{2})/news/(:any)']        = 'news/view/$2';
$route['^(\w{2})/news/(:any)/(:num)'] = 'news/view/$2/$3';

$route['news/index/(:num)']          = 'news/index/$1';
$route['^(\w{2})/news/index/(:num)'] = 'news/index/$2';


$route['company-list']                 = 'product/getCompanyListAll';
$route['^(\w{2})/company-list']        = 'product/getCompanyListAll';
$route['company-list/(:any)']          = 'product/getCompanyListAll/$1';
$route['^(\w{2})/company-list/(:any)'] = 'product/getCompanyListAll/$2';


$route['company/(:any)']          = 'company/index/$1';
$route['^(\w{2})/company/(:any)'] = 'company/index/$2';

// Company Pages
$route['pages']        = 'company/getCompanyPages';
$route['pages/(:any)'] = 'company/getCompanyPages/$1';

$route['follow/(:any)']          = 'follow/$1';
$route['^(\w{2})/follow/(:any)'] = 'follow/$2';

$route['follow/follow']          = 'follow/follow';
$route['^(\w{2})/follow/follow'] = 'follow/follow';

$route['follow/unfollow']          = 'follow/unfollow';
$route['^(\w{2})/follow/unfollow'] = 'follow/unfollow';

$route['messages/sendMessage']     = 'messages/sendMessage';
$route['messages/getMessage']      = 'messages/getMessage';
$route['messages']                 = 'messages/index';
$route['messages/(:any)']          = 'messages/index/$1';
$route['^(\w{2})/messages/(:any)'] = 'messages/index/$2';

$route['getProductList']                       = 'search/getproductlist';
$route['^(\w{2})/getProductList']              = 'search/getproductlist';
$route['events']                               = 'events/index';
$route['^(\w{2})/events']                      = 'events/index';
$route['^(\w{2})/search/groups/(:any)/(:num)'] = 'search/groups/$2/$3';
$route['^(\w{2})/search/importer']             = 'search/importer';

$route['^(\w{2})/events/(:any)'] = 'events/view/$2';


$route['^(\w{2})/faq']               = 'faq/index';
$route['^(\w{2})/contact']           = 'contact/index';
$route['^(\w{2})/statistics']        = 'statistics/index';
$route['^(\w{2})/statistics/test']   = 'statistics/test';
$route['statistics']                 = 'statistics/index';
$route['^(\w{2})/statistics/filter'] = 'statistics/filter';
$route['statistics/filter']          = 'statistics/filter';
$route['^(\w{2})/profile']           = 'profile/index';
$route['^(\w{2})/get_page_notification']           = 'profile/get_page_notification';
$route['^(\w{2})/deleteUserFromCompany']           = 'profile/deleteUserFromCompany';


$route['^(\w{2})/statistics/(:any)'] = 'statistics/index/$2';
$route['statistics/(:any)']          = 'statistics/index/$1';

$route['^(\w{2})/tender']               = 'tender/index';
$route['^(\w{2})/tender/atc_code']      = 'tender/atc_code';
$route['^(\w{2})/tender/delete/(:num)'] = 'tender/delete/$2';
$route['^(\w{2})/tender/copy/(:num)']   = 'tender/copy/$2';
$route['^(\w{2})/tender/update/(:num)'] = 'tender/update/$2';
$route['^(\w{2})/tender/add']           = 'tender/add';
$route['tender/view/(:any)']            = 'tender/view/$1';
$route['^(\w{2})/tender/view/(:any)']   = 'tender/view/$2';


$route['^(\w{2})/product/(:any)']               = 'product/index';
$route['^(\w{2})/product/(:any)/atc_code']      = 'product/atc_code';
$route['^(\w{2})/product/(:any)/delete/(:num)'] = 'product/delete/$3';
$route['^(\w{2})/product/(:any)/copy/(:num)']   = 'product/copy/$3';
$route['^(\w{2})/product/(:any)/update/(:num)'] = 'product/update/$3';
$route['^(\w{2})/product/(:any)/add']           = 'product/add';
$route['product/(:any)/view/(:any)']            = 'product/view/$2';
$route['^(\w{2})/product/(:any)/view/(:any)']   = 'product/view/$3';

$route['^(\w{2})/(:any)'] = 'page/index/$2';

$route['search-country'] = 'search/index';
$route['search-company'] = 'search/get_company_pages';

$route['country']                        = 'country/index';
$route['^(\w{2})/country']               = 'country/index';
$route['country/(:any)']                 = 'country/index/$2';
$route['^(\w{2})/country/(:any)']        = 'country/index/$2';
$route['^(\w{2})/country/(:any)/(:num)'] = 'country/index/$2/$3';

$route['demo/profile']                  = 'profile/index';
$route['^(\w{2})/profile']              = 'profile/index';
$route['profile/create-page']           = 'companyPages/settings';
$route['^(\w{2})/profile/create-page']           = 'companyPages/settings';

$route['profile/pages/(:any)/edit-page'] = 'companyPages/editPage/$1';
$route['^(\w{2})/profile/pages/(:any)/edit-page'] = 'companyPages/editPage/$2';

$route['pages/(:any)']                  = 'companyPages/viewPage/$1';
$route['^(\w{2})/pages/(:any)']                  = 'companyPages/viewPage/$2';


$route['pages/(:any)/followers']        = 'companyPages/followers/$1';
$route['^(\w{2})/pages/(:any)/followers']        = 'companyPages/followers/$2';

$route['pages/(:any)/following']        = 'companyPages/following/$1';
$route['^(\w{2})/pages/(:any)/following']        = 'companyPages/following/$2';



$route['pages/(:any)/interests']        = 'companyPages/interests/$1';
$route['^(\w{2})/pages/(:any)/interests']        = 'companyPages/interests/$2';

$route['pages/(:any)/people']           = 'companyPages/people/$1';
$route['^(\w{2})/pages/(:any)/people']           = 'companyPages/people/$2';

$route['^(\w{2})/pages/(:any)/people_add']           = 'companyPages/people_add/$2';
$route['^(\w{2})/pages/(:any)/search_employee']           = 'companyPages/search_employee/$2';
$route['^(\w{2})/pages/(:any)/add_employee']           = 'companyPages/add_employee/$2';

$route['pages/(:any)/people/approve/(:any)/(:any)']           = 'companyPages/peopleAction/$1/$2/$3';
$route['^(\w{2})/pages/(:any)/people/approve/(:any)/(:any)']           = 'companyPages/peopleAction/$2/$3/$4';
$route['pages/(:any)/news']             = 'companyPages/news/$1';
$route['^(\w{2})/pages/(:any)/news']             = 'companyPages/news/$2';
$route['pages/(:any)/news/(:any)']      = 'companyPages/viewNews/$1/$2';
$route['^(\w{2})/pages/(:any)/news/(:any)']      = 'companyPages/viewNews/$2/$3';
$route['profile/pages/(:any)/add-news'] = 'companyPages/addNews/$1';
$route['^(\w{2})/profile/pages/(:any)/add-news'] = 'companyPages/addNews/$2';
$route['profile/pages/(:any)/edit-news/(:any)'] = 'companyPages/editNews/$1/$2';
$route['^(\w{2})/profile/pages/(:any)/edit-news/(:any)'] = 'companyPages/editNews/$2/$3';
$route['profile/pages/(:any)/delete-news/(:any)'] = 'companyPages/deleteNews/$1/$2';
$route['^(\w{2})/profile/pages/(:any)/delete-news/(:any)'] = 'companyPages/deleteNews/$2/$3';
$route['pages/(:any)/products']         = 'companyPages/product/$1';
$route['^(\w{2})/pages/(:any)/products']         = 'companyPages/product/$2';
$route['pages/(:any)/products/(:any)']         = 'companyPages/product/$1/$2';
$route['^(\w{2})/pages/(:any)/products/(:any)']         = 'companyPages/product/$2/$3';
$route['profile/(:any)']                = 'profile/$1';
$route['^(\w{2})/profile/(:any)']       = 'profile/$2';


$route['users']                = 'company/publicAllUserProfile';
$route['^(\w{2})/users']       = 'company/publicAllUserProfile';
$route['users/(:any)']                = 'company/publicUserProfile/$1';
$route['^(\w{2})/users/(:any)']       = 'company/publicUserProfile/$2';


$route['companies']                = 'company/publicAllCompanyProfile';
$route['^(\w{2})/companies']       = 'company/publicAllCompanyProfile';
$route['companies/(:any)']                = 'company/publicCompanyProfile/$1';
$route['^(\w{2})/companies/(:any)']       = 'company/publicCompanyProfile/$2';

$route['companies/(:any)/news']             = 'company/publicNews/$1';
$route['^(\w{2})/companies/(:any)/news']             = 'company/publicNews/$2';
$route['companies/(:any)/news/(:any)']      = 'company/publicViewNews/$1/$2';
$route['^(\w{2})/companies/(:any)/news/(:any)']      = 'company/publicViewNews/$2/$3';


$route['companies/(:any)/product/(:any)']      = 'company/publicViewProduct/$1/$2';
$route['^(\w{2})/companies/(:any)/product/(:any)']      = 'company/publicViewProduct/$2/$3';

$route['companies/(:any)/interests']        = 'company/publicInterests/$1';
$route['^(\w{2})/companies/(:any)/interests']        = 'company/publicInterests/$2';
$route['companies/(:any)/people']           = 'company/publicPeople/$1';
$route['^(\w{2})/companies/(:any)/people']           = 'company/publicPeople/$2';


$route['companies/(:any)/products']         = 'company/publicProduct/$1';
$route['^(\w{2})/companies/(:any)/products']         = 'company/publicProduct/$2';
$route['companies/(:any)/products/(:any)']         = 'company/publicProduct/$1/$2';
$route['^(\w{2})/companies/(:any)/products/(:any)']         = 'company/publicProduct/$2/$3';

$route['companies/(:any)/tenders']         = 'company/publicTenders/$1';
$route['^(\w{2})/companies/(:any)/tenders']         = 'company/publicTenders/$2';
$route['companies/(:any)/chats']         = 'company/publicChats/$1';
$route['^(\w{2})/companies/(:any)/chats']         = 'company/publicChats/$2';


$route['^(\w{2})$'] = $route['default_controller'];



$route['company-names/search']          = 'home/companyNameSearch';
