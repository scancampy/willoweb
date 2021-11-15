<!-- Content Wrapper. Contains page content -->
<style type="text/css">
  .cekvisible:hover {
    cursor: pointer;
  }
</style>
  <div class="content-wrapper">
  

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <h1>Promo</h1>
          </div>
          <?php if(@$notif =='add_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>New promo added succesffully!</p>
                </div>
              </div>
            <?php } else if(@$notif =='del_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>Promo deleted succesffully!</p>
                </div>
              </div>
            <?php } ?>
           <div class="col-12">
          <div class="card">
            <div class="card-header ">
              <div class="col-2">
                <a href="<?php echo base_url('promo/add'); ?>" class="btn btn-block btn-primary btn-sm"><i class="fa fa-plus"></i> Add Promo</a>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th style="width: 5%;">No</th>
                  <th style="width: 20%;">Title</th>
                  <th style="width: 40%;">Short Desc</th>
                  <th style="width: 15%;">Promo Date</th>
                  <th style="width: 10%;">Visibility</th>
                  <th style="width: 10%;">Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($promo as $key => $value) { ?>
                  <tr>
                    <td><?php echo $key+1; ?></td>
                    <td><strong><?php echo $value->title; ?></strong><br/><img style="width: 220px;" src="<?php echo base_url('images/promo/'.$value->id.'_small.jpg'); ?>"  class="img-thumbnail"> </td>
                    <td><?php echo $value->short_desc; ?></td>
                    <td><?php echo strftime("%d-%b-%Y", strtotime($value->promo_date)); ?></td>
                    <td><?php if($value->is_visible == 1) { ?>
                      <span class="cekvisible" idpromo="<?php echo $value->id; ?>"><i class="fa fa-check text-success"></i></span>
                        <?php } else { ?>
                          <span class="cekvisible" idpromo="<?php echo $value->id; ?>"><i class="fa fa-times text-danger"></i></span>
                        <?php } ?></td>
                    <td>
                      <a href="<?php echo base_url('promo/edit/'.$value->id); ?>" class="btn btn-block btn-primary btn-xs"><i class="fa fa-edit"></i> Edit</a>

                      <a onclick="return confirm('Are you sure you want to delete \'<?php echo $value->title; ?>\'');" href="<?php echo base_url('promo/delete/'.$value->id); ?>" class="btn btn-block btn-danger btn-xs"><i class="fa fa-trash"></i> Delete</a>
                    </td>
                  </tr>
                <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>No</th>
                  <th>Title</th>
                  <th>Short Desc</th>
                  <th>Created</th>
                  <th>Visibility</th>
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