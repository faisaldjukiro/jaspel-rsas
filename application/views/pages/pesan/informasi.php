<!DOCTYPE html>
<html lang="en">

<head>
    <?php $this->load->view('include/head'); ?>
    <style>
    .modal-dialog.custom-size {
        max-width: 60%;
        max-height: 100%;
    }

    .modal-body iframe {
        height: 800px;
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
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-start mb-3">
                                <?php if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5): ?>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahModal">
                                    <i class="bi bi-plus"></i> Informasi
                                </button>
                                <?php endif; ?>

                            </div>

                            <div class="table-responsive">
                                <table class="table" id="tindakanird">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Pasien</th>
                                            <th>Tags</th>
                                            <th>Pesan</th>
                                            <th>Berkas</th>
                                            <th>Chat</th>
                                            <?php if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5): ?>
                                            <th>Aksi</th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($informasi as $pesan): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $pesan['nama_pasien'] ?></td>
                                            <td><?= $pesan['tags'] ?></td>
                                            <td><?= $pesan['pesan'] ?></td>
                                            <td>
                                                <?php
                                                    $file_path = FCPATH . 'berkas/' . $pesan['berkas'];
                                                    $button_class = (empty($pesan['berkas']) || !file_exists($file_path)) ? 'btn-danger' : 'btn-primary';
                                                    ?>
                                                <button class="btn <?= $button_class ?> btn-sm"
                                                    onclick="showPdf('<?= base_url('PesanController/view_pdf/' . $pesan['berkas']); ?>')">
                                                    <i class="bi bi-eye"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('chat/' . $pesan['id_informasi']); ?>"
                                                    target="_blank">
                                                    <button class="btn btn-success btn-sm ">
                                                        <i class="bi bi-messenger"></i>
                                                    </button>
                                                </a>
                                            </td>

                                            <?php if ($this->session->userdata('role') == 1 || $this->session->userdata('role') == 5): ?>
                                            <td>
                                                <div class="d-flex flex-wrap gap-2">
                                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                        data-bs-target="#editModal">
                                                        <i class="bi bi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-danger btn-sm">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>
                                            </td>

                                            <?php endif; ?>

                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- Modal Tambah Data -->
                    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="tambahModalLabel">Tambah Informasi</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="informasi-form" action="<?= base_url('informasi-tambah'); ?>" method="post"
                                    enctype="multipart/form-data">
                                    <div class="modal-body">
                                        <div id="message-box"></div>
                                        <div class="mb-3 position-relative">
                                            <label for="searchPegawai" class="form-label">Dokter</label>
                                            <input type="text" class="form-control" id="searchPegawai"
                                                placeholder="Cari Dokter..." autocomplete="off">
                                            <input type="hidden" id="kd_pegawai" name="kd_pegawai" required>
                                            <div class="dropdown-menu w-100" id="pegawaiDropdown"
                                                style="max-height: 200px; overflow-y: auto;">
                                                <?php foreach ($pegawai as $p) : ?>
                                                <a class="dropdown-item pegawai-option" href="#"
                                                    data-value="<?= $p['username']; ?>"><?= $p['nama_pegawai']; ?></a>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="nama_pasien" class="form-label">Nama Pasien</label>
                                            <input type="text" class="form-control" id="nama_pasien" name="nama_pasien"
                                                required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="tags" class="form-label">Tags</label>
                                            <input type="text" class="form-control" id="tags" name="tags">
                                        </div>

                                        <div class="mb-3">
                                            <label for="pesan" class="form-label">Pesan</label>
                                            <textarea class="form-control" id="pesan" name="pesan" rows="3"
                                                required></textarea>
                                        </div>

                                        <div class="mb-3">
                                            <label for="berkas" class="form-label">Upload Berkas</label>
                                            <input type="file" class="form-control" id="berkas" name="berkas"
                                                accept="application/pdf">
                                        </div>

                                        <div class="mb-3">
                                            <label for="status" class="form-label">Status</label>
                                            <select class="form-select" id="status" name="status" required>
                                                <option value="0">Proses</option>
                                                <option value="1">Selesai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- End Modal Tambah Data -->


                    <!-- modal lihat pdf -->
                    <div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog custom-size">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="pdfModalLabel">Pratinjau PDF</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <iframe id="pdfFrame" src="" width="100%" height="800px"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end modal lihat pdf -->
                </section>
            </div>
            <?php $this->load->view('include/footer'); ?>
        </div>
    </div>
    <?php $this->load->view('include/js'); ?>
    <script>
    function showPdf(pdfUrl) {
        fetch(pdfUrl)
            .then(response => response.blob())
            .then(blob => {
                let blobUrl = URL.createObjectURL(blob);
                document.getElementById("pdfFrame").src = blobUrl;
                var pdfModal = new bootstrap.Modal(document.getElementById("pdfModal"));
                pdfModal.show();
            })
            .catch(error => console.error('Error fetching PDF:', error));
    }
    </script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        let searchInput = document.getElementById("searchPegawai");
        let kdPegawaiInput = document.getElementById("kd_pegawai");
        let dropdown = document.getElementById("pegawaiDropdown");
        let options = document.querySelectorAll(".pegawai-option");
        searchInput.addEventListener("input", function() {
            let filter = searchInput.value.toLowerCase();
            let hasResults = false;

            options.forEach(function(option) {
                let text = option.textContent.toLowerCase();
                if (text.includes(filter)) {
                    option.style.display = "";
                    hasResults = true;
                } else {
                    option.style.display = "none";
                }
            });

            dropdown.style.display = hasResults ? "block" : "none";
        });
        options.forEach(function(option) {
            option.addEventListener("click", function(e) {
                e.preventDefault();
                searchInput.value = this.textContent;
                kdPegawaiInput.value = this.getAttribute(
                    "data-value");
                dropdown.style.display = "none";
            });
        });
        document.addEventListener("click", function(e) {
            if (!searchInput.contains(e.target) && !dropdown.contains(e.target)) {
                dropdown.style.display = "none";
            }
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $('#informasi-form').on('submit', function(e) {
            e.preventDefault();

            $('#message-box').html('');

            var formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                dataType: 'json',
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === 'error') {
                        $('#message-box').html('<div class="alert alert-danger">' + response
                            .message + '</div>');
                    } else if (response.status === 'success') {
                        $('#message-box').html('<div class="alert alert-success">' +
                            response.message + '</div>');
                        $('#informasi-form')[0].reset();
                        $('#tambahModal').modal('hide');
                        window.location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    $('#message-box').html(
                        '<div class="alert alert-danger">Terjadi kesalahan, silakan coba lagi.</div>'
                    );
                }
            });
        });
    });
    </script>

</body>

</html>