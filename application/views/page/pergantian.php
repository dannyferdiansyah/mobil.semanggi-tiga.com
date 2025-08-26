<?php error_reporting(0); ?>
<div class="main-panel">
	<div class="content">
		<div class="page-inner">
			<div class="page-header">
				<ul class="breadcrumbs">
					<li class="nav-home">
						<a href="#">
							<i class="flaticon-home"></i>
						</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">FORM PERGANTIAN</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">Pergantian</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<?php echo form_open_multipart('web/importpergantian'); ?>
							<div class="row">
								<div class="col-md-2">
									<select name="klien" class="form-control" required>
				        		<option value="">Pilih Klien</option>
				        		<?php foreach ($klien->result_array() as $value): ?>
				        		<option value="<?php echo $value['id_klien'] ?>"><?php echo $value['klien'] ?></option>
										<?php endforeach ?>
				        	</select>
								</div>
								<div class="col-md-3">
									<select name="lokasi" class="form-control" required>
				        		<option value="">Pilih Lokasi</option>
				        	</select>
								</div>
								<div class="col-md-3">
									<select name="penempatan" class="form-control" >
				        		<option value="">Pilih Penempatan</option>
				        	</select>
								</div>
								<div class="col-md-2">
									<input type="file" name="excel" class="form-control" accept=".csv">
									<span>*Format File Harus CSV</span>
								</div>
								<div class="col-md-2">
									<button class="btn btn-primary">Import</button>
								</div>
								
								<div class="col-md-3">
									<a href="<?php echo base_url() ?>web/downloadcontoh" class="btn btn-warning">Download Contoh</a>
								</div>
							</div>

							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
      	<div class="col-md-12">
      		<div class="card">
	      		<div class="card-body">
	      			<?php echo form_open('web/inputpergantian'); ?>

	      			<div class="row">
		      			<div class="col-md-4">
					        <div class="form-group">
					        	<label>Klien</label>
					        	<select name="klien" class="form-control" required>
					        		<option value="">Pilih Klien</option>
					        		<?php foreach ($klien->result_array() as $value): ?>
					        		<option value="<?php echo $value['id_klien'] ?>"><?php echo $value['klien'] ?></option>
											<?php endforeach ?>
					        	</select>
					        </div>
				        </div>
				      	
				      	<div class="col-md-4">
					        <div class="form-group">
					        	<label>Lokasi</label>
					        	<select name="lokasi" class="form-control">
					        		<option value="">Pilih Lokasi</option>
					        		
					        	</select>
					        </div>
						    </div>
				      	
				      	<div class="col-md-4">
					        <div class="form-group">
					        	<label>Penempatan</label>
					        	<select name="penempatan" class="form-control">
					        		<option value="">Pilih Penempatan</option>
					        		
					        	</select>
					        </div>
						    </div>
						  </div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
      	<div class="col-md-6">
      		<div class="card">
	      		<div class="card-body">
	      			<div class="row">		  
						    <div class="col-md-12">
					        <div class="form-group">
					        	<label>Nama Keluar</label>
					        	<input type="text" name="nama_keluar" class="form-control">
					        </div>
						    </div>

						    <div class="col-md-12">
					        <div class="form-group">
					        	<label>NIK Keluar</label>
					        	<input type="text" name="nik_keluar" class="form-control">
					        </div>
						    </div>

						    <div class="col-md-12">
					        <div class="form-group">
					        	<label>Tanggal Akhir</label>
					        	<input type="date" name="akhir_masuk" class="form-control">
					        </div>
						    </div>

						    <div class="col-md-12">
					        <div class="form-group">
					        	<label>Alasan Keluar</label>
					        	<textarea name="alasan_keluar" class="form-control"></textarea>
					        </div>
						    </div>

						  </div>
						</div>
					</div>
				</div>
      	<div class="col-md-6">
      		<div class="card">
	      		<div class="card-body">
	      			<div class="row">

						    <div class="col-md-12">
					        <div class="form-group">
					        	<label>Nama Pengganti</label>
					        	<input type="text" name="nama_masuk" class="form-control">
					        </div>
						    </div>

						    <div class="col-md-12">
					        <div class="form-group">
					        	<label>NIK Pengganti</label>
					        	<input type="text" name="nik_masuk" class="form-control">
					        </div>
						    </div>

						    <div class="col-md-12">
					        <div class="form-group">
					        	<label>Tanggal Masuk</label>
					        	<input type="date" name="awal_masuk" class="form-control">
					        </div>
						    </div>

						    <div class="col-md-12">
					        <div class="form-group">
					        	<label>Keterangan</label>
					        	<textarea name="keterangan" class="form-control"></textarea>
					        </div>
						    </div>

						    <!-- <div class="col-md-12">
					        <div class="form-group">
					        	<label>Kontrak</label>
					        	<input type="text" name="kontrak" class="form-control" placeholder="Contoh: NP344" required>
					        </div>
						    </div> -->
						    
						    <div class="card-action">
									<button class="btn btn-success" type="submit">Submit</button>
								</div>
						    <?php echo form_close(); ?>
					    </div>
	      		</div>
	      	</div>
      	</div>
      </div>

			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">DATA FORM PERGANTIAN</h4>
						</div>
						<div class="card-body">
							<div class="table-responsive">
								<table id="add-row"  class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>No</th>
											<th>Klien</th>
											<th>Lokasi</th>
											<!-- <th>Kontrak</th> -->
											<th>Penempatan</th>
											<th>Diajukan Oleh</th>
											<th>Data Pegawai</th>
											<th>Status</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No</th>
											<th>Klien</th>
											<th>Lokasi</th>
											<!-- <th>Kontrak</th> -->
											<th>Penempatan</th>
											<th>Diajukan Oleh</th>
											<th>Data Pegawai</th>
											<th>Status</th>
											<th>Aksi</th>
										</tr>
									</tfoot>
									<tbody>
										<?php 
										$no=1;
										foreach ($pergantian->result() as $value): 
										$klienn=$this->db->get_where('klien',array('id_klien'=>$value->klien))->row_array();
										$lokasi=$this->db->get_where('lokasi',array('id_lokasi'=>$value->lokasi))->row_array();
										$penempatan=$this->db->get_where('penempatan',array('id_penempatan'=>$value->penempatan))->row_array();	?>
											
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo strtoupper($klienn['klien']) ?></td>
											<td><?php echo strtoupper($lokasi['nama']) ?></td>
											<td><?php echo strtoupper($penempatan['penempatan']) ?></td>
											<td><?php echo strtoupper($value->pic) ?></td>
											<td>
												<?php 
												$tad_pergantian=$this->db->get_where('tad_pergantian',array('id_pergantian'=>$value->id_pergantian));
												foreach ($tad_pergantian->result() as $key) {?>
												<?php echo $key->nama_keluar ?>(<?php echo $key->nik_keluar ?>)-<?php echo $key->nama_masuk ?>(<?php echo $key->nik_masuk ?>)<hr><br>
												 <?php } ?>

											</td> 
											<td><p><b><?php echo $value->status ?></b></p></td>
											<td><button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#exampleEdit<?php echo $value->id_pergantian ?>">
												 		  <i class="icon-note"></i>
													</button>
													<button type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#exampleAdd<?php echo $value->id_pergantian ?>">
												 		  <i class="icon-plus"></i>
													</button>
												<a class="btn btn-danger btn-sm" href="<?php echo base_url() ?>web/viewpergantian/<?php echo $value->kode ?>">
												 		  <i class="icon-printer"></i>
													</a></td>
										</tr>
										<?php endforeach ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<style type="text/css">
	body[data-background-color="dark"] .main-panel label{
		color: #0f0e0e !important;
	}
