
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Peminjaman Mobil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
          <li class="breadcrumb-item">Data Peminjaman</li>
          <li class="breadcrumb-item active">Mobil</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Form Peminjaman Mobil</h5>
              <div class="table-responsive" id="printArea">
                  <table border="1" width="100%">
                    <thead>
                      <tr>
                        <th rowspan="4" ><center><img src="https://semanggi-tiga.com/wp-content/uploads/2024/01/LOGO-SEMANGGI-TIGA.png" width="200"></center></th>
                        <th rowspan="4" width="50%"><center><h2><b>FORM PEMAKAIAN MOBIL KANTOR</b></h2></center></th>
                        <th>Nomor Dokumen : </th>
                      </tr>
                      <tr>
                        <th>Tanggal Terbit : <?php echo date('d-M-Y', strtotime($peminjaman->tanggal_pengajuan)); ?></th>
                      </tr>
                      <tr>
                        <th>Revisi        : </th>
                      </tr>
                      <tr>
                        <th>Halaman       : </th>
                      </tr>
                    </thead>
                  </table>
                  <br>
                  <table width="100%">
                    <tr>
                      <th width="300">Yang Mengajukan</th>
                      <?php $userr=$this->db->get_where('users', array('id' => $peminjaman->user))->row(); ?>
                      <th width="400">: <?php echo $userr->nama_user ?></th> 
                      <th width="300">Jam Berangkat</th>
                      <th width="400">: <?php echo $peminjaman->jam_berangkat ?></th>
                    </tr>
                    <tr>
                      <th >Jabatan</th>
                      <th>: <?php echo $peminjaman->jabatan ?></th>
                      <th>Penumpang</th>
                      <th>: <?php echo $peminjaman->penumpang ?></th>
                    </tr>
                    <tr>
                      <th>Divisi</th>
                      <th>: <?php echo $peminjaman->divisi ?></th>
                      <th>Mulai Tanggal</th>
                      <th>: <?php echo date('d-M-Y', strtotime($peminjaman->tanggal_mulai)) ?></th>
                    </tr>
                    <tr>
                      <th>Tujuan</th>
                      <th>: <?php echo $peminjaman->tujuan ?></th>
                      <th>Sampai Tanggal</th>
                      <th>: <?php echo date('d-M-Y', strtotime($peminjaman->tanggal_selesai)) ?></th>
                    </tr>
                    <tr>
                      <th>Keperluan</th>
                      <th>: <?php echo $peminjaman->kepentingan ?></th>
                      <th>Kendaraan</th>
                      <?php if($peminjaman->id_mobil !=''){?>
                      <?php $mobil=$this->db->get_where('kendaraan', array('id'=>$peminjaman->id_mobil))->row(); ?>
                      <th>: <?php echo $mobil->jenismobil ?> - (<?php echo $mobil->nomor ?>)</th>
                      <?php }else{ ?>
                      <th></th>
                      <?php } ?>
                    </tr>
                    <tr>
                   
                  </table>
              
              <br>
              
                  <p><b>Surabaya, <?php echo date('d-M-Y', strtotime($peminjaman->tanggal_pengajuan)) ?></b></p>
                  <table class="table table-bordered" width="100%">
                    <tr>
                      <th><center>Pemakai</center></th>
                      <th><center>Mengetahui</center></th>
                      <th><center>Disetujui</center></th>
                    </tr>
                    <tr>
                      <th><center>  <img src="<?php echo base_url() ?>ttd/<?php echo $peminjaman->ttd_pengajuan ?>" width="100" height="70"><br><p><?php echo $userr->nama_user ?></p></center></th>
                      <th><center>
                      
                      <?php if($peminjaman->status=='Menunggu ACC Manajer Bagian'){?> 
                      <?php }else{ ?> 
                      <img src="<?php echo base_url() ?>ttd/<?php echo $peminjaman->ttd_acc ?>" width="100" height="70"><br>
                      <?php echo $peminjaman->pengacc ?>
                      <?php } ?>
                      
                      </center></th>
                      <th><center><?php if($peminjaman->status=='Menunggu ACC Manajer Bagian' || $peminjaman->status =='Menunggu ACC Bagian Umum' || $peminjaman->status=='Menunggu ACC Pak Rustam'){?>
                      <?php }else{ ?> 
                      <img src="<?php echo base_url() ?>ttd/<?php echo $peminjaman->ttd_acc2 ?>" width="100" height="70"><br>
                      <?php echo $peminjaman->pengacc2 ?>
                      <?php } ?></center></th>
                    </tr>
                  </table>
              </div>  
            </div>
          </div>
          <div class="card">
            <div class="card-body">
            <?php echo form_open('web/inputmobil/'.$peminjaman->kode);?>
              <div class="row mb-3 mt-5">
              <?php if($peminjaman->status=='Menunggu ACC Manajer Bagian'){?>
                <?php if($user->jabatan == 'Manager' || $user->jabatan == 'Admin'){ ?>
                  <div class="col-sm-1">
                  <a href="<?php echo base_url()?>web/accpinjammobil/<?php echo $peminjaman->kode ?>" class="btn btn-primary">ACC</a>
                  </div>
                <?php } ?>
              <?php }elseif($peminjaman->status=='Menunggu ACC Bagian Umum'){?>
                <?php if($user->jabatan == 'Admin'){ ?>
                  <div class="col-sm-1">
                  <a href="<?php echo base_url()?>web/acc2pinjammobil/<?php echo $peminjaman->kode ?>" class="btn btn-primary">ACC</a>
                  </div>
                <?php } ?>
              <?php } ?>
                <?php if($user->jabatan == 'Admin' AND $peminjaman->status =='Menunggu Input Mobil'){ ?>
                
                <div class="col-sm-4">
                  <select name="jenis_kendaraan" required class="form-control">
                    <option value="">Pilih Mobil</option>
                    <?php foreach($mobil->result() as $mbl){?>
                    <option value="<?php echo $mbl->id ?>"><?php echo $mbl->jenismobil ?></option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-sm-1">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
                <?php } ?>
                <div class="col-sm-4">
                  <a href="<?php echo base_url()?>web/printpinjammobil/<?php echo $peminjaman->kode ?>" class="btn btn-success">Print Table</a>
                </div>
              </div>
              <?php echo form_close()?>
            </div>
          </div>


        </div>
      </div>
    </section>
    
    
    


  </main><!-- End #main -->
  