<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('include/head'); ?>
    <style>
    a {
        text-decoration: none;
        color: inherit;
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


                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="<?= base_url('beranda') ?>">Beranda</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Jasa Dokter</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card shadow">
                        <div class="card-header">

                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" width="100%" id="dokter">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dokter</th>
                                            <th>Jasa</th>
                                            <th>Potongan</th>
                                            <th>Total Jasa</th>
                                            <th>Jenis</th>
                                            <th>Periode</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($jasa_dokter as $dokter): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td>
                                                <a
                                                    href="<?= base_url('rincian-dokter/' . $this->session->userdata('username').'/'.$dokter['jenis_jasa'].'/'.$dokter['bulan']) ?>">
                                                    <?= ($dokter['nama_pegawai']) ?>
                                                </a>
                                            </td>
                                            <td><?= format_rupiah($dokter['total_jasa']) ?></td>
                                            <td><?= format_rupiah($dokter['potongan']) ?></td>
                                            <td><?= format_rupiah($dokter['total_jasa'] - $dokter['potongan']) ?>
                                            <td><?= $dokter['jenis_jasa'] ?></td>
                                            <td><?= $dokter['bulan'] ?></td>
                                            </td>
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
    <script>
    $(document).ready(function() {
        let table = $("#dokter").DataTable();
        let urlParams = new URLSearchParams(window.location.search);
        let searchQuery = urlParams.get("search");

        if (searchQuery) {
            table.search(searchQuery).draw();
        }
    });
    </script>
</body>

</html>