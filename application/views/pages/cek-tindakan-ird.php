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
                                    <li class="breadcrumb-item active" aria-current="page">Tindakan IRD</li>
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
                                <table class="table" id="tindakanird">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Sep</th>
                                            <th>Tanggal Masuk</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Nama Pasien</th>
                                            <th>NoCM</th>
                                            <th>Dokter</th>
                                            <th>Tambah Tindakan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($tindakanird as $ird): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $ird['nosep'] ?></td>
                                                <td><?= $ird['tgl_masuk'] ?></td>
                                                <td><?= $ird['tgl_keluar'] ?></td>
                                                <td><?= $ird['nama'] ?></td>
                                                <td><?= $ird['nocm'] ?></td>
                                                <td><?= $ird['dokter'] ?></td>
                                                <td>
                                                    <button class="btn btn-primary"
                                                        onclick="duplicateDataIrd('<?= $ird['nosep'] ?>')">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
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
        function duplicateDataIrd(nosep) {
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Tindakan akan ditambahkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Tambah',
                cancelButtonText: 'Batal',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '<?= base_url('JasaController/duplicate_dataIrd') ?>',
                        method: 'POST',
                        data: {
                            nosep: nosep
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: 'Data berhasil disalin dan diperbarui!',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan!',
                                text: 'Terjadi kesalahan saat memproses data.',
                            });
                        }
                    });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Dibatalkan',
                        text: 'Data tidak jadi diperbarui',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        }
    </script>
</body>

</html>