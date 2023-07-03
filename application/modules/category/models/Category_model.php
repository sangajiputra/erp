<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 #------------------------------------    
    # Author: Kpntwks Ltd
    # Author link: https://www.kpntwks.com/
    # Dynamic style php file
    # Developed by :Satch
    #------------------------------------    

class Category_model extends CI_Model {

     
    protected $_table = 'customer_group';
    function __construct()
    {
        parent::__construct();
    }


    function get_one_by_something($key=NULL)
      {
        if($key != NULL)
        {
            $this->db->where($key);
        }
        return $this->db->get($this->_table)->result_array($key);
      }

    function get_list_user($key){
        $this->db->where($key);
        return $this->db->get('customer_information')->result_array($key);
    }
}

