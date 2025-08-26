<?php 
error_reporting(0);
$klien = $this->db->get_where('klien', array('id_klien' => $penambahan->klien))->row();
$lokasi = $this->db->get_where('lokasi', array('id_lokasi' => $penambahan->lokasi))->row();
$penempatan = $this->db->get_where('penempatan', array('id_penempatan' => $penambahan->penempatan))->row();
$tad = $this->db->get_where('tad_penambahan', array('id_penambahan' => $penambahan->kode)); 
$no = 1;

foreach ($tad->result() as $key) {
?>
<br>
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

            .page-break {
                page-break-after: always;
            }
        }
    </style>
    
</head>
<body>
    <div class="page-content">
        <table border="1" style="width:100%;">
            <thead>
                <tr>
                    <th rowspan="4" colspan="2"><img src="<?php echo base_url() ?>assets/img/semanggi.png" width="70"></th>
                    <th rowspan="4" colspan="2"><center><b>FORMULIR DATA TURNOVER</b></center></th>
                    <th><center>Nomor Dokumen</center></th>
                    <th>.....</th>
                <tr>
                    <th><center>Tanggal Terbit</center></th>
                    <th><?php echo $penambahan->tgl_acc ?></th>
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
                    <th colspan="6"><center><b>PENAMBAHAN</b></center></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="3"><b>Tanggal  :  <?php echo $penambahan->tgl_acc ?></b></td>
                    <td colspan="3"><b>Klien  :  <?php echo $klien->klien ?></b></td>
                </tr>
                <tr>
                    <td colspan="3"><b>Kantor  :  PT Semanggi Tiga</b></td>
                    <td colspan="3"><b>Lokasi  :  <?php echo $lokasi->nama ?></b></td>
                </tr>
                <tr>
                    <td colspan="3"><b>Diajukan Oleh  :  <?php echo $penambahan->pic ?></b></td>
                    <td colspan="3"><b>Penempatan  :  <?php echo $penempatan->penempatan ?></b></td>
                </tr>
                
                <tr>
                    <td colspan="3"><b>Jabatan  :   Korlap</b></td>
                    <td colspan="3">  :  ......................<b></b></td>
                </tr>
                <tr>
                    <th colspan="6"><center>DATA TAD</center></th>
                </tr>
                <tr>
                    <td colspan="6">Nama : <?php echo $key->nama ?></td>
                    
                </tr>
                <tr>
                    <td colspan="6">NIK: <?php echo $key->nik ?></td>
                </tr>
                <tr>
                    <td colspan="6">Akhir Masuk : <?php echo $key->awal_masuk ?></td>
                </tr>
                <tr>
                    <td colspan="6">Alasan : <?php echo $key->keterangan ?></td>
                </tr>
                <tr>
                    <td>Diajukan Oleh</td>
                    <td colspan="2">Disetujui Oleh</td>
                    <td colspan="2">Disetujui Oleh</td>
                    <td>Disetujui Oleh</td>
                </tr>
                <tr>
                    <td >
                        <?php if ($penambahan->acc != ''): ?>
                        <center><img src="<?php echo base_url() ?>qrcode/<?php echo $penambahan->acc ?>" width="70"></center>    
                        <?php endif ?><br><center><?php echo $penambahan->pic ?></center>
                    </td>
                    <td colspan="2">
                        <?php if ($penambahan->acc1 != ''): ?>
                        <center><img src="<?php echo base_url() ?>qrcode/<?php echo $penambahan->acc1 ?>" width="70"></center>    
                        <?php endif ?><br><center>Man Operasional</center>
                    </td>
                    <td colspan="2">
                        <?php if ($penambahan->acc2 != ''): ?>
                        <center><img src="<?php echo base_url() ?>qrcode/<?php echo $penambahan->acc2 ?>" width="70"></center>
                        <?php endif ?><br><center>SDM</center>
                    </td>
                    <td>
                        <?php if ($penambahan->acc3 != ''): ?>
                        <center><img src="<?php echo base_url() ?>qrcode/<?php echo $penambahan->acc3 ?>" width="70"></center>
                        <?php endif ?><br><center>Man SDM</center>
                    </td>
                </tr>
                <tr>
                    <td ><?php echo $penambahan->tgl_acc ?></td>
                    <td colspan="2"><?php echo $penambahan->tgl_acc1 ?></td>
                    <td colspan="2"><?php echo $penambahan->tgl_acc2 ?></td>
                    <td><?php echo $penambahan->tgl_acc3 ?></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="page-break"></div> <!-- This will ensure a page break after each iteration -->
<?php } ?>

<script>
    window.addEventListener('load', function() {
        window.print();
    });
</script>
</body>
</html>
