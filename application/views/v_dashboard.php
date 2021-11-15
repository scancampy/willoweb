
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Welcome, <?php echo $this->session->userdata('name'); ?>!</h1>
          </div>
          <div class="col-sm-6">
           
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class='card'>
              <div class="card-body">
                
                  <a class="btn btn-app" href="<?php echo base_url('promo'); ?>">
                    <i class="fa fa-bullhorn"></i> Promo
                  </a>

                  <a class="btn btn-app" href="<?php echo base_url('promo/add'); ?>">
                    <span class="badge bg-warning"><i class="fa fa-plus"></i></span>
                    <i class="fa fa-bullhorn"></i> Promo Add
                  </a>
                
                
                  <a class="btn btn-app" href="<?php echo base_url('faq'); ?>">
                    <i class="fa fa-question"></i> FAQ
                  </a>

                  <a class="btn btn-app" href="<?php echo base_url('faq/add'); ?>">
                    <span class="badge bg-warning"><i class="fa fa-plus"></i></span>
                    <i class="fa fa-question"></i> Faq Add
                  </a>
                
                
                  <a class="btn btn-app" href="<?php echo base_url('dashboard/password'); ?>">
                    <i class="fa fa-lock"></i> Password
                  </a>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->