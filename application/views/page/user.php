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
						<a href="#">DATA USER</a>
					</li>
					<li class="separator">
						<i class="flaticon-right-arrow"></i>
					</li>
					<li class="nav-item">
						<a href="#">USER</a>
					</li>
				</ul>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<h4 class="card-title">DATA MASTER USER</h4>
						</div>
						<div class="card-body">
							<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal">
							  <i class="flaticon-add"></i>Tambah User
							</button>							
							<br><br>
							<div class="table-responsive">
								<table id="add-row" class="display table table-striped table-hover" >
									<thead>
										<tr>
											<th>No</th>
											<th>Nama User</th>
											<th>email</th>
											<th>Username</th>
											<th>Aksi</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
											<th>No</th>
											<th>Nama User</th>
											<th>email</th>
											<th>Username</th>
											<th>Aksi</th>
										</tr>
									</tfoot>
									<tbody>
										<?php 
										$no =1;
										foreach ($users->result_array() as $value):
										?>
										<tr>
											<td><?php echo $no++; ?></td>
											<td><?php echo $value['nama_user'] ?></td>
											<td><?php echo $value['email'] ?></td>
											<td><?php echo $value['username'] ?></td>
											<td>												
													<div class="form-button-action">
														<a href="<?php echo base_url() ?>web/delete_user/<?php echo $value['id'] ?>" class="btn btn-link btn-danger" data-original-title="Remove">
															<i class="fa fa-times"></i>
														</a>
													</div>
											</td>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="background-color: blue;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">TAMBAH USER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php echo form_open('web/create_user'); ?>
      <div class="modal-body">
      	<div class="row">
	      	<div class="col-md-12">
		        <div class="form-group">
		        	<label>Nama User</label>
		        	<input type="text" name="nama" class="form-control" placeholder="Erza Suhendra" required>
		        </div>
	        </div>
	      	
	      	<div class="col-md-6">
		        <div class="form-group">
		        	<label>Username</label>
		        	<input type="text" name="username" class="form-control" name="erza">
		        </div>
			    </div>
	      	<div class="col-md-6">
		        <div class="form-group">
		        	<label>Password</label>
		        	<input type="password" name="password" class="form-control" placeholder="admin123">
		        </div>
			    </div>
			    <div class="col-md-6">
		        <div class="form-group">
		        	<label>Email</label>
		        	<textarea name="email" type="email" class="form-control" placeholder="erza@semanggi-tiga.com"></textarea>
		        </div>
			    </div>
			    <div class="col-md-6">
		        <div class="form-group">
		        	<label>Level</label>
		        	<select name="level" class="form-control" required>
		        		<option value="">Pilih Level</option>
		        		<option value="Manajer Operasional">Manajer Operasional</option>
		        		<option value="Manajer SDM">Manajer SDM</option>
		        		<option value="SDM">Staff SDM</option>
		        		<option value="Korlap">Korlap</option>
		        	</select>
		        </div>
			    </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
      </div>
      <?php echo form_close(); ?>
    </div>
  </div>
</div>