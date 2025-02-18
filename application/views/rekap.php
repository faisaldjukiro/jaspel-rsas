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
                            <h3></h3>

                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Rincian</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card shadow">

                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Rincian Dokter</h5>
                            <div class="d-flex gap-2">
                                <a href="<?php echo base_url('rekap-semua') ?>">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="bi bi-list-columns-reverse "></i> Rekap Semua
                                    </button>
                                </a>
                                <a href="<?php echo base_url('rekap-dokter') ?>">
                                    <button class="btn btn-primary btn-sm">
                                        <i class="bi bi-list-columns-reverse"></i> Rekap Dokter
                                    </button>
                                </a>
                                <!-- <button id="exportBtn" class="btn btn-success">
                                    <i class="bi bi-bar-chart-fill"></i> Export
                                </button> -->
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
                                            <!-- <th class="d-none">>Penunjang</th> -->
                                            <!-- <th>Sisa Jasa</th>
                                            <th>Jasa Operator</th>
                                            <th>Jasa Anestesi</th> -->
                                            <!-- <th>Porsi Dpjp</th> -->
                                            <!-- <th>Index Djpjp Utama</th> -->
                                            <!-- <th>Jasa Dpjp Utama</th> -->
                                            <!-- <th>Index Djpjp2 Dst</th> -->
                                            <!-- <th>Jasa Dpjp2 Dst</th> -->
                                            <th>Jasa Diterima</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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
        var base_url = "<?php echo base_url('rincian-dokter-pasien/'); ?>";

        if ($.fn.DataTable.isDataTable('#tindakanpoliklinik')) {
            $('#tindakanpoliklinik').DataTable().destroy();
        }
        let poliklinik_datatable = $("#tindakanpoliklinik").DataTable({
            responsive: true,
            "processing": true,
            "serverSide": true,
            "pageLength": 25,
            "lengthMenu": [5, 10, 25, 50, 100, 200, 500, 1000],
            "ajax": {
                "url": "<?php echo base_url('RekapController/getRinciandokter'); ?>",
                "type": "POST",
                "data": function(d) {
                    d.caridata = d.search.value;
                }
            },
            "columns": [{
                    "data": null,
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    "data": "nosep",
                    "render": function(data, type, row) {
                        return '<a href="' + base_url + data + '" class="badge bg-secondary">' +
                            data + '</a>';
                    }
                },
                {
                    "data": "kasus"
                },

                {
                    "data": "rawat"
                },
                {
                    "data": "nama_pasien"
                },
                {
                    "data": "dokter"
                },
                {
                    "data": "jumlah",
                    "render": function(data, type, row) {
                        return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                    }
                },
                {
                    "data": "kd_dpjp"
                },
                {
                    "data": "dokter_spesialis_final",
                    "render": function(data, type, row) {
                        return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                    }
                },
                // {
                //     "data": "penunjang",
                //     "render": function(data, type, row) {
                //         return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                //     }
                // },
                // {
                //     "data": "sisa_jasa",
                //     "render": function(data, type, row) {
                //         return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                //     }
                // },
                // {
                //     "data": "jasa_operator",
                //     "render": function(data, type, row) {
                //         return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                //     }
                // },
                // {
                //     "data": "jasa_anestesi",
                //     "render": function(data, type, row) {
                //         return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                //     }
                // },
                // {
                //     "data": "jasa_dpjp_utama",
                //     "render": function(data, type, row) {
                //         return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                //     }
                // },
                // {
                //     "data": "jasa_dpjp2_dst",
                //     "render": function(data, type, row) {
                //         return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                //     },
                // },

                {
                    "data": null,
                    "render": function(data, type, row) {
                        let jasa_dpjp = 0;

                        if (row.kd_dpjp === 'dpjp_utama') {
                            jasa_dpjp = row.jasa_dpjp_utama;
                        } else if (row.kd_dpjp === 'dpjp2_dst') {
                            jasa_dpjp = row.jasa_dpjp2_dst;
                        } else if (row.kd_dpjp === 'jasa operasi') {
                            jasa_dpjp = row.jasa_operator;
                        } else if (row.kd_dpjp === 'jasa anestesi') {
                            jasa_dpjp = row.jasa_anestesi;
                        } else if (['LAB', 'LAB PA', 'FOTO', 'USG', 'RAD KONTRAS', 'CT - SCAN',
                                'MRI', 'KONSUL'
                            ].includes(row.kd_dpjp)) {
                            jasa_dpjp = row.penunjang;
                        } else {
                            jasa_dpjp = 0;
                        }

                        return 'Rp ' + parseInt(jasa_dpjp).toLocaleString('id-ID');
                    }
                }

            ]

        });
    });
    </script>

    <script>
    $(document).ready(function() {
        var table = $('#tindakanpoliklinik').DataTable();
        $('#exportBtn').on('click', function() {
            var csvContent =
                "No,Sep,Kasus,Rawat,Nama Pasien,Dokter,Klaim,Kode,Dokter Spesialis,Penunjang,Sisa Jasa,Jasa Operator,Jasa Anestesi,Jasa Dpjp Utama,Jasa Dpjp2 Dst,Jumlah Jasa\n";
            table.rows({
                page: 'current'
            }).every(function() {
                var row = this.data();
                var rowData = [
                    row[0],
                    row[1],
                    row[2],
                    row[3],
                    row[4],
                    row[5],
                    row[6],
                    row[7],
                    row[8],
                    row[9],
                    row[10],
                    row[11],
                    row[12],
                    row[13],
                    row[14],
                    row[15]
                ];

                csvContent += rowData.join(",") + "\n";
            });
            var encodedUri = encodeURI('data:text/csv;charset=utf-8,' + csvContent);
            var link = document.createElement("a");
            link.setAttribute("href", encodedUri);
            link.setAttribute("download", "rekap_data.csv");
            link.click();
        });
    });
    </script>
    <script>
    $(document).ready(function() {
        var table = $('#tindakanpoliklinik').DataTable();

        var totalJumlahJasa = 0;
        table.rows().every(function() {
            var row = this.data();
            var jumlahJasa = row[15];

            jumlahJasa = parseFloat(jumlahJasa.replace('Rp', '').replace(',', '').trim());
            if (!isNaN(jumlahJasa)) {
                totalJumlahJasa += jumlahJasa;
            }
        });
        $('#totalJumlahJasa').text('Rp ' + totalJumlahJasa.toLocaleString());
    });
    </script>


</body>

</html>