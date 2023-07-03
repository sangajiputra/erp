<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 #------------------------------------    
    # Author: Kpntwks Ltd
    # Author link: https://www.kpntwks.com/
    # Dynamic style php file
    # Developed by :Satch
    #------------------------------------    

class Batch_items_model extends CI_Model {

     
    protected $_table = 'batch_items';
    function __construct()
    {
        parent::__construct();
    }


    function get_one_by_something($key)
      {
        if($key != NULL)
        {
            $this->db->where($key);
        }
        $this->db->join('product_information', 'batch_items.product_id = product_information.product_id');
        $this->db->join('product_purchase_details', 'batch_items.detail_id = product_purchase_details.purchase_detail_id');
        return $this->db->get($this->_table)->result_array($key);
      }
}

