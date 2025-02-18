<div class="modal fade text-left w-100" id="full-scrn" tabindex="-1" role="dialog" aria-labelledby="myModalLabel20"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-full" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel20">Data Kosong</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table" id="datakosong">
                        <thead>
                            <tr>

                                <th>No</th>
                                <th class=" no-fpk">No FPK</th>
                                <th>Sep</th>
                                <th>Tanggal Masuk</th>
                                <th>Tanggal Keluar</th>
                                <th>NoCM</th>
                                <th>Nama Pasien</th>
                                <th>Dokter</th>
                                <th>Klaim</th>
                                <th>Copy Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($datakosong as $kosong): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $kosong['no_fpk'] ?></td>
                                <td><?= $kosong['nosep'] ?></td>
                                <td><?= $kosong['tgl_masuk'] ?></td>
                                <td><?= $kosong['tgl_keluar'] ?></td>
                                <td><?= $kosong['nocm'] ?></td>
                                <td><?= $kosong['nama'] ?></td>
                                <td><?= $kosong['dokter'] ?></td>
                                <td><?= format_rupiah($kosong['jumlah']) ?></td>
                                <td>
                                    <span class="badge bg-success">Active</span>
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