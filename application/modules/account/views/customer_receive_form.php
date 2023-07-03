<script src="<?php echo base_url() ?>my-assets/js/admin_js/account.js" type="text/javascript"></script>

<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            <div class="panel-heading">
                <div class="panel-title">
                    <h4>
                      <?php echo display('customer_receive')?>   
                    </h4>
                </div>
            </div>
            <div class="panel-body">
              
                         <?php echo  form_open_multipart('account/account/create_customer_receive','id="customer_receive_form"') ?>
                 
                     <div class="form-group row">
                        <label for="date" class="col-sm-2 col-form-label"><?php echo display('date')?><i class="text-danger">*</i></label>
                        <div class="col-sm-4">
                             <input type="text" name="dtpDate" id="dtpDate" class="form-control datepicker" value="<?php  echo date('Y-m-d');?>" required>
                        </div>
                    </div> 
                   
                              
                        
                       <div class="form-group row">
                        <label for="txtRemarks" class="col-sm-2 col-form-label"><?php echo display('remark')?></label>
                        <div class="col-sm-4">
                          <textarea  name="txtRemarks" id="txtRemarks" class="form-control"></textarea>
                        </div>
                    </div> 
                   
                       <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="debtAccVoucher"> 
                                <thead>
                                    <tr>
                              <th class="text-center"><?php echo display('customer_name')?><i class="text-danger">*</i></th>
                              <th class="text-center"><?php echo display('voucher_no')?></th>
                               <th class="text-center"><?php echo display('due_amount')?></th>
                              <th class="text-center"><?php echo display('amount')?><i class="text-danger">*</i></th>
                                
                                    </tr>
                                </thead>
                                <tbody id="debitvoucher">
                                   
                                    <tr>
                                        <td class="" width="300">  
                           <select name="customer_id" id="customer_id_1" class="form-control" onchange="load_customer_code(this.value,1)" required>
                            <<option value="">Select Customer</option>}
                            option
                             <?php foreach ($customer_list as $customer) {?>
                       <option value="<?php echo html_escape($customer->customer_id);?>"><?php echo html_escape($customer->customer_name);?></option>
                             <?php }?>
                           </select>

                                         </td>
                                        <td><input type="hidden" name="txtCode" value="" class="form-control "  id="txtCode_1" readonly="">
                                             <?php echo  form_dropdown('voucher_no',null,null, 'class="form-control select2" required id="voucher_no_1" onchange="customervoucher_due(this.value)"') ?> 
                                        </td>
                                        <td><input type="text" name="dueAmount" value="" class="form-control  text-right"  id="due_1"  readonly=""></td>
                                        <td><input type="number" step="0.01" name="txtAmount" value="" class="form-control total_price text-right"  id="txtAmount_1" onkeyup="CustomerRcvcalculation(1)" required>
                                           </td>
                                      
                                    </tr>                              
                              
                                </tbody>                               
                             <tfoot>
                                    <tr>
                                      <td >
                                           
                                        </td>
                                        <td colspan="2" class="text-right"><label  for="reason" class="  col-form-label"><?php echo display('total') ?></label>
                                           </td>
                                        <td class="text-right">
                                            <input type="text" id="grandTotal" class="form-control text-right " name="grand_total" value="" readonly="readonly" />
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                              <p hidden id="old-amount"><?php echo 0;?></p>
                    <p hidden id="pay-amount"></p>
                    <p hidden id="change-amount"></p>
                    <div class="col-sm-6 table-bordered p-20">
                        <div id="adddiscount" class="display-none">
                            <div class="row no-gutters">
                                <div class="form-group col-md-5">
                                    <label for="payments"
                                        class="col-form-label pb-2"><?php echo display('payment_type');?></label>

                                    <?php 
                                    
                                    echo form_dropdown('multipaytype[]',$all_pmethod,(!empty($card_type)?$card_type:null),' class="card_typesl postform resizeselect form-control "') ?>

                                </div>
                                <div class="form-group col-md-5">
                                    <label for="4digit"
                                        class="col-form-label pb-2"><?php echo display('paid_amount');?></label>

                                    <input type="text" id="pamount_by_method_1" class="form-control number pay text-right valid_number"
                                        name="pamount_by_method[]" value="" onkeyup="changedueamount()"
                                        placeholder="0.00" required/>

                                </div>
                                 <div class="form-group col-md-2">
                        <label for="payments" class="col-form-label pb-2 text-white"><?php echo display('payment_type');?></label>
                        <button class="btn btn-danger" onclick="removeMethod(this,1)"><i class="fa fa-trash"></i></button>
                      </div>
                                                </div>

                            <div class="" id="add_new_payment">



                            </div>
                            <div class="form-group text-right">
                                <div class="col-sm-12 pr-0">

                                    <button  type="button" id="add_new_payment_type"
                                        class="btn btn-success w-md m-b-5"><?php echo display('new_p_method');?></button>
                                </div>
                            </div>

                        </div>
                    </div>
                        </div>
                        <div class="form-group row">
                           
                            <div class="col-sm-12 text-right">

                                <input type="submit" id="add_receive" class="btn btn-success btn-large" name="save" value="<?php echo display('save') ?>" tabindex="9"/>
                               
                            </div>
                        </div>
                  <?php echo form_close() ?>
            </div>  
        </div>
    </div>
