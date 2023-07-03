<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['verify']         = "verify/verify/index";
$route['verify/sn/(:any)']  = "verify/verify/checkSN/$1";