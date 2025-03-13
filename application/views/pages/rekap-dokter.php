<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('include/head'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>

</head>
<style>
a {
    text-decoration: none;
    color: inherit;
}

#kasuskosong {
    font-size: 18px;
}

#kasuskosong thead th {
    background: linear-gradient(45deg, #1E3C72, #2A5298);

    color: white;
    font-weight: bold;
    text-transform: uppercase;
    padding: 12px;
    text-align: center;
    border-left: 1px solid rgba(255, 255, 255, 0.2);
}

#kasuskosong tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

#kasuskosong tbody td {
    padding: 12px;
    vertical-align: middle;
    text-align: center;
}

#kasuskosong tfoot td {
    background: linear-gradient(45deg, #D31027, #EA384D);

    color: white;
    font-weight: bold;
    font-size: 20px;
    padding: 12px;
}

#kasuskosong,
#kasuskosong th,
#kasuskosong td {
    border: 1px solid #dee2e6;
}

#kasuskosong tbody tr:hover {
    background-color: #d1ecf1;
}

#kasuskosong thead {
    position: sticky;
    top: 0;
    background: linear-gradient(45deg, #D31027, #EA384D);

    z-index: 100;
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
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('beranda')?>">Beranda</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= $title ?></li>
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
                            <h6 class="card-title mb-0"><?= $title ?> </h6>
                            <!-- <div class="d-flex gap-2">
                                <button id="exportBtn" class="btn btn-success">
                                    <i class="bi bi-bar-chart-fill"></i> Export
                                </button>
                            </div> -->
                        </div>

                        <div class="card-body">
                            <div class="table-responsive" style="max-height: 900px; overflow-y: auto;">
                                <table id="kasuskosong" class="table table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Dokter</th>
                                            <th>Total Jasa</th>
                                            <!-- <th>Jasa Setelah Dikurangi</th> -->
                                            <th>10% Jasa Kebersamaan</th>
                                            <th>90% Jasa Langsung</th>
                                            <th>Jumlah Dokter</th>
                                            <th>Jasa Kebersamaan</th>
                                            <th>Jasa Diterima</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        // $total_jasa_all = 1;
                                        $total_jasa_all2 = 0;
                                        $total_20_persen = 0;
                                        $total_80_persen = 0;
                                        $total_jasa_bersama = 0;
                                        $total_jasa_diterima = 0;
                                        foreach ($rekap_dokter as $dokter):
                                            $total_jasa_all2 += $dokter['jasa_belum_dikurangi'];
                                            // $total_jasa_all += $dokter['total_jasa'];
                                            $total_20_persen += $dokter['jasa_20_persen'];
                                            $total_80_persen += $dokter['jasa_80_persen'];
                                            $total_jasa_diterima += $dokter['jasa_diterima'];
                                            $total_jasa_bersama += $dokter['rata_jasa_20_persen'];
                                        ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td>
                                                <a href="<?= base_url('rincian-dokter-detail/' . $dokter['dokter']) ?>">
                                                    <?= htmlspecialchars($dokter['dokter']) ?>
                                                </a>
                                            </td>
                                            <td><?= format_rupiah($dokter['jasa_belum_dikurangi']) ?></td>
                                            <!-- <td><?= format_rupiah($dokter['total_jasa']) ?></td> -->
                                            <td><?= format_rupiah($dokter['jasa_20_persen']) ?></td>
                                            <td><?= format_rupiah($dokter['jasa_80_persen']) ?></td>
                                            <td><?= $dokter['jumlah_dokter'] ?></td>
                                            <td><?= format_rupiah($dokter['rata_jasa_20_persen']) ?></td>
                                            <td><?= format_rupiah($dokter['jasa_diterima']) ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2" class="text-center"><b>TOTAL</b></td>
                                            <td class="text-center"><b><?= format_rupiah($total_jasa_all2) ?></b></td>
                                            <!-- <td class="text-center"><b><?= format_rupiah($total_jasa_all) ?></b></td> -->
                                            <td class="text-center"><b><?= format_rupiah($total_20_persen) ?></b></td>
                                            <td class="text-center"><b><?= format_rupiah($total_80_persen) ?></b></td>
                                            <td></td>
                                            <td class="text-center"><b><?= format_rupiah($total_jasa_bersama) ?></b>
                                            </td>
                                            <td class="text-center"><b><?= format_rupiah($total_jasa_diterima) ?></b>
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

    <script>
    $(document).ready(function() {
        if ($.fn.DataTable.isDataTable('#kasuskosong')) {
            $('#kasuskosong').DataTable().destroy();
        }

        $('#kasuskosong').DataTable({
            responsive: true,
            paging: true,
            searching: true,
            ordering: true,
            info: false,
            fixedHeader: true,
            pageLength: 100,
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            language: {
                paginate: {
                    previous: "<",
                    next: ">"
                }
            }
        });
    });
    </script>
</body>

</html>