  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Master Event</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">HOME</a></li>
              <li class="breadcrumb-item active">DASHBOARD</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header" >
                <div class='col-md-12 d-flex justify-content-between'>
                  <h3 class="card-title">Data Master Event</h3> <a href="#" class="btn btn-primary btn-sm" id="btnadd" data-toggle="modal" data-target="#modal-lg">Tambah Event</a>
                </div>
              </div>
              <div class="card-body">
                <?php if(@$notif =='add_event_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>Event baru berhasil diatambahkan!</p>
                </div>
              </div>
            <?php } else if(@$notif =='edit_event_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>Event berhasil tersimpan!</p>
                </div>
              </div>
            <?php } else if(@$notif =='del_event_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>Event berhasil dihapus!</p>
                </div>
              </div>
            <?php } ?>

            <?php if(@$notif =='banner_error') { ?>
          <div class="col-12">
           <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Upload Banner Error!</h5>
                  <p><?php echo $notif_msg; ?></p>
                </div>
              </div>
            <?php }  ?>
                <table>
                  <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Event</th>
                        <th>Nama Singkat</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Aktif</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php 
                        $k = 1;
                        foreach($events as $b) { ?>
                        <tr>
                        <td><?php echo $k; $k++; ?></td>
                        <td><?php echo $b->nama; ?></td>
                        <td><?php echo $b->singkat; ?></td>
                        <td><?php echo strftime("%d %B %Y", strtotime($b->tanggal_mulai)); ?></td>
                        <td><?php echo strftime("%d %B %Y", strtotime($b->tanggal_selesai)); ?></td>
                        <td>
                          <?php
                            if($b->is_aktif == 1) { ?>
                              <span class="text-success"><i class="far fa-check-circle"></i></span>
                            <?php } else { ?>
                              <span class="text-muted"><i class="far fa-times-circle"></i></span>
                            <?php } ?></td>
                        <td><a href="#" eventid="<?php echo $b->id; ?>" data-toggle="modal" data-target="#modal-lg" class="btn btn-info btn-sm btnedit"><i class="far fa-edit nav-icon"></i> EDIT</a>

                        <a href="<?php echo base_url('events/delperiode/'.$b->id); ?>" class="btn btn-danger btn-sm btntrash" onclick="return confirm('Yakin hapus?');"><i class="far fa-trash-alt nav-icon"></i> HAPUS</a>
                        </td>
                      </tr>
                       <?php } 
                        ?>
                      </tbody>
                    </table>
                </table>
              </div>
            </div>

          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
    <form action="<?php echo base_url('events/periode'); ?>" method="post" id="formtambahperiode" enctype='multipart/form-data'>
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id='title_modal'>Tambah Event</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
               <input type="hidden" name="hididperiode" id="hididperiode" />
              <div class="form-group">
                <label for="nama">Nama Event</label>
                <input type="text" required  name="nama" class="form-control" id="nama" placeholder="">
              </div>

              <div class="form-group">
                <label for="singkat">Nama Singkat</label>
                <input type="text" required name="singkat" class="form-control" id="singkat" placeholder="">
              </div>

              <div class="form-group">
                <label>Deskripsi</label>
                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3" placeholder=""></textarea>
              </div>

              <div class="row">
                <div class="col-6">
                  <label for="probabilitas">Probabilitas Voucher</label>
                    
                  <div class="input-group">
                    <input type="number" required name="probabilitas" class="form-control" id="probabilitas" placeholder="">
                    
                       <div class="input-group-append">
    <span class="input-group-text" id="basic-addon2">%</span>
  </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group">
                    <label for="max_voucher_harian">Kuota Scan Harian</label>
                    <input type="number" min="1" value="1" required name="max_voucher_harian" class="form-control" id="max_voucher_harian" placeholder="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-6">
                  <div class="form-group " >
                      <label>Tanggal Mulai</label>
                      <input type="date" class="form-control" name="tanggal_mulai" value="<?php echo date('Y-m-d'); ?>"  id="tanggal_mulai" >
                      <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                      </div>
                  </div>
                </div>
                <div class="col-6">
                  <div class="form-group " >
                      <label>Tanggal Selesai</label>
                      <input type="date" class="form-control" name="tanggal_selesai" value="<?php echo date('Y-m-d'); ?>"  id="tanggal_selesai" >
                      <div class="input-group-addon">
                          <span class="glyphicon glyphicon-th"></span>
                      </div>
                  </div>
                </div>
              </div>
              

              

              <div class="form-group" id="current_banner_div">
                <label>Banner Event Sekarang</label>
                <img src="" style="width:100px; height: auto;" class="form-control" id="current_banner_img" />
              </div>

              <div class="form-group">
                <label>Upload Banner</label>
                <input type="file" class="form-control" id="banner_img" name="banner_img" accept="image/*">
                <span class="text-muted">Format: .jpg (500x500)</span>
              </div>

              


              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="is_aktif" name="is_aktif" value="1">
                <label class="form-check-label" for="is_aktif">Aktifkan Periode Event</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btnsubmit" id="btnsubmit" value="submit">Submit</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>