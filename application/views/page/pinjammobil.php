<?php error_reporting(0);?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Peminjaman Mobil</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              <?php
              $this->db->select('status, user, kode');
              $this->db->from('peminjaman');
              $this->db->where('user', $user->id);
              $this->db->order_by('id_peminjaman', 'desc');
              $peminjaman=$this->db->get()->row();?>
              <?php if($peminjaman->status=='Menunggu Keberangkatan'){?>
              <form method="post" action="<?php echo base_url()?>web/keberangkatan/<?php echo $peminjaman->kode ?>" enctype="multipart/form-data">
              <h5 class="card-title">Form Keberangkatan Mobil</h5>
              <input type="hidden" name="kode" value="">
              <div class="row mb-3">
                <label for="in putPassword" class="col-sm-2 col-form-label">KM Mobil Berangkat</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="km_berangkat">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Foto KM Berangkat</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" accept="image/png,image/jpg,image/jpeg,image/" capture="camera" name="foto"required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Submit</label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary" >Submit</button></button>
                </div>
              </div>
              </form>
              <?php }elseif($peminjaman->status=='Menunggu Pulang'){?>
              <?php echo form_open('web/pulang/'.$peminjaman->kode, array('enctype' => 'multipart/form-data')); ?>

              <h5 class="card-title">Form Pulang Mobil</h5>
              <input type="hidden" name="kode" value="">
              <div class="row mb-3">
                <label for="in putPassword" class="col-sm-2 col-form-label">KM Mobil Pulang</label>
                <div class="col-sm-10">
                  <input type="number" class="form-control" name="km_berangkat">
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Foto KM Pulang</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" accept="image/png,image/jpg,image/jpeg,image/" name="foto2" capture="camera"  required>
                </div>
              </div>
              <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Submit</label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary" >Submit</button></button>
                </div>
              </div>
              <?php echo form_close() ?>
              <?php }else{?>
              <h5 class="card-title">Form Peminjaman Mobil</h5>
              
              <!-- General Form Elements -->
              <?php echo form_open(); ?>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Nama Peminjam</label>
                  <div class="col-sm-10">
                    <!-- <input type="text" class="form-control" readonly value="<?php echo $user->nama_user ?>"> -->
                    <input type="text" class="form-control" name="nama_peminjam" placeholder="Masukkan Nama Peminjam">
                  </div>
                </div>
                <input type="hidden" name="user" value="<?php echo $user->id ?>">
                <input type="hidden" name="ttd" value="<?php echo $user->ttd ?>"> 
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Penumpang</label>
                  <div class="col-sm-10">
                    <textarea rows="2" class="form-control" name="penumpang" placeholder="Contoh:Daris, Panca dan Angga"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputPassword" class="col-sm-2 col-form-label">Tujuan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="tujuan" placeholder="Contoh : Jakarta">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="in putPassword" class="col-sm-2 col-form-label">Kepentingan</label>
                  <div class="col-sm-10">
                    <textarea rows="5" class="form-control" name="kepentingan" placeholder="Contoh : Pelatihan Satpam"></textarea>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Mulai Tanggal</label>
                  <div class="col-sm-10">
                    <input type="date" class="form-control" name="mulai_tanggal" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Sampai Tanggal</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="date" required name="sampai_tanggal">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Jam Berangkat</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="time" name="jam" value="<?php date('H:i') ?>"> 
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Divisi</label>
                  <div class="col-sm-10">
                    <select name="divisi" required class="form-control">
                      <option value="<?php echo $user->divisi ?>"><?php echo $user->divisi ?></option>
                      <option value="Marketing">Marketing</option>
                      <option value="Keuangan">Keuangan</option>
                      <option value="Operasional">Operasional</option>
                      <option value="SDM">SDM</option>
                      <option value="IT">IT</option>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label">Jabatan</label>
                  <div class="col-sm-10">
                    <select name="jabatan" required class="form-control">
                      <option value="<?php echo $user->jabatan ?>"><?php echo $user->jabatan ?></option>
                      <option value="Manager">Manager</option>
                      <option value="Supervisor">Supervisor</option>
                      <option value="Staff">Staff</option>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <div class="col-sm-10">
                    <button type="submit" name="pinjam" class="btn btn-primary">Submit</button>
                  </div>
                </div>

              <?php echo form_close();?><!-- End General Form Elements -->
              <?php } ?>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  