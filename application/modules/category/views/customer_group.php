<!--start to page content-->
       <div class="page-content">

        <div class="row row-cols-1 g-3">
          <?php $i=1; foreach($data as $a){ ?>
          <div class="col" onclick="openGroup(<?= $i ?>)">
              <div class="card rounded-3 mb-0">
                <div class="card-body">
                   <div class="d-flex flex-row align-items-center justify-content-between gap-2">
                      <div class="category-name">
                        <h6 class="mb-0 fw-bold text-dark fs-5"><?= $a['group_name'] ?></h6>
                      </div>
                      <div class="category-img">
                        <img src="<?php echo base_url((!empty($setting->favicon)?$setting->favicon:'assets/img/icons/mini-logo.png')) ?>" class="img-fluid" width="30" alt=""/>
                       </div>
                   </div>
                   <div id="group<?= $i ?>" class="table-responsive" style="display: none; padding-top: 10px;">
                     <table class="table-responsive">
                      <thead>
                        <tr>
                         <th style="border-color: rgb(206, 206, 206); background: rgb(242, 242, 242); border-width: 1px;padding: 2px 4px;">Name</th>
                         <th style="border-color: rgb(206, 206, 206); background: rgb(242, 242, 242); border-width: 1px;padding: 2px 4px;">Country</th>
                         <th style="border-color: rgb(206, 206, 206); background: rgb(242, 242, 242); border-width: 1px;padding: 2px 4px;">Mobile Number</th>
                       </tr>
                      </thead>
                      <tbody id="content<?= $i ?>"></tbody>
                     </table>
                   </div>
                </div>
              </div>
          </div>
          <?php $i++; } ?>

        </div><!--end row-->

       </div>
     <!--end to page content-->