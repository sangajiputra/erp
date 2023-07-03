<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 #------------------------------------    
    # Author: Kpntwks Ltd
    # Author link: https://www.kpntwks.com/
    # Dynamic style php file
    # Developed by :Satch
    #------------------------------------    

class Category extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
  
        $this->load->model(array(
            'category_model')); 
        if (! $this->session->userdata('isLogIn'))
            redirect('login');
          
    }
    
    function index() {
        $data['title']      = 'Customer Group';
        $data['module']     = "category";
        $data['page']       = "customer_group"; 
        $data["data"]       = $this->category_model->get_one_by_something();
        // $data['all_supplier'] = $this->supplier_model->allsupplier(); 
        echo modules::run('template/layout_frontend', $data);
    }

    function list_user(){
        $data  = $this->category_model->get_list_user(array('group_id' => $this->input->post('id')));
        $html = '';
        foreach ($data as $a) {
            $html .= '<tr>
                <td style="border-color: rgb(206, 206, 206); border-width: 1px;padding: 2px 4px;">'.$a['customer_name'].'</td>
                <td style="border-color: rgb(206, 206, 206); border-width: 1px;padding: 2px 4px;">'.$a['country'].'</td>
                <td style="border-color: rgb(206, 206, 206); border-width: 1px;padding: 2px 4px;">'.$a['phone'].'</td>
            </tr>';
        }

        echo $html;
    }

}

