<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// route
$route['tax_setting']            = "tax/tax/kpntwks_tax_settings";
$route['vat_tax_setting']        = "tax/tax/kpntwks_vat_tax_settings";
$route['update_tax_setting']     = "tax/tax/tax_settings_updateform";
$route['income_tax']             = "tax/tax/kpntwks_income_tax";
$route['manage_income_tax']      = "tax/tax/manage_income_tax";
$route['edit_income_tax/(:num)'] = "tax/tax/edit_income_tax/$1";
$route['tax_reports']            = "tax/tax/kpntwks_tax_report";
$route['invoice_wise_tax_report']= "tax/tax/invoice_wise_tax_report";