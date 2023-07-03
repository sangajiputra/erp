<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 #------------------------------------    
    # Author: Kpntwks Ltd
    # Author link: https://www.kpntwks.com/
    # Dynamic style php file
    # Developed by :Satch
    #------------------------------------    

class Purchase extends MX_Controller {

    public function __construct()
    {
        parent::__construct();
  
        $this->load->model(array(
            'purchase_model')); 
        $this->load->library('ciqrcode');
        $this->load->library('PHPExcel');
        if (! $this->session->userdata('isLogIn'))
            redirect('login');
          
    }
   

    function kpntwks_purchase_form() {
        $data['title']       = display('add_purchase');
        $data['all_supplier']= $this->purchase_model->supplier_list();
        $data['all_pmethod'] = $this->purchase_model->pmethod_dropdown();
        $data['module']      = "purchase";
        $data['page']        = "add_purchase_form"; 
        echo modules::run('template/layout', $data);
    }

    public function kpntwks_showpaymentmodal(){
        $is_credit =  $this->input->post('is_credit_edit',TRUE);
        $data['is_credit'] = $is_credit;
        if ($is_credit == 1) {
            # code...
            $data['all_pmethod'] = $this->purchase_model->pmethod_dropdown();
        }else{

            $data['all_pmethod'] = $this->purchase_model->pmethod_dropdown_new();
        }
        $this->load->view('purchase/newpaymentveiw',$data); 
    }

    public function kpntwks_purchase_list(){
        $data['title']      = display('manage_purchase');
        $data['total_purhcase']= $this->purchase_model->count_purchase();
        $data['module']     = "purchase";
        $data['page']       = "purchase"; 
        echo modules::run('template/layout', $data);
    }


public function kpntwks_purchase_details($purchase_id = null){
          $purchase_detail = $this->purchase_model->purchase_details_data($purchase_id);

        if (!empty($purchase_detail)) {
            $i = 0;
            foreach ($purchase_detail as $k => $v) {
                $i++;
                $purchase_detail[$k]['sl'] = $i;
            }

            foreach ($purchase_detail as $k => $v) {
                $purchase_detail[$k]['convert_date'] = $purchase_detail[$k]['purchase_date'];
            }
        }

        $data = array(
            'title'            => display('purchase_details'),
            'purchase_id'      => $purchase_detail[0]['purchase_id'],
            'purchase_details' => $purchase_detail[0]['purchase_details'],
            'supplier_name'    => $purchase_detail[0]['supplier_name'],
            'address'          => $purchase_detail[0]['address'],
            'mobile'           => $purchase_detail[0]['mobile'],
            'vat_no'           => $purchase_detail[0]['email_address'],
            'final_date'       => $purchase_detail[0]['convert_date'],
            'sub_total_amount' => number_format($purchase_detail[0]['grand_total_amount'], 2, '.', ','),
            'chalan_no'        => $purchase_detail[0]['chalan_no'],
            'total'            =>  number_format($purchase_detail[0]['grand_total_amount']+(!empty($purchase_detail[0]['total_discount'])?$purchase_detail[0]['total_discount']:0), 2),
            'discount'         => number_format((!empty($purchase_detail[0]['total_discount'])?$purchase_detail[0]['total_discount']:0),2),
            'invoice_discount' => number_format((!empty($purchase_detail[0]['invoice_discount'])?$purchase_detail[0]['invoice_discount']:0),2),
            'ttl_val'          => number_format((!empty($purchase_detail[0]['total_vat_amnt'])?$purchase_detail[0]['total_vat_amnt']:0),2),
            'paid_amount'      => number_format($purchase_detail[0]['paid_amount'],2),
            'due_amount'      => number_format($purchase_detail[0]['due_amount'],2),
            'purchase_all_data'=> $purchase_detail,
        );
        $data['module']     = "purchase";
        $data['page']       = "purchase_detail"; 
        echo modules::run('template/layout', $data);
}

public function kpntwks_purchase_edit_form($purchase_id = null){
        $purchase_detail = $this->purchase_model->retrieve_purchase_editdata($purchase_id);
        $supplier_id = $purchase_detail[0]['supplier_id'];
        $supplier_list = $this->purchase_model->supplier_list();
       
        if (!empty($purchase_detail)) {
            $i = 0;
            foreach ($purchase_detail as $k => $v) {
                $i++;
                $purchase_detail[$k]['sl'] = $i;
            }
        }
        $multi_pay_data = $this->db->select('*')
                        ->from('acc_transaction')
                        ->where('VNo',$purchase_detail[0]['purchase_id'])
                        ->where('Vtype','PurchasePayment')
                        ->get()->result();

        $data = array(
            'title'             => display('purchase_edit'),
            'purchase_id'       => $purchase_detail[0]['purchase_id'],
            'chalan_no'         => $purchase_detail[0]['chalan_no'],
            'supplier_name'     => $purchase_detail[0]['supplier_name'],
            'supplier_id'       => $purchase_detail[0]['supplier_id'],
            'grand_total'       => $purchase_detail[0]['grand_total_amount'],
            'purchase_details'  => $purchase_detail[0]['purchase_details'],
            'purchase_date'     => $purchase_detail[0]['purchase_date'],
            'total_discount'    => $purchase_detail[0]['total_discount'],
            'invoice_discount'  => $purchase_detail[0]['invoice_discount'],
            'total_vat_amnt'    => $purchase_detail[0]['total_vat_amnt'],
            'total'             => number_format($purchase_detail[0]['grand_total_amount'] + (!empty($purchase_detail[0]['total_discount'])?$purchase_detail[0]['total_discount']:0),2),
            'bank_id'           =>  $purchase_detail[0]['bank_id'],
            'purchase_info'     => $purchase_detail,
            'supplier_list'     => $supplier_list,
            'paid_amount'       => $purchase_detail[0]['paid_amount'],
            'due_amount'        => $purchase_detail[0]['due_amount'],
            'multi_paytype'     => $multi_pay_data,
            'is_credit'         => $purchase_detail[0]['is_credit'],
        );
        
        $data['all_pmethod']    = $this->purchase_model->pmethod_dropdown_new();

        // $data['all_pmethod'] = $this->invoice_model->pmethod_dropdown_new();
        $data['all_pmethodwith_cr'] = $this->purchase_model->pmethod_dropdown();
        $data['module']         = "purchase";
        $data['page']           = "edit_purchase_form"; 
        echo modules::run('template/layout', $data);
}

