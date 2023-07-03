<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// route
$route['return_form']           = "return/returns/kpntwks_return_form";
$route['invoice_return']        = "return/returns/kpntwks_invoice_return_form";
$route['invoice_return_details/(:any)']= "return/returns/invoice_return_details/$1";
$route['supplier_return']        = "return/returns/kpntwks_supplier_return";
$route['supplier_return_details/(:any)']= "return/returns/supplier_return_details/$1";
$route['invoice_return_list']    = "return/returns/kpntwks_invoice_return_list";
$route['invoice_return_list/(:num)']= "return/returns/kpntwks_invoice_return_list/$1";
$route['invoice_return_search']  = "return/returns/datewise_invoic_return_list";
$route['invoice_return_search/(:num)']  = "return/returns/datewise_invoic_return_list/$1";
$route['supplier_return_list']  = "return/returns/supplier_return_list";
$route['supplier_return_list/(:num)']  = "return/returns/supplier_return_list/$1";
$route['supplier_return_search']= "return/returns/datebwteen_supplier_return_list";
$route['supplier_return_search/(:num)']= "return/returns/datebwteen_supplier_return_list/$1";
$route['wastage_return_list']           = "return/returns/wastage_return_list";
$route['wastage_return_list/(:num)']   = "return/returns/wastage_return_list/$1";
