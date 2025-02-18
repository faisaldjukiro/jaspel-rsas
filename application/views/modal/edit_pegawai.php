<div class="modal fade text-left" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editModalLabel">Edit Pegawai</h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="editId" name="id" readonly>
                        <label for="namaPegawai" class="form-label"><b>Nama Pegawai</b></label>
                        <input type="text" class="form-control" id="namaPegawai" name="nama_pegawai" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="editpendidikanNonFormal" class="form-label"><b>Pendidikan Non Formal</b></label>
                        <select class="form-control" id="editpendidikanNonFormal" name="pendidikan_non_formal">
                            <option value="0 SERTIFIKAT">0 SERTIFIKAT</option>
                            <option value="1 SERTIFIKAT">1 SERTIFIKAT</option>
                            <option value="2 SERTIFIKAT">2 SERTIFIKAT</option>
                            <option value="3 SERTIFIKAT">3 SERTIFIKAT</option>
                            <option value="4 SERTIFIKAT">4 SERTIFIKAT</option>
                            <option value="5 SERTIFIKAT">5 SERTIFIKAT</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editPengaliPerformance" class="form-label"><b>Performance</b></label>
                        <select class="form-control" id="editPengaliPerformance" name="pengali_performance">
                            <option value="1.00">1.00</option>
                            <option value="2.00">2.00</option>
                            <option value="3.00">3.00</option>
                            <option value="4.00">4.00</option>
                            <option value="5.00">5.00</option>
                            <option value="6.00">6.00</option>
                            <option value="7.00">7.00</option>
                            <option value="8.00">8.00</option>
                            <option value="8.00">9.00</option>
                            <option value="10.00">10.00</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editIdPengurangan" class="form-label"><b>Sangsi</b></label>
                        <select class="form-control" id="editIdPengurangan" name="id_pengurangan">
                            <?php foreach ($pengurangan as $item): ?>
                            <option value="<?= $item['id_pengurangan'] ?>"><?= $item['nama_pengurangan'] ?> |
                                <?= $item['skor'].'%' ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" id="saveChanges">Simpan</button>
            </div>
        </div>
    </div>
</div>