    public function CheckPurchaseList(){
        $postData = $this->input->post();
        $data = $this->purchase_model->getPurchaseList($postData);
        echo json_encode($data);
    }

    public function kpntwks_save_purchase(){
    $this->form_validation->set_rules('supplier_id', display('supplier') ,'required|max_length[15]');
    $this->form_validation->set_rules('chalan_no', display('invoice_no') ,'required|max_length[20]|is_unique[product_purchase.chalan_no]');
    $this->form_validation->set_rules('product_id[]',display('product'),'required|max_length[22]');
    $this->form_validation->set_rules('multipaytype[]',display('payment_type'),'required');
    $this->form_validation->set_rules('product_quantity[]',display('quantity'),'required|max_length[20]');
    $this->form_validation->set_rules('product_rate[]',display('rate'),'required|max_length[20]');
    $discount_per = $this->input->post('discount_per',TRUE);
    
    if ($this->form_validation->run() === true) {
        
        $purchase_id = date('YmdHis');
        $p_id        = $this->input->post('product_id',TRUE);
        $supplier_id = $this->input->post('supplier_id',TRUE);
        $supinfo     = $this->db->select('*')->from('supplier_information')->where('supplier_id',$supplier_id)->get()->row();
        $sup_head    = $supinfo->supplier_id.'-'.$supinfo->supplier_name;
        $sup_coa     = $this->db->select('*')->from('acc_coa')->where('HeadName',$sup_head)->get()->row();
         $receive_by = $this->session->userdata('id');
        $receive_date= date('Y-m-d');
        $createdate  = date('Y-m-d H:i:s');
        $paid_amount = $this->input->post('paid_amount',TRUE);
        $due_amount  = $this->input->post('due_amount',TRUE);
        $discount    = $this->input->post('discount',TRUE);
        $bank_id     = $this->input->post('bank_id',TRUE);

        $multipayamount = $this->input->post('pamount_by_method',TRUE);
        $multipaytype = $this->input->post('multipaytype',TRUE);
        
        $multiamnt = array_sum($multipayamount);

        if ($multiamnt == $paid_amount) {
          
        if(!empty($bank_id)){
       $bankname = $this->db->select('bank_name')->from('bank_add')->where('bank_id',$bank_id)->get()->row()->bank_name;
    
       $bankcoaid = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$bankname)->get()->row()->HeadCode;
   }else{
       $bankcoaid = '';
   }

        //supplier & product id relation ship checker.
        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_id = $p_id[$i];
            $value = $this->product_supplier_check($product_id, $supplier_id);
            if ($value == 0) {
                $this->session->set_flashdata('error_message', display('product_and_supplier_did_not_match'));
                redirect(base_url('add_purchase'));
                exit();
            }
        }
        if ($multipaytype[0] == 0) {
            $is_credit = 1;
        }
        else {
            $is_credit = '';
        }

        $data = array(
            'purchase_id'        => $purchase_id,
            'chalan_no'          => $this->input->post('chalan_no',TRUE),
            'supplier_id'        => $this->input->post('supplier_id',TRUE),
            'grand_total_amount' => $this->input->post('grand_total_price',TRUE),
            'total_discount'     => $this->input->post('discount',TRUE),
            'invoice_discount'   => $this->input->post('total_discount',TRUE),
            'total_vat_amnt'     => $this->input->post('total_vat_amnt',TRUE),
            'purchase_date'      => $this->input->post('purchase_date',TRUE),
            'purchase_details'   => $this->input->post('purchase_details',TRUE),
            'paid_amount'        => $paid_amount,
            'due_amount'         => $due_amount,
            'status'             => 1,
            'bank_id'            =>  $this->input->post('bank_id',TRUE),
            'payment_type'       =>  1,
            'is_credit'          =>  $is_credit,
        );
        //Supplier Credit
        $purchasecoatran = array(
          'VNo'            =>  $purchase_id,
          'Vtype'          =>  'Purchase',
          'VDate'          =>  $this->input->post('purchase_date',TRUE),
          'COAID'          =>  $sup_coa->HeadCode,
          'Narration'      =>  'Supplier .'.$supinfo->supplier_name,
          'Debit'          =>  0,
          'Credit'         =>  $this->input->post('grand_total_price',TRUE),
          'IsPosted'       =>  1,
          'CreateBy'       =>  $receive_by,
          'CreateDate'     =>  $receive_date,
          'IsAppove'       =>  1
        ); 
          ///Inventory Debit
       $coscr = array(
      'VNo'            =>  $purchase_id,
      'Vtype'          =>  'Purchase',
      'VDate'          =>  $this->input->post('purchase_date',TRUE),
      'COAID'          =>  1141,
      'Narration'      =>  'Inventory Debit For Supplier '.$supinfo->supplier_name,
      'Debit'          =>  $this->input->post('grand_total_price',TRUE),
      'Credit'         =>  0,//purchase price asbe
      'IsPosted'       => 1,
      'CreateBy'       => $receive_by,
      'CreateDate'     => $createdate,
      'IsAppove'       => 1
    ); 

 

             $cashinhand = array(
      'VNo'            =>  $purchase_id,
      'Vtype'          =>  'Purchase',
      'VDate'          =>  $this->input->post('purchase_date',TRUE),
      'COAID'          =>  111000001,
      'Narration'      =>  'Cash in Hand For Supplier '.$supinfo->supplier_name,
      'Debit'          =>  0,
      'Credit'         =>  $paid_amount,
      'IsPosted'       =>  1,
      'CreateBy'       =>  $receive_by,
      'CreateDate'     =>  $createdate,
      'IsAppove'       =>  1
    ); 

     $supplierdebit = array(
          'VNo'            =>  $purchase_id,
          'Vtype'          =>  'Purchase',
          'VDate'          =>  $this->input->post('purchase_date',TRUE),
          'COAID'          =>  $sup_coa->HeadCode,
          'Narration'      =>  'Supplier .'.$supinfo->supplier_name,
          'Debit'          =>  $paid_amount,
          'Credit'         =>  0,
          'IsPosted'       =>  1,
          'CreateBy'       =>  $receive_by,
          'CreateDate'     =>  $receive_date,
          'IsAppove'       =>  1
        ); 
             
      // bank ledger
     $bankc = array(
          'VNo'            =>  $purchase_id,
          'Vtype'          =>  'Purchase',
          'VDate'          =>  $this->input->post('purchase_date',TRUE),
          'COAID'          =>  $bankcoaid,
          'Narration'      =>  'Paid amount for Supplier  '.$supinfo->supplier_name,
          'Debit'          =>  0,
          'Credit'         =>  $paid_amount,
          'IsPosted'       =>  1,
          'CreateBy'       =>  $receive_by,
          'CreateDate'     =>  $createdate,
          'IsAppove'       =>  1
        ); 
        
        $this->db->insert('product_purchase', $data);
        $this->db->insert('acc_transaction',$coscr);
        $this->db->insert('acc_transaction',$purchasecoatran);
        if ($multipaytype[0] != 0) {
            if(!empty($paid_amount)){
                $this->db->insert('acc_transaction',$supplierdebit); 
            }
        }

       
        $i=0;
        if ($multipaytype[0] != 0) {
            foreach ($multipaytype  as $multipaytype) {

                $paymethod = array(
                    'VNo'            =>  $purchase_id,
                    'Vtype'          =>  'PurchasePayment',
                    'VDate'          =>  $this->input->post('purchase_date',TRUE),
                    'COAID'          =>  $multipaytype,
                    'Narration'      =>  'Paid amount for Supplier  '.$supinfo->supplier_name,
                    'Debit'          =>  0,
                    'Credit'         =>  $multipayamount[$i],
                    'IsPosted'       =>  1,
                    'CreateBy'       =>  $receive_by,
                    'CreateDate'     =>  $createdate,
                    'IsAppove'       =>  1
                ); 
                $this->db->insert('acc_transaction',$paymethod); 
                $i++;
                
            }
        }
        
              

        $rate         = $this->input->post('product_rate',TRUE);
        $quantity     = $this->input->post('product_quantity',TRUE);
        $expiry_date  = $this->input->post('expiry_date',TRUE);
        $batch_no     = $this->input->post('batch_no',TRUE);
        $t_price      = $this->input->post('total_price',TRUE);
        $discountvalue= $this->input->post('discountvalue',TRUE);
        $vatpercent   = $this->input->post('vatpercent',TRUE);
        $vatvalue     = $this->input->post('vatvalue',TRUE);
        $discount_per = $this->input->post('discount_per',TRUE);
        

        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_rate     = $rate[$i];
            $product_id       = $p_id[$i];
            $total_price      = $t_price[$i];
            $ba_no            = $batch_no[$i];
            $exp_date         = $expiry_date[$i];
            $dis_per          = $discount_per[$i];
            $disval           = $discountvalue[$i];
            $vatper           = $vatpercent[$i];
            $vatval           = $vatvalue[$i];
            $datenow          = strtotime(date('Y-m-d H:i:s'));
            $detail_id        = $this->generator(15);

            $data1 = array(
                'purchase_detail_id' => $detail_id,
                'purchase_id'        => $purchase_id,
                'product_id'         => $product_id,
                'quantity'           => $product_quantity,
                'rate'               => $product_rate,
                'batch_id'           => $ba_no,
                'expiry_date'        => $exp_date,
                'total_amount'       => $total_price,
                'discount'           => $dis_per,
                'discount_amnt'      => $disval,
                'vat_amnt_per'       => $vatper,
                'vat_amnt'           => $vatval,
                'status'             => 1
            );
            
            if (!empty($quantity)) {
                $this->db->insert('product_purchase_details', $data1);
            }
            
            $batch = array();
            for ($b = 0; $b < $product_quantity; ++$b) {
                $batch[] = array(
                              'detail_id'    => $detail_id ,
                              'product_id'   => $product_id ,
                              'prefix'       => substr($product_id,0,6),
                              'serial_number'=> $datenow+($b+1),
                              'suffix'       => substr($product_id,-4)
                           );
            }
            $this->db->insert_batch('batch_items', $batch); 

        }
        $this->session->set_flashdata('message', display('save_successfully'));
        redirect("purchase_list");
        }else {
            $this->session->set_flashdata('exception', 'Paid Amount Should Equal To Payment Amount');
            redirect("add_purchase");
        }

         } else {
            $this->session->set_flashdata('exception', validation_errors());
            redirect("add_purchase");
         } 
    }



    public function kpntwks_update_purchase() {
    $purchase_id  = $this->input->post('purchase_id',TRUE);
    $this->form_validation->set_rules('supplier_id', display('supplier') ,'required|max_length[15]');
    $this->form_validation->set_rules('chalan_no', display('invoice_no') ,'required|max_length[20]');
    $this->form_validation->set_rules('product_id[]',display('product'),'required|max_length[20]');
    $this->form_validation->set_rules('multipaytype[]',display('payment_type'),'required');
    $this->form_validation->set_rules('product_quantity[]',display('quantity'),'required|max_length[20]');
    $this->form_validation->set_rules('product_rate[]',display('rate'),'required|max_length[20]');

    if ($this->form_validation->run() === true) {
         
        $paid_amount  = $this->input->post('paid_amount',TRUE);
        $due_amount   = $this->input->post('due_amount',TRUE);
        $bank_id      = $this->input->post('bank_id',TRUE);
            if(!empty($bank_id)){
           $bankname = $this->db->select('bank_name')->from('bank_add')->where('bank_id',$bank_id)->get()->row()->bank_name;
        $bankcoaid   = $this->db->select('HeadCode')->from('acc_coa')->where('HeadName',$bankname)->get()->row()->HeadCode;
       }
        $p_id        = $this->input->post('product_id',TRUE);
        $supplier_id = $this->input->post('supplier_id',TRUE);
        $supinfo     = $this->db->select('*')->from('supplier_information')->where('supplier_id',$supplier_id)->get()->row();
        $sup_head    = $supinfo->supplier_id.'-'.$supinfo->supplier_name;
        $sup_coa     = $this->db->select('*')->from('acc_coa')->where('HeadName',$sup_head)->get()->row();
        $receive_by  = $this->session->userdata('id');
        $receive_date= date('Y-m-d');
        $createdate  = date('Y-m-d H:i:s');
        $multipayamount = $this->input->post('pamount_by_method',TRUE);
        $multipaytype = $this->input->post('multipaytype',TRUE);

        if ($multipaytype[0] == 0) {
            $is_credit = 1;
        }
        else {
            $is_credit = '';
        }
        $data = array(
            'purchase_id'        => $purchase_id,
            'chalan_no'          => $this->input->post('chalan_no',TRUE),
            'supplier_id'        => $this->input->post('supplier_id',TRUE),
            'grand_total_amount' => $this->input->post('grand_total_price',TRUE),
            'total_discount'     => $this->input->post('discount',TRUE),
            'invoice_discount'   => $this->input->post('total_discount',TRUE),
            'total_vat_amnt'     => $this->input->post('total_vat_amnt',TRUE),
            'purchase_date'      => $this->input->post('purchase_date',TRUE),
            'purchase_details'   => $this->input->post('purchase_details',TRUE),
            'paid_amount'        => $paid_amount,
            'due_amount'         => $due_amount,
             'bank_id'           =>  $this->input->post('bank_id',TRUE),
            'payment_type'       =>  1,
            'is_credit'          =>  $is_credit,
        );
             $cashinhand = array(
          'VNo'            =>  $purchase_id,
          'Vtype'          =>  'Purchase',
          'VDate'          =>  $this->input->post('purchase_date',TRUE),
          'COAID'          =>  111000001,
          'Narration'      =>  'Cash in Hand For Supplier '.$supinfo->supplier_name,
          'Debit'          =>  0,
          'Credit'         =>  $paid_amount,
          'IsPosted'       =>  1,
          'CreateBy'       =>  $receive_by,
          'CreateDate'     =>  $createdate,
          'IsAppove'       =>  1
        ); 
                  // bank ledger
       $bankc = array(
            'VNo'            =>  $purchase_id,
            'Vtype'          =>  'Purchase',
            'VDate'          =>  $this->input->post('purchase_date',TRUE),
            'COAID'          =>  $bankcoaid,
            'Narration'      =>  'Paid amount for Supplier  '.$supinfo->supplier_name,
            'Debit'          =>  0,
            'Credit'         =>  $paid_amount,
            'IsPosted'       =>  1,
            'CreateBy'       =>  $receive_by,
            'CreateDate'     =>  $createdate,
            'IsAppove'       =>  1
          ); 

        
         $purchasecoatran = array(
          'VNo'            =>  $purchase_id,
          'Vtype'          =>  'Purchase',
          'VDate'          =>  $this->input->post('purchase_date',TRUE),
          'COAID'          =>  $sup_coa->HeadCode,
          'Narration'      =>  'Supplier -'.$supinfo->supplier_name,
          'Debit'          =>  0,
          'Credit'         =>  $this->input->post('grand_total_price',TRUE),
          'IsPosted'       =>  1,
          'CreateBy'       =>  $receive_by,
          'CreateDate'     =>  $receive_date,
          'IsAppove'       =>  1
        ); 
          ///Inventory credit
           $coscr = array(
          'VNo'            =>  $purchase_id,
          'Vtype'          =>  'Purchase',
          'VDate'          =>  $this->input->post('purchase_date',TRUE),
          'COAID'          =>  1141,
          'Narration'      =>  'Inventory Devit Supplier '.$supinfo->supplier_name,
          'Debit'          =>  $this->input->post('grand_total_price',TRUE),
          'Credit'         =>  0,//purchase price asbe
          'IsPosted'       => 1,
          'CreateBy'       => $receive_by,
          'CreateDate'     => $createdate,
          'IsAppove'       => 1
        ); 
      

         $supplier_debit = array(
          'VNo'            =>  $purchase_id,
          'Vtype'          =>  'Purchase',
          'VDate'          =>  $this->input->post('purchase_date',TRUE),
          'COAID'          =>  $sup_coa->HeadCode,
          'Narration'      =>  'Supplier . '.$supinfo->supplier_name,
          'Debit'          =>  $paid_amount,
          'Credit'         =>  0,
          'IsPosted'       =>  1,
          'CreateBy'       =>  $receive_by,
          'CreateDate'     =>  $receive_date,
          'IsAppove'       =>  1
        ); 

        

        if ($purchase_id != '') {
            $this->db->where('purchase_id', $purchase_id);
            $this->db->update('product_purchase', $data);
            //account transaction update
             $this->db->where('VNo', $purchase_id);
            $this->db->delete('acc_transaction');
            $this->db->where('purchase_id', $purchase_id);
            $this->db->delete('product_purchase_details');
        }

        $this->db->insert('acc_transaction',$coscr);
        $this->db->insert('acc_transaction',$purchasecoatran);  
        if ($multipaytype[0] != 0) {
            if(!empty($paid_amount)){
                $this->db->insert('acc_transaction',$supplier_debit);
            }
        }

        $multipayamount = $this->input->post('pamount_by_method',TRUE);
        $multipaytype = $this->input->post('multipaytype',TRUE);
        $i=0;
        if ($multipaytype[0] != 0) {
            foreach ($multipaytype  as $multipaytype) {

                $paymethod = array(
                    'VNo'            =>  $purchase_id,
                    'Vtype'          =>  'PurchasePayment',
                    'VDate'          =>  $this->input->post('purchase_date',TRUE),
                    'COAID'          =>  $multipaytype,
                    'Narration'      =>  'Paid amount for Supplier  '.$supinfo->supplier_name,
                    'Debit'          =>  0,
                    'Credit'         =>  $multipayamount[$i],
                    'IsPosted'       =>  1,
                    'CreateBy'       =>  $receive_by,
                    'CreateDate'     =>  $createdate,
                    'IsAppove'       =>  1
                ); 
                $this->db->insert('acc_transaction',$paymethod); 
                $i++;
                
            }
        }
              

        $rate         = $this->input->post('product_rate',TRUE);
        $p_id         = $this->input->post('product_id',TRUE);
        $quantity     = $this->input->post('product_quantity',TRUE);
        $t_price      = $this->input->post('total_price',TRUE);
        $expiry_date  = $this->input->post('expiry_date',TRUE);
        $batch_no     = $this->input->post('batch_no',TRUE);
        $discountvalue= $this->input->post('discountvalue',TRUE);
        $vatpercent   = $this->input->post('vatpercent',TRUE);
        $vatvalue     = $this->input->post('vatvalue',TRUE);
        $discount_per = $this->input->post('discount_per',TRUE);

        $discount = $this->input->post('discount',TRUE);

        for ($i = 0, $n = count($p_id); $i < $n; $i++) {
            $product_quantity = $quantity[$i];
            $product_rate     = $rate[$i];
            $product_id       = $p_id[$i];
            $total_price      = $t_price[$i];
            $disc             = $discount[$i];
            $ba_no            = $batch_no[$i];
            $exp_date         = $expiry_date[$i];
            $dis_per          = $discount_per[$i];
            $disval           = $discountvalue[$i];
            $vatper           = $vatpercent[$i];
            $vatval           = $vatvalue[$i];
            

            $data1 = array(
                'purchase_detail_id' => $this->generator(15),
                'purchase_id'        => $purchase_id,
                'product_id'         => $product_id,
                'quantity'           => $product_quantity,
                'rate'               => $product_rate,
                'batch_id'           => $ba_no,
                'expiry_date'        => $exp_date,
                'total_amount'       => $total_price,
                'discount'           => $dis_per,
                'discount_amnt'      => $disval,
                'vat_amnt_per'       => $vatper,
                'vat_amnt'           => $vatval,
                'status'             => 1
            );


            if (($quantity)) {

                $this->db->insert('product_purchase_details', $data1);
            }
        }
        $this->session->set_flashdata('message', display('update_successfully'));
           redirect("purchase_list");
         } else {
            $this->session->set_flashdata('exception', validation_errors());
            redirect("purchase_edit/".$purchase_id);
         } 
    }
    public function kpntwks_product_search_by_supplier() {
        $supplier_id = $this->input->post('supplier_id',TRUE);
        $product_name = $this->input->post('product_name',TRUE);
        $product_info = $this->purchase_model->product_search_item($supplier_id, $product_name);
        if(!empty($product_info)){
        $list[''] = '';
        foreach ($product_info as $value) {
            $json_product[] = array('label'=>$value['product_name'].'('.$value['product_model'].')','value'=>$value['product_id']);
        } 
    }else{
        $json_product[] = 'No Product Found';
        }
        echo json_encode($json_product);
    }

        public function kpntwks_retrieve_product_data() {
        $product_id  = $this->input->post('product_id',TRUE);
        $supplier_id = $this->input->post('supplier_id',TRUE);
        $product_info = $this->purchase_model->get_total_product($product_id, $supplier_id);

        echo json_encode($product_info);
    }

        public function product_supplier_check($product_id, $supplier_id) {
        $this->db->select('*');
        $this->db->from('supplier_product');
        $this->db->where('product_id', $product_id);
        $this->db->where('supplier_id', $supplier_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return true;
        }
        return 0;
    }

    public function generator($lenth)
    {
        $number=array("A","B","C","D","E","F","G","H","I","J","K","L","N","M","O","P","Q","R","S","U","V","T","W","X","Y","Z","1","2","3","4","5","6","7","8","9","0");
    
        for($i=0; $i<$lenth; $i++)
        {
            $rand_value=rand(0,34);
            $rand_number=$number["$rand_value"];
        
            if(empty($con))
            { 
            $con=$rand_number;
            }
            else
            {
            $con="$con"."$rand_number";}
        }
        return $con;
    }

    function generate_excel($id, $qty)
    {
        $product_info = $this->purchase_model->detail_by_something(array('detail_id'=>$id),$qty,0);
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=data_qrcode.xls");

        $config['cacheable'] = true; //boolean, the default is true
        $config['cachedir'] = ''; //string, the default is application/cache/
        $config['errorlog'] = ''; //string, the default is application/logs/
        $config['quality'] = true; //boolean, the default is true
        $config['size'] = '1024'; //interger, the default is 1024
        $config['black'] = array(224, 255, 255); // array, default is 
        $config['white'] = array(70, 130, 180); // array, default is array(0,0,0)
        $base_url = base_url(); // mengambil nilai base_url dari config.php
        $base_url = str_replace('dashboard/', '', $base_url); // menghapus "dashboard/" dari base_url
        $this->ciqrcode->initialize($config);
        echo '<table>';
        echo '<tr><td colspan="10" style="text-align: center"><h3>List Purchase Items Batch ID '.$id.'</h3></td></tr>';
        echo '<tr>';
        echo '<th></th>';
        echo '<th style="text-align:center;">SN</th>';
        echo '<th style="text-align:center;">QR</th>';
        echo '</tr>';
        foreach ($product_info as $a) {
            $params['data'] = $base_url.'verify/'.$a['prefix'].$a['serial_number'].$a['suffix'];
            $params['level'] = 'H';
            $params['size'] = 10;
            $image_name = $a['prefix'].$a['serial_number'].$a['suffix'] . '.png';
            $params['savename'] = FCPATH . 'my-assets/image/qr/' . $image_name;
            $this->ciqrcode->generate($params);

            // gambar logo
            $logo  = FCPATH.'assets/img/icons/mini-logo.png';
            $QR = imagecreatefrompng($params['savename']);
            $logo = imagecreatefromstring(file_get_contents($logo));
            $QR_width = imagesx($QR);
            $QR_height = imagesy($QR);
            $logo_width = imagesx($logo);
            $logo_height = imagesy($logo);
            $logo_qr_width = $QR_width/5;
            $scale = $logo_width/$logo_qr_width;
            $logo_qr_height = $logo_height/$scale;
            $from_width = ($QR_width-$logo_qr_width)/2;

            // merge gambar
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);
            imagepng($QR, $params['savename']);
            $sn = $a['prefix'].$a['serial_number'].$a['suffix'];
            echo '<tr>';
            echo '<td></td>';
            echo '<td style="font-size: 16px;">SN: '.(int)$sn.'</td>';
            echo '<td style="height: 250px;"><img src="'.base_url('my-assets/image/qr/'.$image_name).'" width="200" height="200"></td>';
            echo '</tr>';
        }
        echo '</table>';
    }

    function kpntwks_purchase_qrcode($id)
    {
        if (isset($_GET['submit'])) {
            if ($_GET['submit'] == 'Generate') {
                $limit = $_GET['qty'];
                $offset= 0;
            }else{
                $this->generate_excel($id, $_GET['qty']);
                return;
            }
        }else{
            $limit = 1;
            $offset= 0;
        }
        $product_info = $this->purchase_model->detail_by_something(array('detail_id'=>$id),$limit,$offset);
        $image = $this->session->userdata('image');
        
        $base_url = base_url(); // mengambil nilai base_url dari config.php
        $base_url = str_replace('dashboard/', '', $base_url); // menghapus "dashboard/" dari base_url
        $qrcode = array();
        $config['cacheable'] = true; //boolean, the default is true
        $config['cachedir'] = ''; //string, the default is application/cache/
        $config['errorlog'] = ''; //string, the default is application/logs/
        $config['quality'] = true; //boolean, the default is true
        $config['size'] = '1024'; //interger, the default is 1024
        $config['black'] = array(224, 255, 255); // array, default is 
        $config['white'] = array(70, 130, 180); // array, default is array(0,0,0)
        $this->ciqrcode->initialize($config);
        foreach($product_info as $a){
            $params['data'] = $base_url.'verify/'.$a['prefix'].$a['serial_number'].$a['suffix'];
            $params['level'] = 'H';
            $params['size'] = 10;
            $params['logo'] = $logo;
            $image_name = $a['prefix'].$a['serial_number'].$a['suffix'] . '.png';
            $params['savename'] = FCPATH . 'my-assets/image/qr/' . $image_name;
            $this->ciqrcode->generate($params);
            // gambar logo
            $logo  = FCPATH.'assets/img/icons/mini-logo.png';
            $QR = imagecreatefrompng($params['savename']);
            $logo = imagecreatefromstring(file_get_contents($logo));
            $QR_width = imagesx($QR);
            $QR_height = imagesy($QR);
            $logo_width = imagesx($logo);
            $logo_height = imagesy($logo);
            $logo_qr_width = $QR_width/5;
            $scale = $logo_width/$logo_qr_width;
            $logo_qr_height = $logo_height/$scale;
            $from_width = ($QR_width-$logo_qr_width)/2;

            // merge gambar
            imagecopyresampled($QR, $logo, $from_width, $from_width, 0, 0, $logo_qr_width, $logo_qr_height, $logo_width, $logo_height);

            // simpan gambar QR code yang sudah digabung dengan logo
            imagepng($QR, $params['savename']);
            array_push($qrcode, $image_name);
        }
        $data = array(
            'title'           => display('qr_code'),
            // 'product_name'    => $product_info['product_name'],
            // 'product_model'   => $product_info['product_model'],
            // 'price'           => $product_info['rate'],
            // 'product_details' => $product_info['product_details'],
            'qr_image'        => $qrcode,
        );
        $data['module']        = "purchase";
        $data['page']          = "barcode_print_page"; 
        echo modules::run('template/layout', $data);
    }

}

