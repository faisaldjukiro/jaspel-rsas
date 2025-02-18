<!DOCTYPE html>
<html lang="en">

<head>

    <?php $this->load->view('include/head'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <script src="<?= base_url('template/') ?>assets/static/js/initTheme.js"></script>
    <div id="app">
        <?php $this->load->view('include/sidebar'); ?>
        <div id="main">
            <?php if ($this->session->userdata('role') == 1) : ?>
            <div class="card-body">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Proses Data Pegawai
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div id="notifications"></div>
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <a href="<?= base_url('data-pegawai-tarik') ?>"><button id="tarik data"
                                                type="button" title="Tarik Data Pegawai"
                                                class="btn btn-success w-100 mb-2">
                                                Tarik Data</button></a>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <?php endif?>

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
                                    <li class="breadcrumb-item"><a href="<?php echo base_url('beranda') ?>">Beranda</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Data Pegawai</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card shadow">
                        <div class="card-header d-flex justify-content-between align-items-center">

                            <div class="d-flex gap-3">
                                <div class="form-group mb-0" style="width: 250px;">
                                    <label for="filterKelompok" class="small"><strong>Filter Kelompok
                                            Pegawai</strong></label>
                                    <select id="filterKelompok" class="form-control form-control-sm">
                                        <option value="">Semua</option>
                                        <?php foreach ($kelompok_pegawai as $kelompok): ?>
                                        <option value="<?= $kelompok['kelompok_pegawai'] ?>">
                                            <?= $kelompok['kelompok_pegawai'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group mb-0" style="width: 250px;">
                                    <label for="filterSubKelompok" class="small"><strong>Filter Sub Kelompok
                                            Pegawai</strong></label>
                                    <select id="filterSubKelompok" class="form-control form-control-sm">
                                        <option value="">Semua</option>
                                        <?php foreach ($sub_kelompok_pegawai as $sub_kelompok): ?>
                                        <option value="<?= $sub_kelompok['sub_kelompok_pegawai'] ?>">
                                            <?= $sub_kelompok['sub_kelompok_pegawai'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table" id="table1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pegawai</th>
                                            <th>Jabatan</th>
                                            <th>TMT</th>
                                            <th>Pendidikan Formal</th>
                                            <th>Pendidikan Non Formal</th>
                                            <th>Kelompok Pegawai</th>
                                            <th>Sub Kelompok Pegawai</th>
                                            <th>Gaji Pokok</th>
                                            <th>Pengali Performance</th>
                                            <th>No Rekening</th>
                                            <th>Nama Bank</th>
                                            <th>Sangsi</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                        $no = 1;
                        foreach ($datapegawai as $pegawai): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $pegawai['nama_pegawai'] ?></td>
                                            <td><?= $pegawai['jabatan'] ?></td>
                                            <td><?= $pegawai['tmt'] ?></td>
                                            <td><?= $pegawai['pendidikan_formal'] ?></td>
                                            <td><?= $pegawai['pendidikan_non_formal'] ?></td>
                                            <td class="kelompok-pegawai"> <?= $pegawai['kelompok_pegawai'] ?></td>
                                            <td class="sub-kelompok-pegawai"> <?= $pegawai['sub_kelompok_pegawai'] ?>
                                            </td>
                                            <td><?= format_rupiah($pegawai['gaji_pokok']) ?></td>
                                            <td><?= $pegawai['pengali_performance'] ?></td>
                                            <td><?= $pegawai['no_rekening'] ?></td>
                                            <td><?= $pegawai['nama_bank'] ?></td>
                                            <td><?= $pegawai['nama_pengurangan'] ?></td>
                                            <td>
                                                <button class="btn btn-primary editButton" title="Edit Data"
                                                    data-id="<?= $pegawai['id'] ?>"
                                                    data-id-pengurangan="<?= $pegawai['id_pengurangan'] ?>"
                                                    data-nama-pegawai="<?= $pegawai['nama_pegawai'] ?>"
                                                    data-non-formal="<?= $pegawai['pendidikan_non_formal'] ?>"
                                                    data-pengali-performance="<?= $pegawai['pengali_performance'] ?>">
                                                    <i class="bi bi-pencil-square"></i>
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

                <?php $this->load->view('modal/edit_pegawai'); ?>
            </div>

            <?php $this->load->view('include/footer'); ?>
        </div>
    </div>
    <?php $this->load->view('include/js'); ?>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.addEventListener("click", function(event) {
            if (event.target.closest(".editButton")) {
                let button = event.target.closest(".editButton");

                let id = button.getAttribute("data-id");
                let namaPegawai = button.getAttribute("data-nama-pegawai");
                let pendidikanNonFormal = button.getAttribute("data-non-formal");
                let pengaliPerformance = button.getAttribute("data-pengali-performance");
                let idPengurangan = button.getAttribute("data-id-pengurangan");

                document.getElementById("editId").value = id;
                document.getElementById("editIdPengurangan").value = idPengurangan;
                document.getElementById("namaPegawai").value = namaPegawai;
                document.getElementById("editpendidikanNonFormal").value = pendidikanNonFormal;
                document.getElementById("editPengaliPerformance").value = pengaliPerformance;

                let myModal = new bootstrap.Modal(document.getElementById("editModal"));
                myModal.show();
            }
        });
        document.getElementById("saveChanges").addEventListener("click", function(event) {
            event.preventDefault();
            Swal.fire({
                title: 'Apakah Anda yakin?',
                text: "Anda akan menyimpan perubahan pada data pegawai.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    let formData = new FormData(document.getElementById("editForm"));

                    fetch("<?= base_url('PegawaiController/updatePegawai') ?>", {
                            method: "POST",
                            body: formData
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === "success") {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil!',
                                    text: 'Data pegawai berhasil diperbarui!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    location
                                        .reload();
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Kesalahan!',
                                    text: 'Gagal memperbarui data pegawai!',
                                });
                            }
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan!',
                                text: 'Terjadi kesalahan saat menghubungi server.',
                            });
                            console.error("Error:", error);
                        });
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Dibatalkan',
                        text: 'Perubahan data tidak jadi disimpan.',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        let table = $('#table1').DataTable();
        let lastFilterKelompok = localStorage.getItem('lastFilterKelompok') || '';
        let lastFilterSubKelompok = localStorage.getItem('lastFilterSubKelompok') || '';

        if (lastFilterKelompok) {
            $('#filterKelompok').val(lastFilterKelompok);
            table.column(6).search(lastFilterKelompok).draw();
        }
        if (lastFilterSubKelompok) {
            $('#filterSubKelompok').val(lastFilterSubKelompok);
            table.column(7).search(lastFilterSubKelompok).draw();
        }

        $('#filterKelompok').on('change', function() {
            lastFilterKelompok = this.value;
            localStorage.setItem('lastFilterKelompok', lastFilterKelompok);
            table.column(6).search(lastFilterKelompok).draw();
        });

        $('#filterSubKelompok').on('change', function() {
            lastFilterSubKelompok = this.value;
            localStorage.setItem('lastFilterSubKelompok', lastFilterSubKelompok);
            table.column(7).search(lastFilterSubKelompok).draw();
        });

        $('.editButton').on('click', function() {
            let modal = $('#editModal');
            modal.modal('show');
        });
        $('#editModal').on('hidden.bs.modal', function() {
            $('body').removeClass('modal-open');
            $('.modal-backdrop').remove();
        });

        $('#editModal').on('hidden.bs.modal', function() {
            table.column(6).search(lastFilterKelompok).draw();
            table.column(7).search(lastFilterSubKelompok).draw();
        });
    });
    </script>
</body>

</html>