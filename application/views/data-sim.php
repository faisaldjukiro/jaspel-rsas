<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('include/head'); ?>
    <link rel="stylesheet" href="<?= base_url('template/') ?>assets/extensions/toastify-js/src/toastify.css">

    <style>
    th.no-fpk {
        width: 10px;
    }

    #notifications {
        margin-top: 20px;
    }

    .notif {
        padding: 10px;
        margin-bottom: 5px;
        border-radius: 5px;
    }

    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }
    </style>
</head>

<body>
    <script src="<?= base_url('template/') ?>assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php $this->load->view('include/sidebar'); ?>
        <div id="main">
            <div class="card-body">

                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Pembersihan Data
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div id="notifications"></div>
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <button id="executeUpdate" type="button" title="Proses Data"
                                            class="btn btn-success w-100 mb-2">
                                            Proses Data</button>

                                        <a href="<?= base_url('layanan-kosong') ?>"><button type="button"
                                                title="Cek Kasus Kosong" class="btn btn-warning w-100 mb-2">
                                                Layanan Kosong</button></a>
                                        <a href="<?= base_url('data-kosong') ?>"><button type="button"
                                                title="Cek Tindakan Kosong" class="btn btn-warning w-100 mb-2">
                                                Tindakan Kosong</button></a>
                                    </div>
                                    <div class="col-md-2">

                                        <a href="<?= base_url('tindakan-ird') ?>"><button type="button"
                                                title="Cek Tindakan IRD Tidak Lengkap"
                                                class="btn btn-warning w-100 mb-2">
                                                Tindakan IRD</button></a>
                                        <a href="<?= base_url('tindakan-poli') ?>"><button type="button"
                                                title="Cek Tindakan Poliklinik Tidak Lengkap"
                                                class="btn btn-warning w-100 mb-2">
                                                Tindakan Poliklinik</button></a>
                                        <a href="<?= base_url('kasus-kosong') ?>"><button type="button"
                                                title="Cek Kasus Kosong" class="btn btn-warning w-100 mb-2">
                                                Kasus Kosong</button></a>

                                        <!-- <button type="button" title="Cek Tindakan Poliklinik Tidak Lengkap"
                                            data-bs-toggle="modal" data-bs-target="#full-poli"
                                            class="btn btn-warning w-100 mb-2">
                                            Tindakan Poliklinik</button> -->
                                    </div>
                                    <div class="col-md-2">

                                        <a href="<?= base_url('dpjp-kosong') ?>"><button type="button"
                                                title="Cek Dpjp Kosong" class="btn btn-warning w-100 mb-2">
                                                Dpjp Kosong</button></a>
                                        <button id="clearproses" type="button" title="Hapus Semua Yang Telah Diproses"
                                            class="btn btn-danger w-100 mb-2">
                                            Hapus Proses</button>
                                    </div>
                                    <div class="col-md-2">
                                        <a href="<?= base_url('dpjp-kosong') ?>">
                                            <button type="button" title="Cek Dpjp Kosong"
                                                class="btn btn-success w-100 mb-2">
                                                Import Klaim
                                            </button>
                                        </a>
                                        <a href="<?= base_url('dpjp-kosong') ?>">
                                            <button type="button" title="Cek Dpjp Kosong"
                                                class="btn btn-success w-100 mb-2">
                                                Import Data Sim
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php $this->load->view('modal/data_kosong'); ?>
                            <?php $this->load->view('modal/kasus_kosong'); ?>
                            <?php $this->load->view('modal/poliklinik'); ?>
                            <?php $this->load->view('modal/ird'); ?>
                        </div>
                    </div>
                </div>

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
                                        <li class="breadcrumb-item active" aria-current="page">Data Awal</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <section class="section">
                        <div class="card shadow">
                            <div class="card-header">
                                <h5 class="card-title">
                                    Data Awal
                                </h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table" id="table1">
                                        <thead>
                                            <tr>
                                                <th class=" no-fpk">No FPK</th>
                                                <th>Sep</th>
                                                <th>Nama Pasien</th>
                                                <th>Dokter</th>
                                                <th>Klaim</th>
                                                <th>Tindakan</th>
                                                <th>Tarif Rs</th>
                                                <th>Kasus</th>
                                                <th>Jenis Rawat</th>
                                                <th>Kode Dpjp</th>
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
        <script src="<?= base_url('template/') ?>assets/extensions/toastify-js/src/toastify.js"></script>
        <script src="<?= base_url('template/') ?>assets/static/js/pages/toastify.js"></script>
        <script>
        $(document).ready(function() {
            if ($.fn.DataTable.isDataTable('#table1')) {
                $('#table1').DataTable().destroy();
            }
            let jquery_datatable = $("#table1").DataTable({
                responsive: true,
                "processing": true,
                "serverSide": true,
                "pageLength": 25,
                "ajax": {
                    "url": "<?php echo base_url('JasaController/getDatasim'); ?>",
                    "type": "POST",
                    "data": function(d) {
                        d.caridata = d.search.value;
                    }
                },
                "columns": [{
                        "data": "no_fpk"
                    },
                    {
                        "data": "nosep"
                    },
                    {
                        "data": "nama"
                    },

                    {
                        "data": "dokter"
                    },
                    {
                        "data": "klaim",
                        "render": function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        "data": "tindakan"
                    },
                    {
                        "data": "tarif_rs",
                        "render": function(data, type, row) {
                            return 'Rp ' + parseInt(data).toLocaleString('id-ID');
                        }
                    },
                    {
                        "data": "kasus"
                    },
                    {
                        "data": "jenis_rawat"
                    },

                    {
                        "data": "kode"
                    }
                ]
            });
        });
        </script>

        <script>
        $(document).ready(function() {
            $("#executeUpdate").click(function() {
                $("#executeUpdate").prop("disabled", true);
                $("#notifications").html("");

                $.ajax({
                    url: "<?= base_url('UpdateallController/eksekusiUpdate') ?>",
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        if (response.status === "success") {
                            let delay = 0;
                            let totalToastCount = response.steps.length;
                            let toastDisplayed = 0;

                            response.steps.forEach(step => {
                                setTimeout(function() {
                                    Toastify({
                                        text: step.message,
                                        duration: 5000,
                                        close: true,
                                        gravity: "top",
                                        position: "right",
                                        backgroundColor: "#4fbe87",
                                    }).showToast();


                                    toastDisplayed++;
                                    if (toastDisplayed ===
                                        totalToastCount) {
                                        $("#executeUpdate").prop("disabled",
                                            false);
                                    }
                                }, delay);
                                delay +=
                                    3500;
                            });
                        } else {
                            Toastify({
                                text: response.message,
                                duration: 5000,
                                close: true,
                                gravity: "top",
                                position: "right",
                                backgroundColor: "#f44336",
                            }).showToast();
                            setTimeout(function() {
                                $("#executeUpdate").prop("disabled", false);
                            }, 3500);
                        }
                    },
                    error: function() {
                        Toastify({
                            text: "Terjadi kesalahan saat memperbarui data.",
                            duration: 5000,
                            close: true,
                            gravity: "top",
                            position: "right",
                            backgroundColor: "#f44336",
                        }).showToast();

                        setTimeout(function() {
                            $("#executeUpdate").prop("disabled", false);
                        }, 3500);
                    }
                });
            });
        });
        </script>

        <script>
        $(document).ready(function() {
            $("#clearproses").click(function() {
                // Nonaktifkan tombol agar tidak bisa diklik dua kali
                $("#clearproses").prop("disabled", true);
                $("#notifications").html(""); // Menghapus notifikasi sebelumnya

                // Kirim permintaan AJAX
                $.ajax({
                    url: "<?= base_url('UpdateallController/clearProses') ?>", // URL untuk request
                    type: "GET", // Tipe permintaan
                    dataType: "json", // Response akan dalam format JSON
                    success: function(response) {
                        // Jika status berhasil
                        if (response.status === "success") {
                            let delay = 0; // Delay untuk menampilkan toast satu per satu
                            let totalToastCount = response.steps.length; // Jumlah langkah
                            let toastDisplayed = 0; // Hitung toast yang ditampilkan

                            response.steps.forEach(step => {
                                // Tampilkan toast dengan delay
                                setTimeout(function() {
                                    Toastify({
                                        text: step
                                            .message, // Pesan dari response
                                        duration: 5000, // Durasi toast (5 detik)
                                        close: true, // Tampilkan tombol tutup
                                        gravity: "top", // Posisi toast di atas
                                        position: "right", // Posisi di kanan
                                        backgroundColor: "#4fbe87", // Warna hijau untuk sukses
                                    }).showToast();

                                    toastDisplayed++; // Hitung toast yang ditampilkan
                                    if (toastDisplayed ===
                                        totalToastCount) {
                                        // Aktifkan kembali tombol setelah semua toast ditampilkan
                                        $("#clearproses").prop("disabled",
                                            false);
                                    }
                                }, delay);
                                delay +=
                                    3500; // Tambahkan delay untuk toast berikutnya
                            });
                        } else {
                            // Jika terjadi kesalahan, tampilkan pesan error
                            Toastify({
                                text: response.message, // Pesan error dari response
                                duration: 5000, // Durasi toast (5 detik)
                                close: true, // Tampilkan tombol tutup
                                gravity: "top", // Posisi toast di atas
                                position: "right", // Posisi di kanan
                                backgroundColor: "#f44336", // Warna merah untuk error
                            }).showToast();

                            // Aktifkan tombol kembali setelah delay
                            setTimeout(function() {
                                $("#clearproses").prop("disabled", false);
                            }, 3500);
                        }
                    },
                    error: function() {
                        // Jika AJAX gagal
                        Toastify({
                            text: "Terjadi kesalahan saat memperbarui data.", // Pesan default error
                            duration: 5000, // Durasi toast (5 detik)
                            close: true, // Tampilkan tombol tutup
                            gravity: "top", // Posisi toast di atas
                            position: "right", // Posisi di kanan
                            backgroundColor: "#f44336", // Warna merah untuk error
                        }).showToast();

                        // Aktifkan tombol kembali setelah delay
                        setTimeout(function() {
                            $("#clearproses").prop("disabled", false);
                        }, 3500);
                    }
                });
            });
        });
        </script>


</body>

</html>