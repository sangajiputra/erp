<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 #------------------------------------    
    # Author: Kpntwks Ltd
    # Author link: https://www.kpntwks.com/
    # Dynamic style php file
    # Developed by :Satch
    #------------------------------------    

class Verify extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
  
        $this->load->model(array(
            'batch_items_model')); 
          
    }
    
    public function index() {
        $data['title']      = 'Verify';
        $data['module']     = "verify";
        $data['page']       = "index"; 
        // $data["supplier_dropdown"] = $this->supplier_model->supplier_dropdown();
        // $data['all_supplier'] = $this->supplier_model->allsupplier(); 
        echo modules::run('template/layout_frontend', $data);
    }

    public function checkSN($id=null)
    {
        $data['title'] = 'Detail Batch';
        #-------------------------------#
        $data['module']= "verify";
        $data['page']  = "sn";
        $sn            = $id;
        $prefix        = substr($sn, 0, 6);
        $serial_number = substr($sn, 6, 10);
        $suffix        = substr($sn, -4);
        $param = array(
                    'prefix'        => $prefix,
                    'serial_number' => $serial_number,
                    'suffix'        => $suffix
                );
        $data['data']  = $this->batch_items_model->get_one_by_something($param);
        $data['sn']    = $sn;
        echo modules::run('template/layout_frontend', $data);
    }

}

