<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('include/head'); ?>
</head>
<style>
a {
    text-decoration: none;
    color: inherit;
}
</style>

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

            <div class="page-heading ">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">


                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Rekap Jasa Semua</li>
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
                            <h5 class="card-title mb-0">Rekap Jasa Semua</h5>
                            <div class="d-flex gap-2">
                                <button class="btn btn-success">
                                    <i class="bi bi-download"></i> Export
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
                                            <th>Klaim</th>
                                            <th>Sarana</th>
                                            <th>Admin</th>
                                            <th>Dokter Umum</th>
                                            <th>Paramedis</th>
                                            <th>Dokter Spesialis</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $total_klaim = 0;
                                        $total_sarana = 0;
                                        $total_admin = 0;
                                        $total_dokter_umum = 0;
                                        $total_paramedis = 0;
                                        $total_dokter_spesialis = 1;
                                        foreach ($semua_jasa as $semua):
                                            $total_klaim += $semua['jumlah'];
                                            $total_sarana += $semua['sarana'];
                                            $total_admin += $semua['admin'];
                                            $total_dokter_umum += $semua['dokter_umum'];
                                            $total_paramedis += $semua['paramedis'];
                                            $total_dokter_spesialis += $semua['dokter_spesialis'];
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $semua['nosep'] ?></td>
                                            <td><?= $semua['kasus'] ?></td>
                                            <td><?= $semua['rawat'] ?></td>
                                            <td><?= $semua['nama'] ?></td>
                                            <td><?= format_rupiah($semua['jumlah']) ?></td>
                                            <td><?= format_rupiah($semua['sarana']) ?></td>
                                            <td><?= format_rupiah($semua['admin']) ?></td>
                                            <td><?= format_rupiah($semua['dokter_umum']) ?></td>
                                            <td><?= format_rupiah($semua['paramedis']) ?></td>
                                            <td><?= format_rupiah($semua['dokter_spesialis']) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-center"><b>TOTAL JASA</b></td>
                                            <td><b><?= format_rupiah($total_klaim) ?></b></td>
                                            <td><b><?= format_rupiah($total_sarana) ?></b></td>
                                            <td><b><?= format_rupiah($total_admin) ?></b></td>
                                            <td><b><?= format_rupiah($total_dokter_umum) ?></b></td>
                                            <td><b><?= format_rupiah($total_paramedis) ?></b></td>
                                            <td><b><?= format_rupiah($total_dokter_spesialis) ?></b></td>
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