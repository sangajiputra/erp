<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//route
$route['add_purchase']         = "purchase/purchase/kpntwks_purchase_form";
$route['purchase_list']        = "purchase/purchase/kpntwks_purchase_list";
$route['purchase_details/(:num)'] = 'purchase/purchase/kpntwks_purchase_details/$1';
$route['purchase_details/qrcode/(:any)'] = 'purchase/purchase/kpntwks_purchase_qrcode/$1';
$route['purchase_edit/(:num)'] = 'purchase/purchase/kpntwks_purchase_edit_form/$1';

