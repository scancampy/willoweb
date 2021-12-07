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
<!-- Ion Slider -->
<script src="<?php echo base_url('plugins/ion-rangeslider/js/ion.rangeSlider.min.js'); ?>"></script>

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