</style>

<?php foreach ($pergantian->result() as $value):
$klie=$this->db->get_where('klien',array('id_klien'=>$value->klien))->row();
$lokas=$this->db->get_where('lokasi',array('id_lokasi'=>$value->lokasi))->row();
$penempata=$this->db->get_where('penempatan',array('id_penempatan'=>$value->penempatan))->row(); ?>	
<div class="modal fade" id="exampleEdit<?php echo $value->id_pergantian ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="background-color: blue;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">UPDATE PERGANTIAN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('web/edit_pergantian'); ?>
      <input type="hidden" name="id" value="<?php echo $value->id_pergantian ?>">
      <div class="modal-body">
      	<div class="row">
	      	<div class="col-md-12">
	      		<div class="form-group">
	      			<label>Klien</label>
	      			<select name="klien" class="form-control">
	      				<option value="<?php echo $klien->id_klien ?>"><?php echo $klie->klien ?></option>
		      			<?php foreach ($klien->result_array() as $valu): ?>
		        		<option value="<?php echo $valu['id_klien'] ?>"><?php echo $valu['klien'] ?></option>
								<?php endforeach ?>
	      			</select>
	      		</div>
	      	</div>
	      	<div class="col-md-12">
	      		<div class="form-group">
	      			<label>Lokasi</label>
	      			<select name="lokasi" class="form-control">
	      				<option value="<?php echo $lokasi->id_lokasi ?>"><?php echo $lokas->nama ?></option>
	      			</select>
	      		</div>
	      	</div>
	      	<div class="col-md-12">
	      		<div class="form-group">
	      			<label>Penempatan</label>
	      			<select name="penempatan" class="form-control">
	      				<option value="<?php echo $penempatan->id_penempatan ?>"><?php echo $penempata->penempatan ?></option>
	      			</select>
	      		</div>
	      	</div>
	      	<hr>
	      	<?php 
	      	$tad_per=$this->db->get_where('tad_pergantian',array('id_pergantian'=>$value->id_pergantian));
					foreach ($tad_per->result() as $tad) { ?>
					<input type="hidden" name="id_tad[]" value="<?php echo $tad->id_tad_pergantian ?>">
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>Nama Keluar</label>
	      			<input type="number" name="nama_keluar[]" class="form-control" value="<?php echo $tad->nama_keluar ?>">
	      		</div>
	      	</div>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>NIK Keluar</label>
	      			<input type="number" name="nik_keluar[]" class="form-control" value="<?php echo $tad->nik_keluar ?>">
	      		</div>
	      	</div>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>Akhir Masuk</label>
	      			<input type="date" name="akhir_masuk[]" value="<?php echo $tad->akhir_masuk ?>" class="form-control">
	      		</div>
	      	</div>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>Alasan Keluar</label>
	      			<textarea name="alasan_keluar[]" class="form-control"><?php echo $tad->alasan_keluar ?></textarea>
	      		</div>
	      	</div>
	      	<hr>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>Nama Pengganti</label>
	      			<input type="number" name="nama_masuk[]" class="form-control" value="<?php echo $tad->nama_masuk ?>">
	      		</div>
	      	</div>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>NIK Pengganti</label>
	      			<input type="number" name="nik_masuk[]" class="form-control" value="<?php echo $tad->nik_masuk ?>">
	      		</div>
	      	</div>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>Awal Masuk</label>
	      			<input type="date" name="awal_masuk[]" value="<?php echo $tad->awal_masuk ?>" class="form-control">
	      		</div>
	      	</div>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>Keterangan</label>
	      			<textarea name="keterangan[]" class="form-control"><?php echo $tad->keterangan ?></textarea>
	      		</div>
	      	</div>
	      	<?php } ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<?php endforeach ?>
