<?php 
$klien=$this->db->get_where('klien', array('id_klien'=>$pergantian->klien))->row();
$lokasi=$this->db->get_where('lokasi', array('id_lokasi'=>$pergantian->lokasi))->row();
$penempatan=$this->db->get_where('penempatan', array('id_penempatan'=>$pergantian->penempatan))->row();
$tad=$this->db->get_where('tad_pergantian', array('id_pergantian'=>$pergantian->id_pergantian)); 
$no=1;
foreach ($tad->result() as $key) {
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>PERGANTIAN -</title>
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
		}

	</style>
	
</head>
<body>
	<table border="1">
		<thead>
			<tr>
				<th rowspan="4" colspan="2"><img src="<?php echo base_url() ?>assets/img/semanggi.png" width="70"></th>
				<th rowspan="4" colspan="2"><center><b>PERMINTAAN KARYAWAN OUTSOURCE</b></center></th>
				<th><center>Noomor Dokumen</center></th>
				<th>.....</th>
			<tr>
				<th><center>Tanggal Terbit</center></th>
				<th><?php echo $pergantian->tgl_acc ?></th>
			</tr>
			<tr>
				<th><center>Revisi</center></th>
				<th>.....</th>
			</tr>
			<tr>
				<th><center>Halaman</center></th>
				<th><?php echo $no++; ?></th>
			</tr>
			<tr>
				<th colspan="6"><center><b>PERGANTIAN</b></center></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2"><center><b>Klien : <?php echo $klien->klien ?></b></center></td>
				<td colspan="2"><center><b>Lokasi : <?php echo $lokasi->nama ?></b></center></td>
				<td colspan="2"><center><b>Penempatan : <?php echo $penempatan->penempatan ?></b></center></td>
			</tr>
			<tr>
				<td colspan="3">Nama Keluar : <?php echo $key->nama_keluar ?></td>
				<td colspan="3">Nama Pengganti : <?php echo $key->nama_masuk ?></td>
			</tr>
			<tr>
				<td colspan="3">NIK Keluar : <?php echo $key->nik_keluar ?></td>
				<td colspan="3">NIK Pengganti : <?php echo $key->nik_masuk ?></td>
			</tr>
			<tr>
				<td colspan="3">Akhir Masuk : <?php echo $key->akhir_masuk ?></td>
				<td colspan="3">Awal Masuk : <?php echo $key->awal_masuk ?></td>
			</tr>
			<tr>
				<td colspan="3">Alasan Keluar : <?php echo $key->alasan_keluar ?></td>
				<td colspan="3">keterangan : <?php echo $key->keterangan ?></td>
			</tr>
			<tr>
				<td colspan="2">Diajukan Oleh</td>
				<td colspan="2">Disetujui Oleh</td>
				<td>Disetujui Oleh</td>
				<td>DiSetujui Oleh</td>
			</tr>
			<tr>
				<td colspan="2"><?php if ($pergantian->acc!=''): ?>
				<center><img src="<?php echo base_url() ?>qrcode/<?php echo $pergantian->acc ?>" width="70"></center>	
				<?php endif ?><br><center><?php echo $pergantian->pic ?></center></td>
				<td colspan="2"><?php if ($pergantian->acc1!=''): ?>
				<center><img src="<?php echo base_url() ?>qrcode/<?php echo $pergantian->acc1 ?>" width="70"></center>	
				<?php endif ?><br><center>Man Operasional</center></td>
				<td><?php if ($pergantian->acc2!=''): ?>
				<center><img src="<?php echo base_url() ?>qrcode/<?php echo $pergantian->acc2 ?>" width="70"></center>
				<?php endif ?><br><center>SDM</center></td>
				<td ><?php if ($pergantian->acc3!=''): ?>
				<center><img src="<?php echo base_url() ?>qrcode/<?php echo $pergantian->acc3 ?>" width="70"></center>
				<?php endif ?><br><center>Man SDM</center></td>
			</tr>
			<tr>
				<td colspan="2"><?php echo $pergantian->tgl_acc ?></td>
				<td colspan="2"><?php echo $pergantian->tgl_acc1 ?></td>
				<td><?php echo $pergantian->tgl_acc2 ?></td>
				<td><?php echo $pergantian->tgl_acc3 ?></td>
			</tr>
		</tbody>
	</table>
<script>
        window.addEventListener('load', function() {
            window.print();
        });
    </script>
</body>
</html>
<?php } ?>