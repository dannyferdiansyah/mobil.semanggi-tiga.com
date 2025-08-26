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
            <div class="card-body">
              <h5 class="card-title">Data Mobil</h5>
              
              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th>
                      <b>Jenis Mobil</b>
                    </th>
                    <th>Nopol Mobil</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach($datamobil->result() as $mobil){?>
                  <tr>
                    <td><?php echo $mobil->jenismobil ?></td>
                    <td><?php echo $mobil->nomor ?></td>
                    <td><?php echo $mobil->status ?></td>
                    <td>31%</td>
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
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Mobil</h5>

              <!-- General Form Elements -->
            <?php echo form_open('web/inputmobil'); ?>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Jenis Kendaraan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="jenis_kendaraan">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Nopol Kendaraan</label>
                  <div class="col-sm-10">
                    <input type="text" name="nopol_kendaraan" class="form-control">
                  </div>
                </div>
                

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label">Submit </label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
			<?php echo form_close() ?>

            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->
  