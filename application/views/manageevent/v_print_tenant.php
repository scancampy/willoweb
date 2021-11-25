<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Willow | Admin | Print Tenant QR Code</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="<?php echo base_url('img/wil_ico.png'); ?>" rel="icon" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('plugins/fontawesome-free/css/all.min.css'); ?>">
 <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php  echo base_url('plugins/overlayScrollbars/css/OverlayScrollbars.min.css'); ?>">
  <link rel="stylesheet" href="<?php  echo base_url('plugins/bootstrap-datepicker.min.css'); ?>">
   <?php /* <link rel="stylesheet" href="<? echo base_url('plugins/summernote/summernote-bs4.css'); ?>"> */ ?>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.css" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php  echo base_url('css/adminlte.min.css'); ?>">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  
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
<body>
  <div style="display: flex; flex-direction: row;  flex-wrap:wrap;">
    <?php 
      foreach($events_tenant as $key => $value) { ?>
      <div style="margin: 5px; padding: 10px; border:1px solid black; width: 30%;" class="text-center">
        <img src="<?php echo base_url('tenant/'.$value->kode.'.png'); ?>" style="width: 100%;" />
        <br/>
        <strong ><?php echo $value->nama; ?></strong>
      </div>
    <?php 
    } ?>
  </div>

 <footer class="main-footer">
    
    <strong>Copyright &copy; 2020 Willow.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo base_url('plugins/jquery/jquery.min.js'); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('plugins/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins/bootstrap-datepicker.min.js'); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js'); ?>"></script>
<!-- Datatable -->
<script src="<?php echo base_url('plugins/datatables/jquery.dataTables.js'); ?>"></script>
<script src="<?php echo base_url('plugins/datatables-bs4/js/dataTables.bootstrap4.js'); ?>"></script>

<!-- Summernote -->
<?php /*<script src="<?php echo base_url('plugins/summernote/summernote-bs4.min.js'); ?>"></script> */ ?>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('plugins/moment/moment.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>

<!-- SweetAlert2 -->
<script src="<?php echo base_url('plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>

<!-- jquery-validation -->
<script src="<?php echo base_url('plugins/jquery-validation/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('plugins/jquery-validation/additional-methods.min.js'); ?>"></script>

<!-- bs-custom-file-input -->
<script src="<?php echo base_url('plugins/bs-custom-file-input/bs-custom-file-input.min.js'); ?>"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url('js/adminlte.min.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('js/demo.js'); ?>"></script>
<script type="text/javascript">
  $(document).ready(function() {
    <?php echo @$js; ?>
  });
</script>
</body>
</html>
