<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>

        <script src='https://www.google.com/recaptcha/api.js'></script>
        <link href="<?php echo base_url('assets/css/jquery-ui.min.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- Bootstrap --> 
        <link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css"/>
        <?php if (!empty($setting->rtr) && $setting->rtr == 1) {  ?>
        <!-- THEME RTL -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-rtl.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>
        <!-- Font Awesome 4.7.0 -->
        <link href="<?php echo base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet" type="text/css"/>
  
        <!-- sliderAccess css -->
        <link href="<?php echo base_url(); ?>assets/css/jquery-ui-timepicker-addon.min.css" rel="stylesheet" type="text/css"/> 
        <link href="<?php echo base_url() ?>assets/css/wickedpicker.min.css" rel="stylesheet" type="text/css"/>
        <!-- slider  -->
        <link href="<?php echo base_url(); ?>assets/css/select2.min.css" rel="stylesheet" type="text/css"/> 
        <!-- DataTables CSS -->
        <link href="<?php echo base_url('assets/datatables/dataTables.min.css') ?>" rel="stylesheet" type="text/css"/> 
          <!-- pe-icon-7-stroke -->
        <link href="<?php echo base_url('assets/css/pe-icon-7-stroke.css') ?>" rel="stylesheet" type="text/css"/> 
        <!-- themify icon css -->
        <link href="<?php echo base_url('assets/css/themify-icons.css') ?>" rel="stylesheet" type="text/css"/> 
        <!-- Pace css -->
        <link href="<?php echo base_url('assets/plugins/toastr/toastr.css'); ?>" rel=stylesheet type="text/css"/>
   
        <link href="<?php echo base_url('assets/css/bootstrap-toggle.min.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/css/custom.min.css') ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('assets/css/style.css') ?>" rel="stylesheet" type="text/css"/>
      
        
        <link href="<?php echo base_url('assets/js/sweetalert/sweetalert.css') ?>" rel="stylesheet" type="text/css"/>
        <!-- summernote css -->
       
        <?php if (!empty($setting->rtr) && $setting->rtr == 1) {  ?>
            <!-- THEME RTL -->
            <link href="<?php echo base_url('assets/css/custom-rtl.css') ?>" rel="stylesheet" type="text/css"/>
        <?php } ?>
        <!-- jQuery -->
       <script src="<?php echo base_url('assets/js/jquery-3.4.1.min.js?v=3.4.1') ?>" type="text/javascript"></script>
       <script src="<?php echo base_url() ?>assets/js/wickedpicker.min.js" ></script>
       <script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js" type="text/javascript"></script>
<style>

.login,
.image {
  min-height: 100vh;
}

.bg-image {
  background-image: url('assets/dist/img/login.jpg');
  background-size: cover;
  background-position: center center;
}

</style>
    </head>
    <body style="background-image: url('assets/dist/img/login.jpg');">
        <!-- Content Wrapper -->

<div class="container-fluid">
    <div class="row no-gutter">
        <!-- The image half -->
        <div class="col-md-6 d-none d-md-flex bg-image"></div>


        <!-- The content half -->
        <div class="col-md-6 bg-light">
            <div class="login d-flex align-items-center py-5">

                <!-- Demo content-->
                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            <h3 class="display-4">Split page!</h3>
                            <p class="text-muted mb-4">Create a login split page using Bootstrap 4.</p>
                            <form>
                                <div class="form-group mb-3">
                                    <input id="inputEmail" type="email" placeholder="Email address" required="" autofocus="" class="form-control rounded-pill border-0 shadow-sm px-4">
                                </div>
                                <div class="form-group mb-3">
                                    <input id="inputPassword" type="password" placeholder="Password" required="" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                </div>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                                    <label for="customCheck1" class="custom-control-label">Remember password</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Sign in</button>
                                <div class="text-center d-flex justify-content-between mt-4"><p>Snippet by <a href="https://bootstrapious.com/snippets" class="font-italic text-muted"> 
                                        <u>Boostrapious</u></a></p></div>
                            </form>
                        </div>
                    </div>
                </div><!-- End -->

            </div>
        </div><!-- End -->

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="passwordrecoverymodal" tabindex="-1" role="dialog" aria-labelledby="recoverylabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="recoverylabel"><?php echo display('password_recovery')?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div id="outputPreview" class="alert hide modal-title" role="alert" >
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
      </div>
      <div class="modal-body">
           <?php echo form_open('dashboard/recoverydata/password_recovery', array('id' => 'passrecoveryform',)) ?>
                      <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label"><?php echo display('email')?> <i class="text-danger">*</i></label>
                            <div class="col-sm-6">
                                <input class="form-control" name ="rec_email" id="rec_email" type="text" placeholder="<?php echo display('email') ?>"  required="">
                            </div>
                            <input type ="hidden" name="csrf_test_name" id="CSRF_TOKEN" value="<?php echo $this->security->get_csrf_hash();?>">
                        </div>
                        
                        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <input type="submit" id="submit_recovery" class="btn btn-success" value="Send">
      </div>
       <?php echo form_close() ?>
    </div>
  </div>
</div>
    <script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>" type="text/javascript"></script> 
        <!-- bootstrap js -->
        <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" type="text/javascript"></script>  
        <!-- pace js -->
        <script src="<?php echo base_url('assets/js/pace.min.js') ?>" type="text/javascript"></script>  
        <!-- SlimScroll -->
        <script src="<?php echo base_url('assets/js/jquery.slimscroll.min.js') ?>" type="text/javascript"></script>  
        <!-- bootstrap timepicker -->
     
        <script src="<?php echo base_url() ?>assets/js/jquery-ui-timepicker-addon.min.js" type="text/javascript"></script> 
        <!-- select2 js -->
        <script src="<?php echo base_url() ?>assets/js/select2.min.js" type="text/javascript"></script>
    


        <!-- ChartJs JavaScript -->
        <script src="<?php echo base_url('assets/js/Chart.min.js?v=2.5') ?>" type="text/javascript"></script>

        <!-- DataTables JavaScript -->
        <script src="<?php echo base_url("assets/datatables/dataTables.min.js") ?>"></script>
        <!-- Table Head Fixer -->
        <script src="<?php echo base_url() ?>assets/js/tableHeadFixer.js" type="text/javascript"></script> 
        <!-- Admin Script -->
        <script src="<?php echo base_url('assets/js/frame.js') ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url('assets/js/bootstrap-toggle.min.js') ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url('assets/plugins/toastr/toastr.min.js'); ?>"></script>
        <script src="<?php echo base_url() ?>assets/js/sweetalert/sweetalert.min.js" type="text/javascript"></script>
        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url() ?>assets/js/custom.js" type="text/javascript"></script>
         <script src="<?php echo base_url() ?>assets/js/jstree.min.js" ></script>
    </body>
</html>