  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Event</h1>
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
              <div class="card-body">
                <form method="get" action="<?php echo current_url(); ?>" id="formpilihevent">
                  <div class="form-group">
                    <label>Event</label>
                    <select class="form-control" name="eventid" id="eventid">
                      <option value="-">[Pilih Event]</option>
                      <?php foreach($events as $key => $value) { ?>
                        <option <?php if($this->input->get('eventid') == $value->id) { echo 'selected'; } ?> value="<?php echo $value->id; ?>"><?php echo $value->nama; ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </form>
                <?php if(isset($event) && count($event) >0) { ?>
                <div id="infoevent_div" >
                  <div class="table-responsive">
                    <table class="table">
                      <tbody><tr>
                        <th style="width:20%">Nama Event:</th>
                        <td style="width:30%"><?php echo $event[0]->nama; ?></td>
                        <th style="width:20%">Nama Singkat</th>
                        <td style="width:30%"><?php echo $event[0]->singkat; ?></td>
                      </tr>
                      <tr>
                        <th>Tanggal:</th>
                        <td><?php echo strftime("%d %B %Y", strtotime($event[0]->tanggal_mulai)).' - '.strftime("%d %B %Y", strtotime($event[0]->tanggal_selesai)); ?></td>
                        <th>Jml. Voucher Harian:</th>
                        <td><?php echo $event[0]->max_voucher_harian; ?></td>
                      </tr>
                      <tr>
                        <th>Deskripsi:</th>
                        <td colspan="3"><?php echo $event[0]->deskripsi; ?></td>
                      </tr>
                    </tbody></table>
                  </div>
                </div>
                <?php } ?>
              </div>
            </div>


          </div>
          <?php if(isset($event) && count($event) >0) { ?>
          <div class="col-md-12">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link <?php if($this->input->get('tab') == 'activity' || empty($this->input->get('tab'))) { echo 'active'; } ?>" href="#activity" data-toggle="tab">Tenant</a></li>
                  <li class="nav-item"><a class="nav-link <?php if($this->input->get('tab') == 'timeline') { echo 'active'; } ?>" href="#timeline" data-toggle="tab">Voucher</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane <?php if($this->input->get('tab') == 'activity' || empty($this->input->get('tab'))) { echo 'active'; } ?>" id="activity">
                    <div class="row" style="margin-bottom: 20px;">
                      <?php if(@$notif =='add_tenant_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>Tenant berhasil didaftarkan di event ini!</p>
                </div>
              </div>
            <?php } else if(@$notif =='remove_tenant_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>Tenant berhasil dihapus dari event ini!</p>
                </div>
              </div>
            <?php } else if(@$notif =='add_tenant_failed') { ?>
          <div class="col-12">
           <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Error Registrasis!</h5>
                  <p>Gagal mendaftarkan tenant karena: <?php echo strip_tags($notif_msg); ?>!</p>
                </div>
              </div>
            <?php } ?>
                      <div class="col-md-12 text-right">
                        <button class="btn btn-primary btn-sm" id="btnaddtenant" data-toggle="modal" data-target="#modal-lg"><i class="far fa-user nav-icon"></i> Tambah Tenant</button>
                        <a href="<?php echo base_url('manageevent/printqr/'.$this->input->get('eventid')); ?>" class="btn btn-info btn-sm"><i class="fas fa-qrcode"></i> Print QR</a>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Tenant</th>
                        <th>Logo</th>
                        <th>Promo</th>
                        <th>Link</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                         <?php 
                        if(count($events_tenant) ==0) { ?>
                          <tr><td colspan="6" class="text-center text-muted">Belum ada tenant yang diregistrasikan pada event ini</td></tr>
                        <?php 
                        } 

                        $k = 1;
                        foreach($events_tenant as $b) { ?>
                        <tr>
                        <td><?php echo $k;  ?></td>
                        <td><?php echo $b->nama; ?></td>
                         <td>
                          <?php if(file_exists('./tenant/'.$b->logo) && trim($b->logo) != '') { ?>
                          <img style="width:100px;" src="<?php echo base_url('tenant/'.$b->logo); ?>" />
                          <?php } else { ?>
                            <img src="<?php echo base_url('img/imgnotavailable.png'); ?>"  style="width:100px;" />
                          <?php } ?></td>
                          <td>
                          <?php if(file_exists('./tenant/'.$b->promo_pdf) && trim($b->promo_pdf) != '') { ?>
                          <a href="<?php echo base_url('tenant/'.$b->promo_pdf); ?>" target="_blank" class="btn btn-primary btn-flat btn-sm" >Download Promo</a>
                          <?php } else { ?>
                            N/A
                          <?php } ?></td>
                        <td>
                          <img src="<?php echo base_url('tenant/'.$b->kode); ?>.png" style="width:100px;" />
                          <a href="https://event.willowapps.net/tenant/<?php echo $b->kode; ?>" target="_blank">Tenant Link</a></td>
                        
                        <td>
                        <a href="<?php echo base_url('manageevent/removetenant/'.$b->tenant_id.'/'.$b->event_id); ?>" class="btn btn-danger btn-sm btntrash" onclick="return confirm('Yakin hapus?');"><i class="far fa-trash-alt nav-icon"></i> REMOVE</a>
                        </td>
                      </tr>
                       <?php $k++; } 
                        ?>
                      </tbody>
                    </table>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->
                  <div class="tab-pane <?php if($this->input->get('tab') == 'timeline') { echo 'active'; } ?>" id="timeline">
                    <div class="row">
                      <?php if(@$notif =='add_voucher_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>Voucher berhasil didaftarkan di event ini!</p>
                </div>
              </div>
            <?php } else if(@$notif =='remove_voucher_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>Voucher berhasil dihapus dari event ini!</p>
                </div>
              </div>
            <?php } else if(@$notif =='add_voucher_failed') { ?>
          <div class="col-12">
           <div class="alert alert-danger alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Error Registrasi!</h5>
                  <p>Gagal mendaftarkan voucher karena: <?php echo strip_tags($notif_msg); ?>!</p>
                </div>
              </div>
            <?php } else if(@$notif =='generate_voucher_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p><?php echo strip_tags($notif_msg); ?>!</p>
                </div>
              </div>
            <?php } ?>


                      <div class="col-md-12 text-right">
                        <button class="btn btn-primary btn-sm" id="btnaddvoucher" data-toggle="modal" data-target="#modal-lg-voucher"><i class="far fa-newspaper nav-icon"></i> Tambah Voucher</button>
                      </div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                      <div class="col-md-12">
                        <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Voucher</th>
                        <th>Gambar</th>
                        <th>Highlight</th>
                        <th>Qty</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php 
                        if(count($events_voucher) ==0) { ?>
                          <tr><td colspan="6" class="text-center text-muted">Belum ada voucher yang diregistrasikan pada event ini</td></tr>
                        <?php 
                        }

                        $k = 1;
                        foreach($events_voucher as $b) { ?>
                        <tr>
                        <td><?php echo $k;  ?></td>
                        <td><?php echo $b->nama; ?></td>
                         <td>
                          <?php if(file_exists('./voucher/'.$b->voucher_image) && trim($b->voucher_image) != '') { ?>
                          <img style="width:100px;" src="<?php echo base_url('voucher/'.$b->voucher_image); ?>" />
                          <?php } else { ?>
                            <img src="<?php echo base_url('img/imgnotavailable.png'); ?>"  style="width:100px;" />
                          <?php } ?></td>
                          <td>
                          <?php echo $b->highlight; ?>
                          </td>
                        <td>
                          <?php echo $b->qty; ?>
                        </td>                        
                        <td style="display:flex;">
                          <button data-toggle="modal" vouchername="<?php echo $b->nama; ?>" voucherid="<?php echo $b->voucher_id; ?>" data-target="#modal-lg-generate-voucher" class="btngenerate btn btn-primary btn-sm btntrash" style="margin-right: 10px;"><i class="fas fa-ticket-alt"></i> GENERATE VOUCHER</button>
                        <a href="<?php echo base_url('manageevent/removevoucher/'.$b->voucher_id.'/'.$b->event_id); ?>" class="btn btn-danger btn-sm btntrash" onclick="return confirm('Proses ini akan menghapus semua <?php echo $b->qty; ?> kode untuk voucher ini. Yakin hapus?');"><i class="far fa-trash-alt nav-icon"></i> REMOVE</a>
                        </td>
                      </tr>
                       <?php $k++; } 
                        ?>
                      </tbody>
                    </table>
                      </div>
                    </div>
                  </div>
                  <!-- /.tab-pane -->

                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        <?php } ?>
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
    <form action="<?php echo base_url('manageevent?eventid='.$this->input->get('eventid')); ?>" method="post" id="formtambahperiode" enctype='multipart/form-data'>
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id='title_modal'>Tambah Tenant</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="cari">Cari Tenant</label>
                <input type="text" required  name="cari" class="form-control" id="cari" placeholder="">
              </div>

              <div class="form-group">
                <label>Hasil Pencarian</label>
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nama Tenant</th>
                      <th>Logo</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>                  
                  <tbody id="resulttenant_tr">
                    <tr >
                      <td colspan="3">-</td>
                    </tr>
                  </tbody>
                  
                </table>
              </div>

             
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-lg-voucher">
  <div class="modal-dialog modal-lg">
    <form action="<?php echo base_url('manageevent?eventid='.$this->input->get('eventid')); ?>" method="post" id="formtambahperiode" enctype='multipart/form-data'>
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id='title_modal'>Tambah Voucher</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="carivoucher">Cari Voucher</label>
                <input type="text" required  name="carivoucher" class="form-control" id="carivoucher" placeholder="">
              </div>

              <div class="form-group">
                <label>Hasil Pencarian</label>
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Nama Voucher</th>
                      <th>Gambar Voucher</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>                  
                  <tbody id="resultvoucher_tr">
                    <tr >
                      <td colspan="3">-</td>
                    </tr>
                  </tbody>
                  
                </table>
              </div>

             
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal-lg-generate-voucher">
  <div class="modal-dialog modal-lg">
    <form action="<?php echo base_url('manageevent?eventid='.$this->input->get('eventid').'&tab=timeline'); ?>" method="post" id="formgeneratevoucher" enctype='multipart/form-data'>
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title" id='title_modal'>Generate Voucher</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
               <input type="hidden" name="hididvoucher" id="hididvoucher" />
              <div class="form-group">
                <label for="namavoucher">Voucher</label>
                <input type="text" required  name="namavoucher" class="form-control" readonly id="namavoucher" placeholder="">
              </div>

              <div class="form-group">
                <label for="qty">Qty</label>
                <input type="number" required  name="qty" class="form-control" id="qty" min="1" placeholder="">
                <small id="qtyhelp" class="form-text text-muted">Qty akan ditambahkan pada qty sebelumnya.</small>
              </div>
             
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" name="btngeneratesubmit" value="submit" onclick="return confirm('Apakah anda yakin?');">GENERATE VOUCHER</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>