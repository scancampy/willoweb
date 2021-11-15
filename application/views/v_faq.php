
  <div class="content-wrapper">
  

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h1>FAQ</h1>
          </div>
          <?php if(@$notif =='add_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>New FAQ added succesffully!</p>
                </div>
              </div>
            <?php } else if(@$notif =='del_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>FAQ deleted succesffully!</p>
                </div>
              </div>
            <?php } else if(@$notif =='order_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>Order changed succesffully!</p>
                </div>
              </div>
            <?php } else if(@$notif =='order_failed') { ?>
          <div class="col-12">
           <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Failed!</h5>
                  <p>Order changed failed!</p>
                </div>
              </div>
            <?php } else if(@$notif =='del_failed') { ?>
          <div class="col-12">
           <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Failed!</h5>
                  <p>Delete FAQ failed!</p>
                </div>
              </div>
            <?php } else if(@$notif =='del_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>FAQ deleted succesfully!</p>
                </div>
              </div>
            <?php } ?>
           <div class="col-12">
          <div class="card">
            <div class="card-header ">
              <div class="col-2">
                <a href="<?php echo base_url('faq/add'); ?>" class="btn btn-block btn-primary btn-sm"><i class="fa fa-plus"></i> Add Faq</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th style="width: 5%;">No</th>
                  <th style="width: 30%;">FAQ</th>
                  <th style="width: 40%;">Content</th>
                  <th style="width: 10%;">Urutan</th>
                  <th style="width: 10%;">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($faq as $key => $value) { ?>
                  <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><strong><?php echo $value->faq; ?></strong></td>
                    <td><?php echo word_limiter($value->content, 10); ?>...</td>
                    <td>
                    <?php if($key != 0) { ?>
                      <a class="btn btn-xs  btn-warning" href="<?php echo base_url('faq/up/'.$value->id); ?>">
                        <i class="fa fa-chevron-up"></i>
                      </a>
                    <?php } ?>
                    <?php if($key != count($faq)-1) { ?>
                       <a class="btn btn-xs  btn-warning" href="<?php echo base_url('faq/down/'.$value->id); ?>">
                        <i class="fa fa-chevron-down"></i>
                      </a>
                    <?php } ?>

                    </td>                   
                    <td>
                      <a href="<?php echo base_url('faq/edit/'.$value->id); ?>" class="btn btn-block btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>

                      <a onclick="return confirm('Are you sure you want to delete \'<?php echo $value->faq; ?>\'');" href="<?php echo base_url('faq/delete/'.$value->id); ?>" class="btn btn-block btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>FAQ</th>
                  <th>Content</th>
                  <th>Urutan</th>
                  <th>Actions</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->