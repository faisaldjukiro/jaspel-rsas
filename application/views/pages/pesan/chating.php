<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title?></title>
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/0/0c/LOGO_KOTA_GORONTALO.png"
        type="image/x-icon">
    <link rel="stylesheet" href="<?= base_url('template/') ?>assets/compiled/css/ui-widgets-chatbox.css">
    <link rel="stylesheet" href="<?= base_url('template/') ?>assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= base_url('template/') ?>assets/compiled/css/app-dark.css">
</head>

<body>
    <script src="<?= base_url('template/') ?>assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php $this->load->view('include/sidebar')?>?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3><?= $informasi['nama_pasien']; ?></h3>

                            <p class="text-subtitle text-muted"><?= $informasi['pesan']; ?></p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('beranda')?>">Beranda</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        <?= $informasi['nama_pasien']; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card shadow">
                                <div class="card-header">
                                    <div class="media d-flex align-items-center">
                                        <div class="avatar me-3">
                                            <img src="<?= base_url('template/') ?>assets/compiled/jpg/1.jpg" alt="">
                                            <span class="avatar-status bg-success"></span>
                                        </div>
                                        <div class="name flex-grow-1">
                                            <h6 class="mb-0"><?php echo $this->session->userdata('nama_pegawai');?></h6>
                                            <span class="text-xs">Online</span>
                                        </div>
                                        <button class="btn btn-sm">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body pt-4 bg-grey">
                                    <div class="chat-content">
                                        <?php foreach ($pesan as $msg) : ?>
                                        <?php if ($msg['kd_pegawai'] == $this->session->userdata('username')) : ?>
                                        <div class="chat chat-left">
                                            <div class="chat-body">
                                                <div class="chat-message">
                                                    <?= htmlspecialchars($msg['pesan']); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php elseif ($msg['kd_pegawai'] != $this->session->userdata('username')) : ?>
                                        <div class="chat">
                                            <div class="chat-body">
                                                <div class="chat-message">
                                                    <?= htmlspecialchars($msg['pesan']); ?>
                                                </div>
                                            </div>
                                        </div>
                                        <?php else : ?>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <div class="message-form d-flex align-items-center">
                                        <form action="<?= base_url('kirimpesan'); ?>" method="POST"
                                            class="d-flex w-100">
                                            <input type="hidden" name="id_informasi"
                                                value="<?= $informasi['id_informasi']; ?>">
                                            <input type="text" class="form-control flex-grow-1 me-2" name="pesan"
                                                placeholder="Ketik Pesan Disini" required>
                                            <button type="submit" class="btn btn-primary">Kirim</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <?php $this->load->view('include/footer'); ?>
        </div>
    </div>
    <script src="<?= base_url('template/') ?>assets/static/js/components/dark.js"></script>
    <script src="<?= base_url('template/') ?>assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/compiled/js/app.js"></script>
</body>

</html>