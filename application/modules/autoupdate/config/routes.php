<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//route
$route['bank_form']               = "bank/bank/kpntwks_bank_form";
$route['bank_form/(:num)']        = "bank/bank/kpntwks_bank_form/$1";
$route['bank_list']               = "bank/bank/kpntwks_bank_list";
$route['bank_transaction']        = "bank/bank/kpntwks_bank_transaction";
$route['bank_ledger']             = "bank/bank/bank_ledger";

