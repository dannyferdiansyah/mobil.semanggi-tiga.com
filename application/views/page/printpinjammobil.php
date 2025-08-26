
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo $judul_web ?> -</title>
	<style type="text/css">
		/* print.css */
		@media print {
		    /* Hide elements you don't want to show in print */
		    /* Example: */
		    header, footer, nav {
		        display: none;
		    }

		    /* Hide the URL header/footer */
		    @page {
		        margin: 0;
		    }

		    body {
		        margin: 1cm;
		    }
        .print-area, .print-area * {
            visibility: visible; /* Tampilkan elemen yang ingin dicetak */
        }
        .print-area {
            position: absolute;
            top: 0;
            left: 0;
        }
        table tr td, table tr th {
        text-align: left;
        }

		}

	</style>
	
</head>
<body>
<div class="table-responsive print-area" style="margin:20px">
      <table border="1" width="100%">
        <thead>
          <tr>
            <th rowspan="4" ><center><img src="https://semanggi-tiga.com/wp-content/uploads/2024/01/LOGO-SEMANGGI-TIGA.png" width="120"></center></th>
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
          <th width="400">: <?php echo $peminjaman->nama_peminjam ?></th>
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
          <?php if($peminjaman->id_mobil!=''){?>
          <?php $mobil = $this->db->get_where('kendaraan', array('id'=> $peminjaman->id_mobil))->row(); ?>
          <th>: <?php echo $mobil->jenismobil ?> - (<?php echo $mobil->nomor ?>)</th>
          <?php }else{?>
          <th></th>
          <?php } ?>
        </tr>
        <tr>
        
      </table>
              
              <br>
              
                  <p><b>Surabaya, <?php echo date('d-M-Y', strtotime($peminjaman->tanggal_pengajuan)); ?></b></p>
                  <table border="1" width="100%" style="margin-right:20px;">
                    <tr>
                      <th><center>Pemakai</center></th>
                      <th><center>Mengetahui</center></th>
                      <th><center>Mengetahui</center></th>
                      <th><center>Disetujui</center></th>
                    </tr>
                    <tr>
                      <th><center><img src="<?php echo base_url()?>ttd/<?php echo $peminjaman->ttd_pengajuan ?>" width="100" height="70"><br>
                    <?php echo $peminjaman->nama_peminjam ?></center></th>
                      <th><center>
                      <?php if($peminjaman->status=='Menunggu ACC Manajer Bagian'){?>
                      <?php }else{ ?>  
                      <img src="<?php echo base_url() ?>ttd/<?php echo $peminjaman->ttd_acc ?>" width="100" height="70"><br>
                      <?php echo $peminjaman->pengacc ?>
                      <?php } ?>
                      
                      </center></th>
                      <th><center><?php if($peminjaman->status=='Menunggu ACC Bagian Umum' || $peminjaman->status=='Menunggu ACC Manajer Bagian'){?>
                      <?php }else{ ?>  
                      <img src="<?php echo base_url() ?>ttd/<?php echo $peminjaman->ttd_acc2 ?>" width="100" height="70"><br>
                      <?php echo $peminjaman->pengacc2 ?>
                      <?php } ?></center></th>
                      <th><center></center></th>
                    </tr>
                  </table>
              </div>  

              <script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
</body>
</html>
