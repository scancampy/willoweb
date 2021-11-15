<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h1>Change Password</h1>
          </div>
           <?php if(@$error) { ?>
            <div class="col-12">
      <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-ban"></i> Alert!</h5>
                 <?php  echo $error; ?>
                </div>
              </div>
              <?php } ?>

              <?php if(@$notif) { ?>
            <div class="col-12">
      <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                 <?php  echo $notif; ?>
                </div>
              </div>
              <?php } ?>
          <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Password Data</h3>
                </div>

                
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo current_url(); ?>" enctype='multipart/form-data'>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="title">Old Password</label>
                      <input type="password" class="form-control" id="oldpass" name="oldpass" required autofocus>
                    </div>
                     <div class="form-group">
                      <label for="title">New Password</label>
                      <input type="password" class="form-control" id="newpass" name="newpass" required >
                    </div>
                     <div class="form-group">
                      <label for="title">Repeat Password</label>
                      <input type="password" class="form-control" id="repass" name="repass" required >
                    </div>
                  </div>
                  <!-- /.card-body -->

                  <div class="card-footer">
                    <button type="submit" name="btnsubmit" value="submit" class="btn btn-primary">Submit</button>
                  </div>
                </form>
              </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->