<?php 
error_reporting(0);
?>
<main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Elements</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item active">Elements</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
	<section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body ">
              <h5 class="card-title">Data Mobil</h5>
              <div class="table-responsive">
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Tanggal Mulai</th>
                    <th>Tanggal Selesai</th>
                    <th>Jam Berangkat</th>
                    <th>Tujuan</th>
                    <th>Keperluan</th>
                    <th>Mobil</th>
                    <th>KM Berangkat</th>
                    <th>KM Pulang</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($peminjaman->result() as $mobil){
                  $km = $this->db->get_where('users', array('id'=>$mobil->user))->row();
                  $kendaraan = $this->db->get_where('kendaraan', array('id'=>$mobil->id_mobil))->row();?>
                  <tr>
                    <td><?php echo $mobil->nama_peminjam ?></td>
                    <td><?php echo date('d-M-Y H:i', strtotime($mobil->tanggal_pengajuan)) ?></td>
                    <td><?php echo date('d-M-Y', strtotime($mobil->tanggal_mulai)) ?></td>
                    <td><?php echo date('d-M-Y', strtotime($mobil->tanggal_selesai)) ?></td>
                    <td><?php echo $mobil->jam_berangkat ?></td>
                    <td><?php echo $mobil->tujuan ?></td>
                    <td><?php echo $mobil->kepentingan ?></td>
                    <td><?php echo $kendaraan->jenismobil?>-<?php echo $kendaraan->nomor ?></td>
                    <td><a href="<?php echo base_url()?>img/<?php echo $mobil->foto_berangkat ?>" target="_blank"><img src="<?php echo base_url()?>img/<?php echo $mobil->foto_berangkat ?>" width="70" height="80"></a><br><?php echo number_format($mobil->km_berangkat)  ?> KM</td>
                    <td><a href="<?php echo base_url() ?>img/<?php echo $mobil->foto_pulang ?>" target="_blank"><img src="<?php echo base_url()?>img/<?php echo $mobil->foto_pulang ?>" width="70" height="80"></a><br><?php echo number_format($mobil->km_pulang) ?> KM</td>
                    <td><?php echo $mobil->status ?></td>
                    <td><a href="<?php echo base_url() ?>web/datapinjammobil/<?php echo $mobil->kode ?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a></td>
                  </tr>
				  <?php } ?>
                </tbody>
              </table>
              </div>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
    

  </main><!-- End #main -->
  