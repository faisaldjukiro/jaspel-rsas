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
                                    <li class="breadcrumb-item active" aria-current="page">Porsi Jasa</li>
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
                                <table class="table" id="kasuskosong">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Pengelompokan</th>
                                            <th>Total Jasa</th>
                                            <th>Kebersamaan</th>
                                            <th>Angka Kebersamaan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        foreach ($dataporsi as $porsi): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $porsi['pengelompokan'] ?></td>
                                            <td><?= format_rupiah($porsi['total_jasa']) ?></td>
                                            <td><?= $porsi['kebersamaan'] ?></td>
                                            <td><?= format_rupiah($porsi['angka_kebersamaan']) ?></td>
                                            <td>
                                                <button class="btn btn-primary editButton" title="Edit Data Porsi"
                                                    data-id="<?= $porsi['id_porsi'] ?>"
                                                    data-pengelompokan="<?= $porsi['pengelompokan'] ?>"
                                                    data-total-jasa="<?= $porsi['total_jasa'] ?>"
                                                    data-kebersamaan="<?= $porsi['kebersamaan'] ?>"
                                                    data-angka-kebersamaan="<?= $porsi['angka_kebersamaan'] ?>">
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
                <?php $this->load->view('modal/porsi_jasa'); ?>
            </div>
            <?php $this->load->view('include/footer'); ?>
        </div>
    </div>
    <?php $this->load->view('include/js'); ?>
    <script>
    $(document).ready(function() {
        function formatRupiah(angka) {
            var reverse = angka.toString().split('').reverse().join(''),
                ribuan = reverse.match(/\d{1,3}/g);
            ribuan = ribuan.join('.').split('').reverse().join('');
            return 'Rp ' + ribuan;
        }
        $(".editButton").click(function() {
            var id_porsi = $(this).data("id");
            var pengelompokan = $(this).data('pengelompokan');
            var total_jasa = $(this).data("total-jasa");
            var kebersamaan = $(this).data("kebersamaan");
            var angka_kebersamaan = $(this).data("angka-kebersamaan");
            $("#editId").val(id_porsi);
            $("#edidTotal_jasa").val(formatRupiah(total_jasa));
            $("#editKebersamaan").val(kebersamaan);
            $("#editAngkaKebersamaan").val(formatRupiah(angka_kebersamaan));
            $("#editModal").modal("show");
            $('#editModalLabel').text('Edit Porsi Jasa - ' + pengelompokan);
        });

        function updateAngkaKebersamaan() {
            var total_jasa = parseFloat($("#edidTotal_jasa").val().replace(/[^\d]+/g,
                ""));
            var kebersamaan = parseFloat($("#editKebersamaan").val().replace(/[^\d]+/g,
                ""));
            var angka_kebersamaan = 0;

            if (!isNaN(total_jasa) && !isNaN(kebersamaan)) {
                angka_kebersamaan = (total_jasa * kebersamaan) / 100;
            }

            $("#editAngkaKebersamaan").val(formatRupiah(angka_kebersamaan.toFixed(0)));
        }

        $("#edidTotal_jasa").on("input", function() {
            updateAngkaKebersamaan();
        });

        $("#editKebersamaan").on("input", function() {
            updateAngkaKebersamaan();
        });

        $("#saveChanges").click(function() {
            var total_jasa_raw = $("#edidTotal_jasa").val().replace(/[^\d]+/g,
                "");
            var angka_kebersamaan_raw = $("#editAngkaKebersamaan").val().replace(/[^\d]+/g,
                "");
            var formData = $("#editForm").serialize() + "&total_jasa=" + total_jasa_raw +
                "&angka_kebersamaan=" + angka_kebersamaan_raw;

            $.ajax({
                url: "<?php echo site_url('PegawaiController/simpanporsi'); ?>",
                method: "POST",
                data: formData,
                success: function(response) {
                    var res = JSON.parse(response);
                    alert(res.message);
                    if (res.status === 'success') {
                        $("#editModal").modal("hide");
                        location.reload();
                    }
                }
            });
        });
    });
    </script>

</body>

</html>