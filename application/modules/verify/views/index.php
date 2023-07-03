<!--start to page content-->
       <div class="page-content">

        <div class="card rounded-3 mb-3">
          <div class="card-body">
              <div class="form-body">
                <h5 class="mb-0 fw-bold">Check Serial Number Here!</h5>
                <div class="my-3 border-bottom"></div>
                <div class="mb-3">
                  <label class="form-label">Enter SN</label>
                  <input type="text" class="form-control rounded-3" name="sn" required>
                </div>
              </div>
          </div>
        </div>

       </div>
     <!--end to page content-->


     <!--start to footer-->
      <footer class="page-footer fixed-bottom border-top d-flex align-items-center justify-content-center gap-3">
        <button type="button" onclick="GoAnyware()" class="btn btn-primary rounded-3 btn-dark flex-fill"><i class="bi bi-send me-2"></i>Check SN</button>
      </footer>
       <!--end to footer-->
   </div>
  <!--end sidenav-->
</div>
   <!--end wrapper-->

<script type="text/javascript">
  function GoAnyware(){
    var base = '<?= base_url() ?>';
    var value= document.getElementsByName("sn")[0].value;
    window.location.href = base+'verify/sn/'+value;
  }
</script>