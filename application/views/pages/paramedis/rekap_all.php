<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('include/head'); ?>
    <link rel="stylesheet" href="https://cdn.datatables.net/fixedheader/3.2.4/css/fixedHeader.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/fixedheader/3.2.4/js/dataTables.fixedHeader.min.js"></script>

    <style>
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
                            <div class="d-flex align-items-center gap-2">
                                <form method="GET" action="<?= base_url('rekap-jasa-paramedis-filter'); ?>"
                                    class="d-flex align-items-center">
                                    <label for="grup" class="me-2 fw-bold">Grup:</label>
                                    <select name="grup" id="grup" class="form-select me-2">
                                        <option value="all"
                                            <?= ($this->uri->segment(2) == 'all' || !$this->uri->segment(2)) ? 'selected' : ''; ?>>
                                            Semua</option>
                                        <?php 
                                            $selectedGrup = urldecode($this->uri->segment(2));
                                            foreach ($grup as $g) : 
                                                $grupValue = urlencode($g['grup']); 
                                                $isSelected = ($selectedGrup == $grupValue) ? 'selected' : ''; 
                                            ?>
                                        <option
                                            value="<?= htmlspecialchars(urlencode($g['grup']), ENT_QUOTES, 'UTF-8'); ?>"
                                            <?= $isSelected; ?>>
                                            <?= $g['grup']; ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>

                                    <label for="ruangan" class="me-2 fw-bold">Ruangan:</label>
                                    <select name="ruangan" id="ruangan" class="form-select me-2">
                                        <option value="all"
                                            <?= ($this->uri->segment(3) == 'all' || !$this->uri->segment(3)) ? 'selected' : ''; ?>>
                                            Semua</option>
                                        <?php 
                                            $selectedRuangan = urldecode($this->uri->segment(3));
                                            foreach ($ruangan as $r) : 
                                                $ruanganValue = urlencode($r['ruangan']); 
                                                $isSelected = ($selectedRuangan == $ruanganValue) ? 'selected' : ''; 
                                            ?>
                                        <option
                                            value="<?= htmlspecialchars(urlencode($r['ruangan']), ENT_QUOTES, 'UTF-8'); ?>"
                                            <?= $isSelected; ?>>
                                            <?= $r['ruangan']; ?>
                                        </option>

                                        <?php endforeach; ?>
                                    </select>

                                    <button type="submit" class="btn btn-primary me-2" title="Filter Data">Filter
                                    </button>
                                    <button id="btnExport" class="btn btn-success me-2" title="Export Data Excel">
                                        Excel
                                    </button>

                                </form>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive " style="max-height: 900px; overflow-y: auto;">
                                <table id="kasuskosong" class="table table-striped" width="100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Group</th>
                                            <th>Kelompok Pegawai</th>
                                            <th>Nama Pegawai</th>
                                            <th>Ruangan</th>
                                            <th>Jabatan</th>
                                            <th>Pendidikan Formal</th>
                                            <th>Pendidikan Non Formal</th>
                                            <th>Gaji Pokok</th>
                                            <th>Sangsi</th>
                                            <!-- <th>Jasa Langsung</th> -->
                                            <!-- <th>Jasa Tidak Langsung</th>
                                            <th>Jasa</th> -->
                                            <th>Jasa Diterima</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($rekapJasaParamedisFillter as $paramedis): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $paramedis['grup'] ?></td>
                                            <td><?= $paramedis['kelompok_pegawai'] ?></td>
                                            <td><?= $paramedis['nama_pegawai'] ?></td>
                                            <td><?= $paramedis['ruangan'] ?></td>
                                            <td><?= $paramedis['jabatan'] ?></td>
                                            <td><?= $paramedis['pendidikan_formal'] ?></td>
                                            <td><?= $paramedis['pendidikan_non_formal'] ?></td>
                                            <td><?= format_rupiah($paramedis['gaji_pokok']) ?></td>
                                            <td><?= $paramedis['nama_pengurangan'] ?></td>
                                            <!-- <td><?= format_rupiah($paramedis['jasa_langsung']) ?></td> -->
                                            <!-- <td><?= format_rupiah($paramedis['jasa_tidak_langsung']) ?></td>
                                            <td><?= format_rupiah($paramedis['jasa_total']) ?></td> -->
                                            <td><?= format_rupiah($paramedis['sisa_jasa_pegawai']) ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="10" class="text-center"><b>TOTAL</b></td>
                                            <td><b><?= format_rupiah($total_sisa_jasa) ?></b></td>
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
    document.querySelector("form").addEventListener("submit", function(e) {
        e.preventDefault();
        var grup = encodeURIComponent(document.getElementById("grup").value);
        var ruangan = encodeURIComponent(document.getElementById("ruangan").value);

        var url = "<?= base_url('rekap-jasa-paramedis-filter'); ?>";
        if (grup !== "all" || ruangan !== "all") {
            url += "/" + grup + "/" + ruangan;
        }

        window.location.href = url;
    });
    document.getElementById("btnExport").addEventListener("click", function(e) {
        e.preventDefault();

        var grup = encodeURIComponent(document.getElementById("grup").value);
        var ruangan = encodeURIComponent(document.getElementById("ruangan").value);

        var url = "<?= base_url('ExportController/exportJasaPegawai'); ?>";
        if (grup !== "all" || ruangan !== "all") {
            url += "/" + grup + "/" + ruangan;
        }

        window.location.href = url;
    });
    </script>

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