</div>

<script type="text/javascript">
    function changedueamount(){
    var inputval = parseFloat(0);
    var maintotalamount = $('#grandTotal').val();
    
    $(".number").each(function(){
      var inputdata= parseFloat($(this).val());
      inputval = inputval+inputdata;

        if(parseFloat(maintotalamount) < parseFloat(inputval)){
        toastr["error"]('You Can not Pay More than Total Amount');
        $(this).val(0)
        return false;
    }

    });



     var restamount=(parseFloat(maintotalamount))-(parseFloat(inputval));
    var changes=restamount.toFixed(3);
    if(changes <=0){
      $("#pay-amount").text(0);
    }
    else{
      $("#pay-amount").text(changes);
    }  

  }

  // ******* new payment add start *******
$(document).on('click','#add_new_payment_type',function(){
    var base_url = $('#base_url').val();
    var csrf_test_name = $('[name="csrf_test_name"]').val();
    var gtotal=$("#grandTotal").val();
    
    var total = 0;
    $( ".pay" ).each( function(){
      total += parseFloat( $( this ).val() ) || 0;
    });
    
   
    if(total>=gtotal){
        toastr.error("Paid amount is exceed to Total amount.");
      
      return false;
    }
      
    var url= base_url + "account/account/kpntwks_showpaymentmodal";
    $.ajax({
      type: "GET",
      url: url,
      data:{csrf_test_name:csrf_test_name},
      success: function(data) {
        
        $($('#add_new_payment').append(data)).show("slow", function(){
            
          });
        var length = $(".number").length;
        $(".number:eq("+(length-1)+")").val(parseFloat($("#pay-amount").text()));
        var total2 = 0;
        $( ".number" ).each( function(){
          total2 += parseFloat( $( this ).val() ) || 0;
        });
      
       
        
        
      }
    }); 
  });

function removeMethod(rmdiv,sl) {
    var contain_val = $("#pamount_by_method_"+sl).val();
    $(rmdiv).parent().parent().remove();
    var firstval = $(".number:eq(0)").val();
    var effetval = (contain_val?parseFloat(contain_val):0) + (firstval?parseFloat(firstval):0);
    $(".number:eq(0)").val(effetval.toFixed(2,2));
    changedueamount();
}

function customervoucher_due(id) {
     var base_url = $("#base_url").val();
   var csrf_test_name = $('[name="csrf_test_name"]').val();
    $.ajax({
        url : base_url + "account/account/customer_voucher_due_amount",
        type: "POST",
        data: {
             invoice_id: id,
             csrf_test_name: csrf_test_name

                },
        success: function(data)
        {
          
    
           $('#due_1').val(data);
           
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

$(document).ready(function() {
    "use strict";

    var frm = $("#customer_receive_form");
    frm.on('submit', function(e) {
    var inputval = parseFloat(0);
    var maintotalamount = $('#grandTotal').val();
    
    $(".number").each(function(){
      var inputdata= parseFloat($(this).val());
      inputval = inputval+inputdata;

    });

    if(parseFloat(maintotalamount) > parseFloat(inputval)){
        toastr["error"]('You should input equal Total Amount');
        return false;
    }
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            dataType: 'json',
            data: frm.serialize(),
            success: function(data) {
                if (data.status == true) {
                    toastr["success"](data.message);
                    swal({
                        title: "Success!",
                        showCancelButton: true,
                        cancelButtonText: "NO",
                        cancelButtonColor: "red",
                        confirmButtonText: "Yes",
                        customClass: "Hello",
                        confirmButtonColor: "#008000",
                        text: "Do You Want To Print ?",
                        type: "success",
                        


                    }, function(inputValue) {
                        if (inputValue === true) {
                            
                            printRawHtmlInvoice(data.details);

                        } else {
                           
                            location.reload();
                        }

                    });
                } else {
                    toastr["error"](data.exception);
                }
            },
            error: function(xhr) {
                alert('failed!');
            }
        });
    });
});

var focuser = setInterval(() => window.dispatchEvent(new Event('focus')), 200);
function printRawHtmlInvoice(view) {
    printJS({
        printable: view,
        type: 'raw-html',
        onPrintDialogClose: printJobCompleteInvoice

    });


}

function printJobCompleteInvoice() {
    location.reload();
   
}


</script>