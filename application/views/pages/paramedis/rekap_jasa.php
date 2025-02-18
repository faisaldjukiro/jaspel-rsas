<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('include/head'); ?>
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
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('beranda') ?>">Beranda</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Jasa Semua</h5>
                            <div class="d-flex gap-2">

                                <a href="<?php echo base_url('rekap-jasa-paramedis-filter') ?>">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="bi bi-list-columns-reverse" title="Rekap Jasa Paramedis"></i> Rekap
                                        Jasa
                                    </button>
                                </a>
                                <!-- <button id="exportBtn" class="btn btn-success">
                                    <i class="bi bi-bar-chart-fill"></i> Export
                                </button> -->
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" width="100%" id="kasuskosong">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Group</th>
                                            <th>Nama Pegawai</th>
                                            <th>Ruangan</th>
                                            <th>Jabatan</th>
                                            <th>Pendidikan Formal</th>
                                            <th>Pendidikan Non Formal</th>
                                            <th>Gaji Pokok</th>
                                            <th>Sangsi</th>
                                            <th>Jasa Langsung</th>
                                            <th>Jasa Tidak Langsung</th>
                                            <th>Jasa</th>
                                            <th>Jasa Diterima</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($rekapJasaParamedis as $paramedis): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $paramedis['grup'] ?></td>
                                            <td><?= $paramedis['nama_pegawai'] ?></td>
                                            <td><?= $paramedis['ruangan'] ?></td>
                                            <td><?= $paramedis['jabatan'] ?></td>
                                            <td><?= $paramedis['pendidikan_formal'] ?></td>
                                            <td><?= $paramedis['pendidikan_non_formal'] ?></td>
                                            <td><?= format_rupiah($paramedis['gaji_pokok']) ?></td>
                                            <td><?= $paramedis['nama_pengurangan'] ?></td>
                                            <td><?= format_rupiah($paramedis['jasa_langsung']) ?></td>
                                            <td><?= format_rupiah($paramedis['jasa_tidak_langsung']) ?></td>
                                            <td><?= format_rupiah($paramedis['jasa_total']) ?></td>
                                            <td><?= format_rupiah($paramedis['sisa_jasa_pegawai']) ?></td>
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