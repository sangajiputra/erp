<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 #------------------------------------    
    # Author: Kpntwks Ltd
    # Author link: https://www.kpntwks.com/
    # Dynamic style php file
    # Developed by :Satch
    #------------------------------------    

class Batch extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
  
        $this->load->model(array(
            'product_batch_model')); 
        $this->load->library('ciqrcode');
        if (! $this->session->userdata('isLogIn'))
            redirect('login');
          
    }

    // product part
    public function kpntwks_product_form($id = null){
        $data['title']         = "Input Batch";  
        $data['module']        = "batch";  
        $data['page']          = "product_form";  
        echo Modules::run('template/layout', $data);
    }

    public function generator($lenth) {
        $number = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");

        for ($i = 0; $i < $lenth; $i++) {
            $rand_value = rand(0, 9);
            $rand_number = $number["$rand_value"];

            if (empty($con)) {
                $con = $rand_number;
            } else {
                $con = "$con" . "$rand_number";
            }
        }
        return $con;
    }

}

