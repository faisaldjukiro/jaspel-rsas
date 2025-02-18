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
                                    <li class="breadcrumb-item active" aria-current="page">Rincian Pasien </li>
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
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="card-title mb-0">Rincian Pasien - <?= $dokter_pasien[0]['nama_pasien'] ?> </h6>
                            <div class="d-flex gap-2">
                                <button id="exportBtn" class="btn btn-success">
                                    <i class="bi bi-bar-chart-fill"></i> Excel
                                </button>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="tindakanpoliklinik">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Sep</th>
                                            <th>Kasus</th>
                                            <th>Rawat</th>
                                            <th>Nama Pasien</th>
                                            <th>Dokter</th>
                                            <th>Klaim</th>
                                            <th>Kode</th>
                                            <th>Dokter Spesialis</th>
                                            <th>Jasa Belum Dikurangi</th>
                                            <th>Jasa Diterima</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php
                                        $no = 1;
                                        $total_dpjp_utama = 0;
                                        $total_dpjp_utama2 = 0;
                                        $total_dpjp2_dst = 0;
                                        $total_dpjp2_dst2 = 0;
                                        $total_operator = 0;
                                        $total_operator2 = 0;
                                        $total_anestesi = 0;
                                        $total_anestesi2 = 0;
                                        $total_penunjang = 0;
                                        $total_penunjang2 = 0;
                                        foreach ($dokter_pasien as $pasien):
                                            if ($pasien['kd_dpjp'] == 'dpjp_utama') {
                                                $total_dpjp_utama += $pasien['jasa_dpjp_utama'];
                                                $total_dpjp_utama2 += $pasien['jasa_dpjp_utama2'];
                                            } elseif ($pasien['kd_dpjp'] == 'dpjp2_dst') {
                                                $total_dpjp2_dst += $pasien['jasa_dpjp2_dst'];
                                                $total_dpjp2_dst2 += $pasien['jasa_dpjp2_dst2'];
                                            } elseif ($pasien['kd_dpjp'] == 'jasa operasi') {
                                                $total_operator += $pasien['jasa_operator'];
                                                $total_operator2 += $pasien['jasa_operator2'];
                                            } elseif ($pasien['kd_dpjp'] == 'jasa anestesi') {
                                                $total_anestesi += $pasien['jasa_anestesi'];
                                                $total_anestesi2 += $pasien['jasa_anestesi2'];
                                            } elseif (in_array($pasien['kd_dpjp'], ['LAB', 'LAB PA', 'FOTO', 'USG', 'RAD KONTRAS', 'CT - SCAN', 'MRI', 'KONSUL'])) {
                                                $total_penunjang += $pasien['penunjang'];
                                                $total_penunjang2 += $pasien['penunjang2'];
                                            }
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $pasien['nosep'] ?></td>
                                            <td><?= $pasien['kasus'] ?></td>
                                            <td><?= $pasien['rawat'] ?></td>
                                            <td><?= $pasien['nama_pasien'] ?></td>
                                            <td><?= $pasien['dokter'] ?></td>
                                            <td><?= format_rupiah($pasien['jumlah']) ?></td>
                                            <td><?= $pasien['kd_dpjp'] ?></td>
                                            <td><?= format_rupiah($pasien['dokter_spesialis_final']) ?></td>
                                            <td>
                                                <?php
                                                    if ($pasien['kd_dpjp'] == 'dpjp_utama') {
                                                        echo format_rupiah($pasien['jasa_dpjp_utama2']);
                                                    } elseif ($pasien['kd_dpjp'] == 'dpjp2_dst') {
                                                        echo format_rupiah($pasien['jasa_dpjp2_dst2']);
                                                    } elseif ($pasien['kd_dpjp'] == 'jasa operasi') {
                                                        echo format_rupiah($pasien['jasa_operator2']);
                                                    } elseif ($pasien['kd_dpjp'] == 'jasa anestesi') {
                                                        echo format_rupiah($pasien['jasa_anestesi2']);
                                                    } elseif (in_array($pasien['kd_dpjp'], ['LAB', 'LAB PA', 'FOTO', 'USG', 'RAD KONTRAS', 'CT - SCAN', 'MRI', 'KONSUL'])) {
                                                        echo format_rupiah($pasien['penunjang2']);
                                                    } else {
                                                        echo 'Tidak ada jasa yang cocok';
                                                    }
                                                    ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if ($pasien['kd_dpjp'] == 'dpjp_utama') {
                                                        echo format_rupiah($pasien['jasa_dpjp_utama']);
                                                    } elseif ($pasien['kd_dpjp'] == 'dpjp2_dst') {
                                                        echo format_rupiah($pasien['jasa_dpjp2_dst']);
                                                    } elseif ($pasien['kd_dpjp'] == 'jasa operasi') {
                                                        echo format_rupiah($pasien['jasa_operator']);
                                                    } elseif ($pasien['kd_dpjp'] == 'jasa anestesi') {
                                                        echo format_rupiah($pasien['jasa_anestesi']);
                                                    } elseif (in_array($pasien['kd_dpjp'], ['LAB', 'LAB PA', 'FOTO', 'USG', 'RAD KONTRAS', 'CT - SCAN', 'MRI', 'KONSUL'])) {
                                                        echo format_rupiah($pasien['penunjang']);
                                                    } else {
                                                        echo 'Tidak ada jasa yang cocok';
                                                    }
                                                    ?>
                                            </td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="9" class="text-center"><strong>TOTAL</strong></td>
                                            <td><b><?= format_rupiah($total_dpjp_utama2 + $total_dpjp2_dst2 + $total_operator2 + $total_anestesi2 + $total_penunjang2) ?></b>
                                            <td><b><?= format_rupiah($total_dpjp_utama + $total_dpjp2_dst + $total_operator + $total_anestesi + $total_penunjang) ?></b>
                                            </td>
                                        </tr>
                                    </tfoot>


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