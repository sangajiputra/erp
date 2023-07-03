 <div class="row">
     <div class="col-sm-12">
         <div class="panel panel-bd lobidrag">
             <div class="panel-heading">
                 <div class="panel-title">
                     <h4><?php echo $title ?> </h4>
                 </div>
             </div>

             <div class="panel-body">
                 <form action="<?= $base_url ?>" method="post">
                 <input type="hidden" name="id" id="id" value="<?php echo $customer->id_group?>">
                 <div class="form-group row">
                     <label for="group_name"
                         class="col-sm-2 text-right col-form-label">Group Name <i
                             class="text-danger"> * </i>:</label>
                     <div class="col-sm-10">
                         <div class="">
                             <input type="text" name="group_name" class="form-control" id="group_name"
                                 placeholder="Group Name"
                                 value="<?php echo $customer->group_name?>">
                             <input type="hidden" name="old_name" value="<?php echo $customer->group_name?>">
                         </div>

                     </div>
                 </div>

                 <div class="form-group row">
                     <div class="col-sm-6 text-right">
                     </div>
                     <div class="col-sm-6 text-right">
                         <div class="">

                             <button type="submit" class="btn btn-success">
                                 <?php echo (empty($customer->id_group)?display('save'):display('update')) ?></button>

                         </div>

                     </div>
                 </div>
             </form>
             </div>

         </div>
     </div>
 </div>