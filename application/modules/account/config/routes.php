<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//route
$route['coa']             = "account/account/kpntwks_chart_of_account";
$route['opening_balance'] = "account/account/kpntwks_opening_balance_form";
$route['supplier_payment']= "account/account/kpntwks_supplier_payment";
$route['supplier_payment_received/(:any)/(:any)/(:any)'] = 'account/account/supplier_paymentreceipt/$1/$1/$1';
$route['customer_payment_receipt/(:any)/(:any)/(:any)'] = 'account/account/customer_receipt/$1/$1/$1';
$route['customer_receive']= "account/account/customer_receive";
$route['service_payment']= "account/account/service_payment_view";
$route['cash_adjustment'] = "account/account/kpntwks_cash_adjustment";
$route['debit_voucher']   = "account/account/kpntwks_debit_voucher";
$route['credit_voucher']   = "account/account/kpntwks_credit_voucher";
$route['contra_voucher']  = "account/account/kpntwks_contra_voucher";
$route['journal_voucher'] = "account/account/kpntwks_journal_voucher";
$route['voucher_list']    = "account/account/kpntwks_voucher_list";
$route['edit_voucher/(:any)'] = 'account/account/voucher_update/$1';
$route['cash_book']       = "account/account/kpntwks_cash_book";
$route['inventory_ledger']= "account/account/kpntwks_inventory_ledger";
$route['bank_book']       = "account/account/kpntwks_bank_book";
$route['general_ledger_form']= "account/account/kpntwks_general_ledger";
$route['general_ledger']  = "account/account/accounts_report_search";
$route['trial_balance_form']= "account/account/kpntwks_trial_balance_form";
$route['trial_balance']   = "account/account/kpntwks_trial_balance_report";
$route['profit_loss_form']= "account/account/kpntwks_profit_loss_report_form";
$route['profit_loss_report']= "account/account/kpntwks_profit_loss_report_search";
$route['cashflow_form']   = "account/account/kpntwks_cash_flow_form";
$route['cash_flow']      = "account/account/cash_flow_report_search";
$route['coa_print']      = "account/account/kpntwks_coa_print";
$route['balance_sheet']   = "account/account/kpntwks_balance_sheet";
$route['add_payment_method']   = "account/account/kpntwks_payment_method_form";
$route['edit_payment_method/(:num)']   = "account/account/kpntwks_payment_method_form/$1";
$route['add_payment_method/(:num)']   = "account/account/kpntwks_payment_method_form/$1";
$route['payment_method_list']   = "account/account/payment_method_list";


