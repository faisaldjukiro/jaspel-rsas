<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('include/head'); ?>
    <style>
    th.no-fpk {
        width: 10px;
    }
    </style>
</head>

<body>
    <script src="<?= base_url('template/') ?>assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php $this->load->view('include/sidebar'); ?>
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
                            <h3></h3>

                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Kasus Kosong</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card shadow">
                        <div class="card-header">
                            <button onclick="window.history.back()" class="btn btn-secondary btn-sm">
                                <i class="bi bi-arrow-left"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="kasuskosong">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Sep</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Nama Pasien</th>
                                            <th>NoCM</th>
                                            <th>Dokter</th>
                                            <th>Layanan</th>
                                            <th>Tindakan</th>
                                            <th>Rawatan</th>
                                            <th>Kode DPJP</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($kasuskosong as $kasus): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $kasus['nosep'] ?></td>
                                            <td><?= $kasus['tgl_masuk'] ?></td>
                                            <td><?= $kasus['tgl_keluar'] ?></td>
                                            <td><?= $kasus['nama'] ?></td>
                                            <td><?= $kasus['nocm'] ?></td>
                                            <td><?= $kasus['dokter'] ?></td>
                                            <td><?= $kasus['layanan'] ?></td>
                                            <td><?= $kasus['tindakan'] ?></td>
                                            <td><?= $kasus['ruangan'] ?></td>
                                            <td><?= $kasus['kd_dpjp'] ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <?php $this->load->view('include/footer'); ?>
        </div>
    </div>
    <?php $this->load->view('include/js'); ?>

</body>

</html>