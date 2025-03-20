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
                                    <li class="breadcrumb-item active" aria-current="page">Rincian Dokter / Pasien</li>
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
                            <h6 class="card-title mb-0">Rincian Dokter / Pasien</h6>
                            <div class="d-flex gap-2">

                                <a href="">
                                    <button class="btn btn-success btn-sm" title="Download">
                                        <i class="bi bi-box-arrow-down"></i>
                                    </button>
                                </a>
                                <a href="asdasd" target="_blank">
                                    <button class="btn btn-secondary btn-sm" title="Tutorial Perhitungan">
                                        <i class="bi bi-calculator-fill"></i>
                                    </button>
                                </a>
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
                                            <th>Jasa Diterima</th>
                                        </tr>
                                    </thead>
                                    <tbody>


                                        <?php
                                        $no = 1;
                                        $total_dpjp_utama2 = 0;
                                        $total_dpjp2_dst2 = 0;
                                        $total_operator2 = 0;
                                        $total_anestesi2 = 0;
                                        $total_penunjang2 = 0;
                                        foreach ($dokter_pasien as $pasien):
                                            if ($pasien['kd_dpjp'] == 'dpjp_utama') {                                                
                                                $total_dpjp_utama2 += $pasien['jasa_dpjp_utama2'];
                                            } elseif ($pasien['kd_dpjp'] == 'dpjp2_dst') {
                                                $total_dpjp2_dst2 += $pasien['jasa_dpjp2_dst2'];
                                            } elseif ($pasien['kd_dpjp'] == 'jasa operasi') {
                                                $total_operator2 += $pasien['jasa_operator2'];
                                            } elseif ($pasien['kd_dpjp'] == 'jasa anestesi') {
                                                $total_anestesi2 += $pasien['jasa_anestesi2'];
                                            } elseif (in_array($pasien['kd_dpjp'], ['LAB', 'LAB PA', 'FOTO', 'USG', 'RAD KONTRAS', 'CT - SCAN', 'MRI', 'KONSUL', 'GIZI', 'CT - SCAN RJ', 'MRI RJ', 'USG RJ'])) {
                                               
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
                                            <td><?= format_rupiah($pasien['jumlah_sebelum_dikurangi']) ?></td>
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
                                                    } elseif (in_array($pasien['kd_dpjp'], ['LAB', 'LAB PA', 'FOTO', 'USG', 'RAD KONTRAS', 'CT - SCAN', 'MRI', 'KONSUL', 'GIZI', 'CT - SCAN RJ', 'MRI RJ', 'USG RJ'])) {
                                                        echo format_rupiah($pasien['penunjang2']);
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
                                            <td colspan="9" class="text-center"><b>TOTAL</b></td>
                                            <td><b><?= format_rupiah($total_dpjp_utama2 + $total_dpjp2_dst2 + $total_operator2 + $total_anestesi2 + $total_penunjang2) ?></b>
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