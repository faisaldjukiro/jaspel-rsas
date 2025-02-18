<div class="modal fade text-left" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="editModalLabel"></h4>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <i data-feather="x"></i>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="editId" name="id" readonly>
                        <label for="edidTotal_jasa" class="form-label"><b>Total Jasa</b></label>
                        <input type="text" class="form-control" id="edidTotal_jasa" name="total_jasa">
                    </div>
                    <div class="mb-3">
                        <label for="editKebersamaan" class="form-label"><b>Point Kebersaman</b></label>
                        <input type="text" class="form-control" id="editKebersamaan" name="kebersamaan">
                    </div>
                    <div class="mb-3">
                        <label for="editAngkaKebersamaan" class="form-label"><b>Angka Kebersaman</b></label>
                        <input type="text" class="form-control" id="editAngkaKebersamaan" name="angka_kebersamaan"
                            readonly>
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