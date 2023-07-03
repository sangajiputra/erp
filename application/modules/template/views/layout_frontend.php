<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $this->load->view('includes/head_frontend') ?>
      
<?php echo $this->load->view($module.'/'.$page) ?>

<?php $this->load->view('includes/foot_frontend') ?>