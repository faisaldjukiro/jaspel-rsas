<div class="modal fade text-left w-100" id="full-kasus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel20">Kasus Kosong</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table" id="kasuskosong">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Sep</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>Nama Pasien</th>
                                <th>NoCM</th>
                                <th>Dokter</th>
                                <th>Layanan</th>
                                <th>Tindakan</th>
                                <th>Rawatan</th>
                                <th>Kode DPJP</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kasuskosong as $kasus): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $kasus['nosep'] ?></td>
                                <td><?= $kasus['tgl_masuk'] ?></td>
                                <td><?= $kasus['tgl_keluar'] ?></td>
                                <td><?= $kasus['nama'] ?></td>
                                <td><?= $kasus['nocm'] ?></td>
                                <td><?= $kasus['dokter'] ?></td>
                                <td><?= $kasus['layanan'] ?></td>
                                <td><?= $kasus['tindakan'] ?></td>
                                <td><?= $kasus['ruangan'] ?></td>
                                <td><?= $kasus['kd_dpjp'] ?></td>
                            </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                    <i class="bx bx-x d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Close</span>
                </button>
                <button type="button" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                    <i class="bx bx-check d-block d-sm-none"></i>
                    <span class="d-none d-sm-block">Accept</span>
                </button>
            </div> -->
        </div>
    </div>
</div>