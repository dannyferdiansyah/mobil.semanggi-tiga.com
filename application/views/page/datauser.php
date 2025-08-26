<main id="main" class="main">

  <div class="pagetitle">
    <h1>Semua Data User</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data User</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data User</h5>

            <?php if ($this->session->userdata('level') === 'Administrator') { ?>
              <!-- Button Tambah User -->
              <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambahUser">
                <i class="bi bi-plus-circle"></i> Tambah User
              </button>
            <?php } ?>

            <!-- Table with stripped rows -->
            <table class="table datatable">
              <thead>
                <tr>
                  <th>Nama User</th>
                  <th>NIK</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Jabatan</th>
                  <th>Divisi</th>
                  <th>TTD</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($users->result() as $value) { ?>
                  <tr>
                    <td><?php echo $value->nama_user ?></td>
                    <td><?php echo $value->nik ?></td>
                    <td><?php echo $value->email ?></td>
                    <td><?php echo $value->username ?></td>
                    <td><?php echo $value->jabatan ?></td>
                    <td><?php echo $value->divisi ?></td>
                    <td><img src="<?php echo base_url() ?>ttd/<?php echo $value->ttd ?>" class="img-thumbnail" alt="Tanda Tangan" width="150"></td>
                    <td>
                      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalEditUser<?php echo $value->id ?>">
                        <i class="bi bi-pencil-square"></i>
                      </button>
                      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalEditUser<?php echo $value->id ?>">
                        <i class="bi bi-trash"></i>
                      </button>
                    </td>
                  </tr>
                <?php } ?>
              </tbody>
            </table>
            <!-- End Table with stripped rows -->

          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- Modal Tambah User -->
  <div class="modal fade" id="modalTambahUser" tabindex="-1">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah User Baru</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <?php echo form_open_multipart('web/tambahuser'); ?>
        <div class="modal-body">
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Nama User</label>
            <div class="col-sm-9">
              <input type="text" name="nama" class="form-control" required>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">NIK User</label>
            <div class="col-sm-9">
              <input type="text" name="nik" class="form-control" required>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Email User</label>
            <div class="col-sm-9">
              <input type="email" name="email" class="form-control" required>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-9">
              <input type="text" name="username" class="form-control" required>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-9">
              <input type="password" name="password" class="form-control" required>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Jabatan</label>
            <div class="col-sm-9">
              <select name="jabatan" class="form-control" required>
                <option value="">-- Pilih Jabatan --</option>
                <option value="Staff">Staff</option>
                <option value="Supervisor">Supervisor</option>
                <option value="Manager">Manager</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">Divisi</label>
            <div class="col-sm-9">
              <select name="divisi" class="form-control" required>
                <option value="">-- Pilih Divisi --</option>
                <option value="Keuangan">Keuangan</option>
                <option value="SDM">SDM</option>
                <option value="Marketing">Marketing</option>
                <option value="Operasional">Operasional</option>
                <option value="IT">IT</option>
              </select>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-3 col-form-label">TTD User</label>
            <div class="col-sm-9">
              <input type="file" name="ttd" class="form-control">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Tambah User</button>
        </div>
        <?php echo form_close(); ?>
      </div>
    </div>
  </div>
  <!-- End Modal Tambah User -->

  <!-- Modal Edit User -->
  <?php foreach ($users->result() as $value) { ?>
    <div class="modal fade" id="modalEditUser<?php echo $value->id ?>" tabindex="-1">
      <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit User <?php echo $value->nama_user ?></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <?php echo form_open_multipart('web/edituser/' . $value->id); ?>
          <div class="modal-body">

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Username</label>
              <div class="col-sm-9">
                <!-- tampilkan username tapi readonly -->
                <input type="text" class="form-control" value="<?php echo $value->username ?>" readonly>
                <!-- hidden supaya tetap terkirim ke server -->
                <input type="hidden" name="username" value="<?php echo $value->username ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Nama User</label>
              <div class="col-sm-9">
                <input type="text" name="nama" class="form-control" value="<?php echo $value->nama_user ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">NIK User</label>
              <div class="col-sm-9">
                <input type="text" name="nik" class="form-control" value="<?php echo $value->nik ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Email User</label>
              <div class="col-sm-9">
                <input type="email" name="email" class="form-control" value="<?php echo $value->email ?>">
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Jabatan User</label>
              <div class="col-sm-9">
                <select name="jabatan" class="form-control">
                  <option value="<?php echo $value->jabatan ?>"><?php echo $value->jabatan ?></option>
                  <option value="Staff">Staff</option>
                  <option value="Supervisor">Supervisor</option>
                  <option value="Manager">Manager</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">Divisi User</label>
              <div class="col-sm-9">
                <select name="divisi" class="form-control">
                  <option value="<?php echo $value->divisi ?>"><?php echo $value->divisi ?></option>
                  <option value="Keuangan">Keuangan</option>
                  <option value="SDM">SDM</option>
                  <option value="Marketing">Marketing</option>
                  <option value="Operasional">Operasional</option>
                  <option value="IT">IT</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label class="col-sm-3 col-form-label">TTD User</label>
              <div class="col-sm-9">
                <img src="<?php echo base_url() ?>ttd/<?php echo $value->ttd ?>" alt="Tanda Tangan" class="img-thumbnail mb-2" width="100">
                <input type="file" name="ttd" class="form-control">
              </div>
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
  <?php } ?>
  <!-- End Modal Edit User -->

</main><!-- End #main -->