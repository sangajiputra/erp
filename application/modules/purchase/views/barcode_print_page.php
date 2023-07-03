  <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4> No Of Page</h4>
                                
                                <div class="row">
                               <div class="col-sm-12">
                                <div class="form-group row">
                                <form>
                                    <div class="col-sm-4">
                                    <input type="number" name="qty" class="form-control" value="<?php echo (isset($_GET["qty"])?$_GET["qty"]:"1");
                                ?>">
                                </div>
                                 <div class="col-sm-1">
                                    <input type="submit" name="submit" class="btn btn-success" value="Generate">
                                </div>
                                 <div class="col-sm-2">
                                    <input type="submit" name="submit" class="btn btn-primary" value="Download Excel">
                                    </div>
                                </form>
                                </div>
                                </div>
                                </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div style="overflow: auto;">  
                           <div class="container">
                               <div class="row">
                                   <?php foreach ($qr_image as $a) { ?>
                                   <div class="col-md-3" style="margin: 10px -50px;">
                                       <div class="barcode-inner barcode-innerdiv">
                                            <img src="<?php echo base_url('my-assets/image/qr/'.$a) ?>" class="img-responsive center-block qrcode-image" alt="">
                                            <!-- <div class="product-name-details qrcode-productdetails"><?php echo $a ?></div> -->
                                        </div>
                                   </div>
                                   <?php } ?>
                               </div>
                           </div>
                       </div>
                    </div>
                </div>
            </div>
        </div>