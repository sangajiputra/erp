<?php
defined('BASEPATH') OR exit('No direct script access allowed');


//route
$route['add_service']           = "service/service/kpntwks_service_form";
$route['manage_service']        = "service/service/kpntwks_manage_service";
$route['edit_service/(:num)']   = "service/service/kpntwks_edit_service/$1";
$route['add_service_invoice']   = "service/service/kpntwks_service_invoice_form";
$route['service_details/(:any)']= "service/service/service_invoice_data/$1";
$route['service_invoice/(:any)']= "service/service/service_invoice_view/$1";
$route['manage_service_invoice']= "service/service/manage_service_invoice";
$route['manage_service_invoice/(:num)']= "service/service/manage_service_invoice/$1";
$route['edit_service_invoice/(:any)']= "service/service/service_invoice_edit/$1";


