<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo (!empty($title)?$title:null) ?></title>

    <!-- Plugins -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets_fe/plugins/metismenu/metisMenu.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets_fe/plugins/metismenu/mm-vertical.css" />
     <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets_fe/plugins/slick/slick.css" />
     <link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets_fe/plugins/slick/slick-theme.css" />

    <!--CSS Files-->
    <link href="<?php echo base_url() ?>assets_fe/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../../../../cdn.jsdelivr.net/npm/bootstrap-icons%401.8.3/font/bootstrap-icons.css">
    <link href="<?php echo base_url() ?>assets_fe/css/style.css" rel="stylesheet"/>
    <link href="<?php echo base_url() ?>assets_fe/css/dark-theme.css" rel="stylesheet"/>
  </head>
  <body>

    <!--page loader-->
    <div class="loader-wrapper">
      <div class="d-flex justify-content-center align-items-center position-absolute top-50 start-50 translate-middle">
        <div class="spinner-border text-white" role="status">
          <span class="visually-hidden">Loading...</span>
        </div>
      </div>
    </div>
   <!--end loader-->

   <!--start wrapper-->
    <div class="wrapper">

       <!--start to header-->
       <header class="top-header fixed-top border-bottom d-flex align-items-center">
        <nav class="navbar navbar-expand w-100 p-0 gap-3 align-items-center">
          <div class="nav-button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidenav"><a href="javascript:;"><i class="bi bi-list"></i></a></div>
            <div class="nav-button" onclick="history.back()"><a href="javascript:;"><i class="bi bi-arrow-left"></i></a></div>
            <div class="contact-us">
              <h6 class="mb-0 fw-bold text-dark">ERP</h6>
            </div>
            <form class="searchbar">
              <div class="position-absolute top-50 translate-middle-y search-icon start-0 ms-4"><i class="bi bi-search"></i></div>
              <input class="form-control px-5" type="text" placeholder="Search for anything">
              <div class="position-absolute top-50 translate-middle-y end-0 search-close-icon me-4"><i class="bi bi-x-lg"></i></div>
            </form>
            <ul class="navbar-nav ms-auto d-flex align-items-center top-right-menu">
              <li class="nav-item mobile-search-button">
                <a class="nav-link" href="javascript:;"><i class="bi bi-search"></i></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="wishlist.html"><i class="bi bi-heart"></i></a>
              </li>
              <li class="nav-item">
                <!-- <a class="nav-link position-relative" href="cart.html">
                  <div class="cart-badge">8</div>
                  <i class="bi bi-bag"></i>
                </a> -->
              </li>
            </ul>
        </nav>
       </header>
        <!--end to header-->