  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Manage Voucher</h1>
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
    <form method="get" action="<?php echo current_url(); ?>" id="formpilihevent">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                
                  <div class="form-group">
                    <label>Event</label>
                    <select class="form-control" name="eventid" id="eventid">
                      <option value="-">[Pilih Event]</option>
                      <?php foreach($events as $key => $value) { ?>
                        <option <?php if($this->input->get('eventid') == $value->id) { echo 'selected'; } ?> value="<?php echo $value->id; ?>"><?php echo $value->nama; ?></option>
                      <?php } ?>
                    </select>
                  </div>
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
                  <li class="nav-item"><a class="nav-link <?php if($this->input->get('tab') == 'voucher' || empty($this->input->get('tab'))) { echo 'active'; } ?>" href="#voucher" data-toggle="tab">Voucher</a></li>
                  <li class="nav-item"><a class="nav-link <?php if($this->input->get('tab') == 'stats') { echo 'active'; } ?>" href="#stats" data-toggle="tab">Stats</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="tab-pane <?php if($this->input->get('tab') == 'voucher' || empty($this->input->get('tab'))) { echo 'active'; } ?>" id="voucher">


          <div class="col-md-12">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Tampilkan Kode Voucher</label>
                      <select name="voucher_id" id="voucher_id" class="form-control">
                        <option value="all">Semua Voucher</option>
                        <?php foreach($events_voucher as $key => $voucher) { ?>
                          <option <?php if($this->input->get('voucher_id') == $voucher->voucher_id) { echo 'selected'; } ?> value="<?php echo $voucher->voucher_id; ?>"><?php echo $voucher->nama; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="qty">Tampilkan Voucher</label>
                      <select name="voucher_claimed" id="voucher_claimed" class="form-control">
                        <option value="all">Semua Voucher</option>
                        <option value="digital_claimed" <?php if($this->input->get('voucher_claimed') == 'digital_claimed') { echo 'selected'; } ?>>Voucher Diklaim Digital</option>
                        <option value="physical_traded" <?php if($this->input->get('voucher_claimed') == 'physical_traded') { echo 'selected'; } ?>>Voucher Ditukar Fisik</option>
                      </select>
                    </div>
                  </div>
                </div>
                

                <div class="col-md-12">
                  <?php if(@$notif =='remove_voucher_success') { ?>
          <div class="col-12">
           <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <h5><i class="fa fa-check"></i> Success!</h5>
                  <p>Kode voucher berhasil dihapus!</p>
                </div>
              </div>
            <?php } ?>
                  <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Kode Voucher</th>
                        <th>Voucher</th>
                        <th>Status</th>
                        <th>Diklaim Oleh</th>
                        <th>Tanggal Klaim</th>
                        <th>Tanggal Tukar Fisik</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php  
                        foreach($voucher_pool as $key => $voucher) { ?>
                          <tr>
                            <td><?php echo $voucher->code; ?></td>
                            <td><?php echo $voucher->nama; ?></td>
                            <td><?php if($voucher->digital_claimed_by_customer_id == null) { echo '<span class="badge badge-primary">Available</span>'; } else { echo '<span class="badge badge-secondary">Claimed</span>';  } ?></td>
                            <td><?php if($voucher->digital_claimed_by_customer_id != null) { echo $voucher->nama_customer; } else { echo '-'; } ?></td>
                            <td><?php if($voucher->digital_claimed_date != null) { echo strftime('%d %b %Y', strtotime($voucher->digital_claimed_date));  } else { echo '-'; } ?></td>
                            <td><?php if($voucher->physical_claimed_date != null) { echo strftime('%d %b %Y', strtotime($voucher->physical_claimed_date));  } else { echo '-'; } ?></td>
                            <td><a href="<?php echo base_url('managevoucher/removevoucher/'.$voucher->code.'/'.$voucher->event_id); ?>" class="btn btn-danger btn-sm btntrash" onclick="return confirm('Yakin hapus?');"><i class="far fa-trash-alt nav-icon"></i> REMOVE</a></td>
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>

                  </div>
                  <div class="tab-pane <?php if($this->input->get('tab') == 'stats') { echo 'active'; } ?>" id="stats">
                    <div class="col-md-12">
                      <?php
                          $datediff = strtotime($event[0]->tanggal_selesai) - strtotime($event[0]->tanggal_mulai);
                        ?>
                      <table class="table">
                        <tbody>
                          <tr>
                            <th style="width:30%;"></th>
                            <?php  for($i=0; $i<= round($datediff / (60 * 60 * 24)); $i++) { ?> 
                            <th class="text-center"><?php echo strftime("%d %b %Y", strtotime("+".$i." day", strtotime($event[0]->tanggal_mulai))); ?></th>
                          <?php } ?>
                          </tr>
                          <?php foreach($events_voucher as $key => $value){ ?>
                            <tr>
                              <td><?php echo $value->nama; ?></td>
                                <?php  for($i=0; $i<= round($datediff / (60 * 60 * 24)); $i++) { ?> 
                            <th class="text-center"><?php echo $claimed[$value->voucher_id][$i].'/'.$value->kuota_harian; ?></th>
                          <?php } ?>
                            </tr>
                          <?php }?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

        <?php } ?>
        </div>
       
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
  </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
</div>

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