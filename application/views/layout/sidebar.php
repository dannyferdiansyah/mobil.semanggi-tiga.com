<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">
<?php if($user->jabatan =='Admin'){ ?>
  <li class="nav-item">
	<a class="nav-link " href="<?php echo base_url(); ?>">
	  <i class="bi bi-grid"></i>
	  <span>Dashboard</span>
	</a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
	<a class="nav-link"  href="<?php echo base_url() ?>web/datamobil">
	<i class="ri-car-fill"></i></i><span>Data Mobil</span>
	</a>
	
  </li><!-- End Components Nav -->

  <li class="nav-item">
	<a class="nav-link" href="<?php echo base_url()?>web/pinjammobil">
	  <i class="bi bi-journal-text"></i><span>Form Pengajuan</span>
	</a>
	
  </li><!-- End Forms Nav -->

  <li class="nav-item">
	<a class="nav-link" href="<?php echo base_url() ?>web/datapeminjaman">
	<i class="ri-file-edit-fill"></i><span>Data Peminjaman</span>
	</a>
  </li><!-- End Tables Nav -->

  <li class="nav-item">
	<a class="nav-link" href="<?php echo base_url() ?>web/datauser">
	<i class="bx bxs-user-detail"></i><span>Data User</span>
	</a>
  </li><!-- End Charts Nav -->

<?php }elseif($user->jabatan =='Manager'){?>
  <li class="nav-item">
	<a class="nav-link " href="<?php echo base_url(); ?>">
	  <i class="bi bi-grid"></i>
	  <span>Dashboard</span>
	</a>
  </li>
  <li class="nav-item">
	<a class="nav-link" href="<?php echo base_url()?>web/pinjammobil">
	  <i class="bi bi-journal-text"></i><span>Form Pengajuan</span>
	</a>
	
  </li><!-- End Forms Nav -->

  <li class="nav-item">
	<a class="nav-link" href="<?php echo base_url() ?>web/datapeminjaman">
	<i class="ri-file-edit-fill"></i><span>Data Peminjaman</span>
	</a>
  </li><!-- End Tables Nav -->
<?php }else{ ?>
  <li class="nav-item">
	<a class="nav-link " href="<?php echo base_url(); ?>">
	  <i class="bi bi-grid"></i>
	  <span>Dashboard</span>
	</a>
  </li>
  <li class="nav-item">
	<a class="nav-link" href="<?php echo base_url()?>web/pinjammobil">
	  <i class="bi bi-journal-text"></i><span>Form Pengajuan</span>
	</a>
	
  </li><!-- End Forms Nav -->
<?php } ?>
</ul>

</aside><!-- End Sidebar-->
