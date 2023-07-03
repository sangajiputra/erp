<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//route
$route['add_customer']         = "customer/customer/kpntwks_form";
$route['add_customer_group']   = "customer/customer/kpntwks_form_group";
$route['customer_list']        = "customer/customer/index";
$route['customer_group']       = "customer/customer/index_group";
$route['edit_customer/(:num)'] = 'customer/customer/kpntwks_form/$1';
$route['edit_customer_group/(:num)'] = 'customer/customer/kpntwks_form_group/$1';
$route['credit_customer']      = "customer/customer/kpntwks_credit_customer";
$route['paid_customer']        = "customer/customer/kpntwks_paid_customer";
$route['customer_ledger']      = "customer/customer/kpntwks_customer_ledger";
$route['customer_ledger/(:num)']      = "customer/customer/kpntwks_customer_ledger/$1";
$route['customer_ledgerdata']  = "customer/customer/kpntwks_customer_ledgerData";
$route['customer_advance']     = "customer/customer/kpntwks_customer_advance";
$route['advance_receipt/(:any)/(:num)']= "customer/customer/customer_advancercpt/$1/$1";