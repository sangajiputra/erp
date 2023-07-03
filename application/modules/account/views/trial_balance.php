
<div class="row">
    <div class="col-sm-12 col-md-12">
        <div class="panel panel-bd lobidrag">
            
            <div class="panel-body">
                <?php echo  form_open_multipart('trial_balance') ?>
                <div class="row" id="">
                    <div class="col-sm-6">
     
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('from_date') ?><span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text" name="dtpFromDate" autocomplete="off" value="<?php date('Y-m-d')?>" placeholder="<?php echo display('from_date') ?>" class="datepicker form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"><?php echo display('to_date') ?><span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <input type="text"  name="dtpToDate" autocomplete="off" value="<?php date('Y-m-d')?>" placeholder="<?php echo display('to_date') ?>" class="datepicker form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date" class="col-sm-4 col-form-label"></label>
                            <div class="col-sm-8">
                                <input type="checkbox" id="chkWithOpening" name="chkWithOpening" size="40"/>&nbsp;&nbsp;&nbsp;<label for="chkWithOpening"><?php echo display('with_details') ?></label>
                            </div>
                        </div>

                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-success w-md m-b-5"><?php echo display('find') ?></button>
                        </div>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>
</div>
