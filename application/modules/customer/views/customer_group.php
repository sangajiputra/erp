 <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd lobidrag">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4><?php echo $title ?> </h4>
                        </div>
                    </div>
                   
                    <div class="panel-body">
                    <a href="<?= $base_url.'add_customer_group' ?>" class="btn btn-primary btn-xs m-b-5 custom_btn" data-toggle="tooltip" data-placement="left" title="Tambah">Tambah</a>
<div class="table-responsive">
                <table class="table table-bordered" id="CustomerGroupList"  width="100%">
                    <thead>
 
                        <tr>
                            <th>Nama Group</th>
                            <th><?php echo display('action') ?> 
                            </th>
                        </tr>
                    </thead>
                    <tbody id="customer_tablebody">
                       
                    </tbody>
                  </table>  
              </div>
                  
            </div>
         

        </div>
    </div>
</div>
 
