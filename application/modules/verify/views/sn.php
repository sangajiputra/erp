<!--start to page content-->
   <div class="page-content p-0">


    <ul class="list-group list-group-flush rounded-0">
      <?php foreach($data as $a){ ?>
      <li class="list-group-item py-3">
        <div class="d-flex flex-row align-items-start align-items-stretch gap-3">
          <div class="product-img">
             <img src="<?php echo base_url('my-assets/image/qr/'.$sn.'.png') ?>" class="rounded-3" width="100" alt="">
          </div>
          <div class="product-info flex-grow-1">
             <h6 class="fw-bold mb-1 text-dark"><?= $a['product_name'] ?></h6>
             <p class="mb-0">Rp. <?= number_format($a['price']) ?></p>
            <div class="mt-3 hstack gap-2">
              <button type="button" class="btn btn-sm border rounded-3">Size : XXL</button>
              <button type="button" class="btn btn-sm border rounded-3">Qty : 2</button>
           </div>
          </div>
         </div>
      </li>
    <?php } ?>
    </ul>

   </div>
 <!--end to page content-->