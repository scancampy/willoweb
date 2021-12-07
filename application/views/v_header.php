<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Willow | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url('img/wil_ico.png'); ?>" rel="icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
 <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php  echo base_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
  <link rel="stylesheet" href="<?php  echo base_url('plugins/bootstrap-datepicker.min.css'); ?>">
   <?php /* <link rel="stylesheet" href="<? echo base_url('plugins/summernote/summernote-bs4.css'); ?>"> */ ?>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php  echo base_url('css/adminlte.min.css'); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Ion Slider -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/ion-rangeslider/css/ion.rangeSlider.min.css'); ?>">
  
  <style>
      @font-face {
    font-family: 'quicksandbold';
    src: url('<?php  echo base_url('fonts/quicksand-bold-webfont.woff2'); ?>') format('woff2'),
         url('<?php echo base_url('fonts/quicksand-bold-webfont.woff'); ?>') format('woff');
    font-weight: normal;
    font-style: normal;

}

@font-face {
    font-family: 'quicksandregular';
    src: url('<?php echo base_url('fonts/quicksand-regular-webfont.woff2'); ?>') format('woff2'),
         url('<?php echo base_url('fonts/quicksand-regular-webfont.woff'); ?>') format('woff');
    font-weight: normal;
    font-style: normal;

}

    div#example2_filter { 
      text-align: right !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
  <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      
    </ul>

   

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-cog"></i>        
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="<?php echo base_url('dashboard/password'); ?>" class="nav-link">
            <i class="fa fa-lock mr-2"></i> Change Password
          </a>
          <div class="dropdown-divider"></div>
          <a href="<?php echo base_url('dashboard/signout'); ?>" class="nav-link">
            <i class="  fa fa-power-off mr-2"></i> Sign Out
          </a>
        </div>
      </li>
     
    </ul>
  </nav>
  <!-- /.navbar -->