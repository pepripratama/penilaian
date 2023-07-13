<body class="bg-gradient-primary">
<div class="container">

<!-- Outer Row -->
<div class="row justify-content-center">

    <div class="col-lg-6">
        <div class="card o-hidden border-0 shadow-lg my-5">
            <?php if ($this->session->flashdata('gagal')) { ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Login Gagal !</strong><br><?= $this->session->flashdata('gagal') ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php } ?>
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row mx-auto">
                    <div class="col-lg">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">LOGIN PAGE</h1>
                            </div>
                            <form action="<?= base_url('auth/login') ?>" method="POST">
                                <div class="form-group">
                                    <label><i class="fa fa-user"></i> USERNAME</label>
                                    <input type="username" autocomplete="false" name="username" class="form-control form-control-user">
                                </div>
                                <div class="form-group">
                                    <label><i class="fa fa-lock"></i> PASSWORD</label>
                                    <input type="password" autocomplete="false" name="password" class="form-control form-control-user">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-block btn-primary" value="LOGIN">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

</div>
