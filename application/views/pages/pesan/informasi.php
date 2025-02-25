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
                        </div>
                        <div class="card-body">
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
                                                <a href="<?= base_url('berkasi/' . $pesan['berkas']); ?>"
                                                    target="_blank">
                                                    <button class="btn btn-primary btn-sm">
                                                        <i class="bi bi-eye"></i>
                                                    </button>
                                                </a>
                                            </td>


                                            <td>
                                                <a href="<?= base_url('chat/' . $pesan['id_informasi']); ?>"
                                                    target="_blank">
                                                    <button class="btn btn-success btn-sm">
                                                        <i class="bi bi-messenger"></i>
                                                    </button>
                                                </a>
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

</body>

</html>