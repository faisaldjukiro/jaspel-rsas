<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="shortcut icon" href="https://upload.wikimedia.org/wikipedia/commons/0/0c/LOGO_KOTA_GORONTALO.png"
        type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="<?= base_url('template/') ?>assets/compiled/css/app.css">
    <link rel="stylesheet" href="<?= base_url('template/') ?>assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="<?= base_url('template/') ?>assets/compiled/css/iconly.css">
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
                <h3>Beranda</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-12 col-lg-3 col-md-6">
                                <div class="card shadow">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-3 col-xl-3 col-xxl-3 d-flex justify-content-start ">
                                                <div class="stats-icon purple mb-2">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                                                <h6 class="text-muted font-semibold">Jasa Terakhir</h6>
                                                <?php
                                                    $kd_peg = $this->session->userdata('username');
                                                    $role = $this->session->userdata('role');
                                                    if ($role == 2) {
                                                        $query = $this->db->query("SELECT (total_jasa - potongan) AS hasil_jasa 
                                                                                    FROM tb_jasa_dokter_spesialis 
                                                                                    WHERE kd_peg = ? 
                                                                                    ORDER BY total_jasa DESC", [$kd_peg]);
                                                    } else {
                                                        $query = $this->db->query("SELECT (total_jasa - potongan) AS hasil_jasa 
                                                                                    FROM tb_jasa_paramedis  
                                                                                    WHERE kd_peg = ? 
                                                                                    ORDER BY total_jasa DESC", [$kd_peg]);
                                                    }
                                                    $result = $query->row();
                                                    ?>

                                                <h6 class="font-extrabold mb-0">
                                                    <?php
                                                        if (!$result || $result->hasil_jasa === NULL) {
                                                            echo "Tidak ada jasa diterima";
                                                        } else {
                                                            echo format_rupiah($result->hasil_jasa);
                                                        }
                                                        ?>
                                                </h6>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 col-md-6">
                                <div class="card shadow">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-3 col-xl-3 col-xxl-3 d-flex justify-content-start ">
                                                <div class="stats-icon blue mb-2">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                                                <h6 class="text-muted font-semibold">Klaim</h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?php
                                                        $query = $this->db->query('SELECT SUM(jumlah_sebelum_dikurangi) AS total_klaim FROM klaim');
                                                        $result = $query->row();
                                                        if ($result->total_klaim == NULL) {
                                                            echo "Belum ada perhitungan jasa";
                                                        } else {
                                                            echo format_rupiah($result->total_klaim);
                                                        }
                                                        ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 col-md-6">
                                <div class="card shadow">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-3 col-xl-3 col-xxl-3 d-flex justify-content-start ">
                                                <div class="stats-icon green mb-2">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                                                <h6 class="text-muted font-semibold">Klaim Potongan</h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?php
                                                        $query = $this->db->query('SELECT SUM(jumlah) AS total_klaim FROM klaim');
                                                        $result = $query->row();
                                                        if ($result->total_klaim == NULL) {
                                                            echo "Belum ada perhitungan jasa";
                                                        } else {
                                                            echo format_rupiah($result->total_klaim);
                                                        }
                                                        ?>
                                                </h6>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 col-md-6">
                                <div class="card shadow" id="userCard">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-3 col-xl-3 col-xxl-3 d-flex justify-content-start">
                                                <div class="avatar avatar-lg">
                                                    <img src="<?= base_url('template/') ?>assets/compiled/jpg/1.jpg"
                                                        alt="Face 1">
                                                </div>
                                            </div>
                                            <div class="col-md-9 col-lg-9 col-xl-9 col-xxl-9">
                                                <h6 class="text-muted font-semibold">Users</h6>
                                                <h6 class="font-extrabold mb-0">
                                                    <?php echo $this->session->userdata('nama_pegawai'); ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dropdown-menu" id="userDropdown">
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#checkOldPasswordModal">Ganti Password</a>
                                    <a class="dropdown-item"
                                        href="<?= base_url('LoginController/logout'); ?>">Keluar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-12">
                        <div class="card shadow">
                            <div class="card-header">
                                <div class="col-12 col-md-4 col-lg-2 mb-2">
                                    <select id="filterTahun" class="form-select">
                                    </select>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                $role = $this->session->userdata('role');
                                
                                if ($role == 2) {
                                    echo '<div id="chart-isal"></div>';
                                } else {
                                    echo '<div id="chart-isal-pegawai"></div>';
                                }
                                ?>
                            </div>

                        </div>
                    </div>

                </section>
                <?php $this->load->view('modal/ubah_password'); ?>
                <?php $this->load->view('modal/ubah_password2'); ?>
            </div>
            <?php $this->load->view('include/footer'); ?>
        </div>
    </div>
    <script src="<?= base_url('template/') ?>assets/static/js/components/dark.js"></script>
    <script src="<?= base_url('template/') ?>assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/compiled/js/app.js"></script>
    <script src="<?= base_url('template/') ?>assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/static/js/pages/dashboard.js"></script>


    <!-- chart dokter -->
    <script>
    function formatRupiah(angka) {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0
        }).format(angka);
    }

    document.addEventListener("DOMContentLoaded", function() {
        let tahunSekarang = new Date().getFullYear();
        let selectTahun = document.getElementById("filterTahun");
        for (let i = tahunSekarang - 3; i <= tahunSekarang + 2; i++) {
            let option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            if (i === tahunSekarang) {
                option.selected = true;
            }
            selectTahun.appendChild(option);
        }

        function loadChart(tahun) {
            let url = "<?= base_url('BerandaController/getChartDokter') ?>";
            if (tahun) {
                url += "?tahun=" + tahun;
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    let chartData = [];
                    for (let i = 1; i <= 12; i++) {
                        chartData.push(data[i] ? data[i] : 0);
                    }

                    var optionsProfileVisit = {
                        chart: {
                            type: "bar",
                            height: 300,
                            events: {
                                dataPointSelection: function(event, chartContext, config) {
                                    let bulanIndex = config.dataPointIndex +
                                        1;
                                    let bulan = bulanIndex.toString().padStart(2,
                                        "0");

                                    let searchQuery =
                                        `${bulan}-${tahun}`;
                                    let targetURL = "<?= base_url('jasa-dokter') ?>?search=" +
                                        encodeURIComponent(searchQuery);

                                    window.location.href = targetURL;
                                }
                            }
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        series: [{
                            name: "Total Jasa",
                            data: chartData,
                        }],
                        colors: ["#0E5CAAFF"],
                        xaxis: {
                            categories: [
                                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                            ],
                        },
                        yaxis: {
                            labels: {
                                formatter: function(value) {
                                    return formatRupiah(value);
                                }
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function(value) {
                                    return formatRupiah(value);
                                }
                            }
                        }
                    };

                    document.querySelector("#chart-isal").innerHTML = "";
                    var chartProfileVisit = new ApexCharts(
                        document.querySelector("#chart-isal"),
                        optionsProfileVisit
                    );
                    chartProfileVisit.render();
                })
                .catch(error => console.error("Error fetching chart data:", error));
        }

        loadChart(tahunSekarang);
        selectTahun.addEventListener("change", function() {
            let selectedYear = this.value;
            loadChart(selectedYear);
        });
    });
    </script>

    <!-- chart non dokter -->
    <script>
    function formatRupiah(angka) {
        return new Intl.NumberFormat("id-ID", {
            style: "currency",
            currency: "IDR",
            minimumFractionDigits: 0
        }).format(angka);
    }

    document.addEventListener("DOMContentLoaded", function() {
        let tahunSekarang = new Date().getFullYear();
        let selectTahun = document.getElementById("filterTahun");
        for (let i = tahunSekarang - 3; i <= tahunSekarang + 2; i++) {
            let option = document.createElement("option");
            option.value = i;
            option.textContent = i;
            if (i === tahunSekarang) {
                option.selected = true;
            }
            selectTahun.appendChild(option);
        }

        function loadChart(tahun) {
            let url = "<?= base_url('BerandaController/getChartNonDokter') ?>";
            if (tahun) {
                url += "?tahun=" + tahun;
            }

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    let chartData = [];
                    for (let i = 1; i <= 12; i++) {
                        chartData.push(data[i] ? data[i] : 0);
                    }

                    var optionsProfileVisit = {
                        chart: {
                            type: "bar",
                            height: 300,
                            events: {
                                dataPointSelection: function(event, chartContext, config) {
                                    let bulanIndex = config.dataPointIndex +
                                        1;
                                    let bulan = bulanIndex.toString().padStart(2,
                                        "0");

                                    let searchQuery =
                                        `${bulan}-${tahun}`;
                                    let targetURL = "<?= base_url('jasa-non-dokter') ?>?search=" +
                                        encodeURIComponent(searchQuery);

                                    window.location.href = targetURL;
                                }
                            }
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        series: [{
                            name: "Total Jasa",
                            data: chartData,
                        }],
                        colors: ["#0E5CAAFF"],
                        xaxis: {
                            categories: [
                                "Januari", "Februari", "Maret", "April", "Mei", "Juni",
                                "Juli", "Agustus", "September", "Oktober", "November", "Desember"
                            ],
                        },
                        yaxis: {
                            labels: {
                                formatter: function(value) {
                                    return formatRupiah(value);
                                }
                            }
                        },
                        tooltip: {
                            y: {
                                formatter: function(value) {
                                    return formatRupiah(value);
                                }
                            }
                        }
                    };

                    document.querySelector("#chart-isal-pegawai").innerHTML = "";
                    var chartProfileVisit = new ApexCharts(
                        document.querySelector("#chart-isal-pegawai"),
                        optionsProfileVisit
                    );
                    chartProfileVisit.render();
                })
                .catch(error => console.error("Error fetching chart data:", error));
        }

        loadChart(tahunSekarang);
        selectTahun.addEventListener("change", function() {
            let selectedYear = this.value;
            loadChart(selectedYear);
        });
    });
    </script>
    <script>
    document.getElementById('userCard').addEventListener('click', function(event) {
        let dropdown = document.getElementById('userDropdown');
        dropdown.classList.toggle('show');
        dropdown.style.position = "absolute";
        dropdown.style.left = event.pageX + "px";
        dropdown.style.top = event.pageY + "px";
    });

    document.addEventListener('click', function(event) {
        let dropdown = document.getElementById('userDropdown');
        let card = document.getElementById('userCard');
        if (!card.contains(event.target)) {
            dropdown.classList.remove('show');
        }
    });
    </script>

    <script>
    $(document).ready(function() {
        $('.toggle-password').click(function() {
            let input = $('#' + $(this).data('target'));
            let icon = $(this).find('i');

            if (input.attr('type') === "password") {
                input.attr('type', "text");
                icon.removeClass('bi-eye').addClass('bi-eye-slash');
            } else {
                input.attr('type', "password");
                icon.removeClass('bi-eye-slash').addClass('bi-eye');
            }
        });


        $('#checkOldPasswordForm').submit(function(e) {
            e.preventDefault();
            console.log("AJAX Dijalankan");

            $.ajax({
                url: "<?= base_url('BerandaController/checkOldPassword') ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    console.log("Response Diterima:", response);
                    if (response.status === "success") {
                        $('#checkOldPasswordModal').modal('hide');
                        setTimeout(function() {
                            $('#changePasswordModal').modal('show');
                        }, 500);
                    } else {
                        $('#oldPasswordAlert').html('<div class="alert alert-danger">' +
                            response.message + '</div>');
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error:", xhr, status, error);
                    $('#oldPasswordAlert').html(
                        '<div class="alert alert-danger">Terjadi kesalahan, coba lagi.</div>'
                    );
                }
            });
        });

        $('#changePasswordForm').submit(function(e) {
            e.preventDefault();

            $.ajax({
                url: "<?= base_url('BerandaController/changePassword') ?>",
                type: "POST",
                data: $(this).serialize(),
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        $('#newPasswordAlert').html('<div class="alert alert-success">' +
                            response.message + '</div>');
                        $('#changePasswordForm')[0].reset();
                        setTimeout(function() {
                            $('#changePasswordModal').modal('hide');
                        }, 2000);
                    } else {
                        $('#newPasswordAlert').html('<div class="alert alert-danger">' +
                            response.message + '</div>');
                    }
                },
                error: function() {
                    $('#newPasswordAlert').html(
                        '<div class="alert alert-danger">Terjadi kesalahan, coba lagi.</div>'
                    );
                }
            });
        });
    });
    </script>
</body>

</html>