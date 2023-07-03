<script src="<?php echo base_url() ?>my-assets/js/admin_js/json/product.js" type="text/javascript"></script>
<div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo $title; ?></h4>
                        </div>
                    </div>
                    <?php echo form_open_multipart('batch_form/', array('class' => 'form-vertical', 'id' => 'insert_product', 'name' => 'insert_product')) ?>
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="purchaseTable">
                                <thead>
                                    <tr>
                                        <th class="text-center"><?php echo display('action') ?></th>
                                        <th class="text-center" width="20%"><?php echo display('item_information') ?><i class="text-danger">*</i></th>
                                        <th class="text-center"><?php echo display('stock_ctn') ?></th>
                                        <th class="text-center"><?php echo display('quantity') ?> <i class="text-danger">*</i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="addPurchaseItem">
                                    <tr>
                                        <td>
                                            <button class="btn btn-danger text-right red" type="button"
                                                value="<?php echo display('delete')?>" onclick="deleteRow(this)" tabindex="8"><i
                                                    class="fa fa-close"></i></button>
                                        </td>
                                        <td class="span3 supplier">
                                            <input type="text" name="product_name" required
                                                class="form-control product_name productSelection"
                                                onkeypress="product_pur_or_list(1);"
                                                placeholder="<?php echo display('product_name') ?>" id="product_name_1"
                                                tabindex="5">

                                            <input type="hidden" class="autocomplete_hidden_value product_id_1"
                                                name="product_id[]" id="SchoolHiddenId">

                                            <input type="hidden" class="sl" value="1">
                                        </td>

                                        <td class="wt">
                                            <input type="text" id="available_quantity_1"
                                                class="form-control text-right stock_ctn_1" placeholder="0.00" readonly />
                                        </td>

                                        <td class="text-right">
                                            <input type="text" name="product_quantity[]" id="cartoon_1" required="" min="0"
                                                class="form-control text-right store_cal_1" onkeyup="calculate_store(1);"
                                                onchange="calculate_store(1);" placeholder="0.00" value="" tabindex="6" />
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td> <button type="button" id="add_invoice_item" class="btn btn-info"
                                                name="add-invoice-item" onClick="addPurchaseOrderField1('addPurchaseItem')"
                                                tabindex="9"><i class="fa fa-plus"></i></button>

                                            <input type="hidden" name="baseUrl" class="baseUrl"
                                                value="<?php echo base_url();?>" />
                                        </td>
                                        
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <div class="form-group row text-right">
                            <div class="col-sm-12 p-20">
                                <input type="submit" id="add_purchase" class="btn btn-primary btn-large" name="add-purchase"
                                    value="<?php echo display('submit') ?>" />

                            </div>
                        </div>
                    </div>
                    <?php echo form_close() ?>
                </div>
                <input type="hidden" id="supplier_list" value='<?php if ($supplier) { ?><?php foreach($supplier as $suppliers){?><option value="<?php echo $suppliers['supplier_id']?>"><?php echo $suppliers['supplier_name']?></option><?php }}?>' name="">
            </div>
        </div>