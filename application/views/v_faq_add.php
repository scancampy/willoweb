<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h1>Add New FAQ</h1>
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
          <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">FAQ Data</h3>
                </div>

                
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="<?php echo current_url(); ?>" enctype='multipart/form-data'>
                  <div class="card-body">
                    <div class="form-group">
                      <label for="title">Title</label>
                      <input type="text" class="form-control" id="title" name="title" required autofocus>
                    </div>
                    <div class="form-group">
                      <label for="short_desc">Content / Full Text</label>
                     <textarea class="textarea" name="content" id='content' required
                          style="width: 100%; height: 300px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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