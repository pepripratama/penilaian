<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <?php // $this->load->view("templates/sidebar.php"); ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <nav class="navbar navbar-expand-lg navbar-light bg-light mb-3">
                  <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php $role_id = $this->session->userdata('role_id') ?>
                          <li class="nav-item <?= ($title == 'Dashboard') ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= base_url('Dashboard') ?>"><i class="fas fa-chart-line"></i> Dashboard</a>
                          </li>
                        <?php if ($role_id == 1) { ?>
                          <li class="nav-item <?= ($title == 'Input Penilaian') ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= base_url('Input_nilai') ?>"><i class="fas fa-edit"></i> Input Penilaian</a>
                          </li>
                        <?php } ?>
                        <?php if ($role_id == 4) { ?>
                          <li class="nav-item <?= ($title == 'Penilaian') ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= base_url('Penilaian') ?>"><i class="fas fa-money-bill"></i> Pembayaran</a>
                          </li>
                        <?php } ?>
                        <?php if ($role_id == 2 or $role_id == 2) { ?>
                          <li class="nav-item <?= ($title == 'Approval') ? 'active' : '' ?>">
                            <a class="nav-link" href="<?= base_url('Approval') ?>"><i class="fas fa-check"></i> Approval</a>
                          </li>
                        <?php } ?>
                        <?php if ($role_id == 4) { ?>
                          <li class="nav-item dropdown <?= ($title == 'Data Master') ? 'active' : '' ?>">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                              <i class="fas fa-database"></i> Data Master
                            </a>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="<?= base_url('Karyawan') ?>">Karyawan</a>
                              <a class="dropdown-item" href="<?= base_url('Nilai') ?>">Nilai</a>
                            </div>
                          </li>
                        <?php } ?>
                          <li class="nav-item dropdown <?= ($title == 'Laporan') ? 'active' : '' ?>">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                              <i class="fas fa-book"></i> Laporan
                            </a>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="<?= base_url('Laporan') ?>">History Pembayaran</a>
                          </li>
                        </ul>
                        <ul class="navbar-nav ml-auto">
                        
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= $this->session->userdata('name') ?></span>
                                <!-- <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg"> -->
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#passwordModal">
                                    <i class="fas fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Ubah Password
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                  </div>
                </nav>

                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container">
                    <?php if($this->session->flashdata('success')){ ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <strong>Berhasil ! </strong><?= $this->session->flashdata('success'); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <?php } ?>
                    <?php if($this->session->flashdata('alert')){ ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      <strong>Gagal ! </strong><?= $this->session->flashdata('alert'); ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <?php } ?>
                    <?php if (empty($view)) {
                        echo"<img class='d-block w-100' src='assets/img/hicoop.jpg'></img>";
                    }else{
                        $this->load->view($view);
                    }
                     ?>
                    
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Apakah anda yakin?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih "Logout" untuk keluar </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Password Modal-->
    <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Silahkan masukkan password baru anda.</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary" href="<?= base_url('auth/logout') ?>">Simpan</a>
                </div>
            </div>
        </div>
    </div>