<?php foreach ($pergantian->result() as $value):?>
<div class="modal fade" id="exampleAdd<?php echo $value->id_pergantian ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="background-color: blue;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TAMBAH TAD</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('web/add_pergantian'); ?>
      <input type="hidden" name="id" value="<?php echo $value->id_pergantian ?>">
      <div class="modal-body">
      	<div class="row">
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>Nama Keluar</label>
	      			<input type="text" name="nama_keluar" class="form-control">
	      		</div>
	      	</div>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>NIK Keluar</label>
	      			<input type="number" name="nik_keluar" class="form-control" >
	      		</div>
	      	</div>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>Akhir Masuk</label>
	      			<input type="date" name="akhir_masuk" class="form-control">
	      		</div>
	      	</div>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>Alasan Keluar</label>
	      			<textarea name="alasan_keluar" class="form-control"></textarea>
	      		</div>
	      	</div>
	      	<hr>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>Nama Pengganti</label>
	      			<input type="text" name="nama_masuk" class="form-control">
	      		</div>
	      	</div>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>NIK Pengganti</label>
	      			<input type="number" name="nik_masuk" class="form-control" >
	      		</div>
	      	</div>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>Awal Masuk</label>
	      			<input type="date" name="awal_masuk"  class="form-control">
	      		</div>
	      	</div>
	      	<div class="col-md-6">
	      		<div class="form-group">
	      			<label>Keterangan</label>
	      			<textarea name="keterangan" class="form-control"></textarea>
	      		</div>
	      	</div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" name="edit" class="btn btn-primary">Simpan</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>
<?php endforeach ?>
<script type="text/javascript">

  $('[name="thn"]').select2({
      placeholder: "- Tahun -"
  });

</script>
<script>
$(document).ready(function() {
  $("select[name='klien']").change(function() {
    var klien= $(this).val();
    var lokasi = $("select[name='lokasi']");
    
    if (klien !== "") {
      $.ajax({
        url: "<?php echo base_url('web/setlokasi');?>",
        method: "POST",
        data: { klien:klien },
        success: function(data) {
          var lokasiOptions = '<option value="">Pilih Lokasi</option><option value="Tidak Ada">Tidak Ada</option>';
          data = JSON.parse(data); // Ubah data JSON menjadi objek JavaScript

          for (var i = 0; i < data.length; i++) {
            lokasiOptions += '<option value="' + data[i].id_lokasi + '">' + data[i].nama + '</option>';
          }

          lokasi.html(lokasiOptions);
        }
      });
    } else {
      lokasi.html('<option value="">Pilih Lokasi</option>');
    }
  });
});
</script>
<script>
$(document).ready(function() {
  $("select[name='lokasi']").change(function() {
    var lokasi = $(this).val();
    var penempatan = $("select[name='penempatan']");
    
    
    if (lokasi !== "") {
      $.ajax({
        url: "<?php echo base_url('web/setpenempatan');?>",
        method: "POST",
        data: {lokasi:lokasi},
        success: function(data) {
          var penempatanOptions = '<option value="">Pilih Penenmpatan</option><option value="Tidak Ada">Tidak Ada</option>';
          
          data = JSON.parse(data); // Ubah data JSON menjadi objek JavaScript

          for (var i = 0; i < data.length; i++) {
            penempatanOptions += '<option value="' + data[i].id_penempatan + '">' + data[i].penempatan + '</option>';
          }
          
          penempatan.html(penempatanOptions);
        }
      });
    } else {
      penempatan.html('<option value="">Pilih Penemnpatan</option>');
    }
  });
});
</script>
