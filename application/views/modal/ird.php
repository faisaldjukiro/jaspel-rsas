<div class="modal fade text-left w-100" id="full-ird" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel20">Tindakan IRD Tidak Lengkap</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
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
                                        <button class="btn btn-primary" onclick="duplicateDataIrd('<?= $ird['nosep'] ?>')">
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </td>

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