<!-- Modal Cek Password Lama -->
<div class="modal fade" id="checkOldPasswordModal" onsubmit="return false;" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title">Verifikasi Password Lama</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="oldPasswordAlert"></div>
                <form id="checkOldPasswordForm">
                    <input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user'); ?>">
                    <div class="mb-3">
                        <label for="oldPassword" class="form-label">Password Lama</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="oldPassword" name="old_password" required>
                            <button type="button" class="btn btn-outline-secondary toggle-password"
                                data-target="oldPassword">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Cek</button>
                </form>
            </div>
        </div>
    </div>
</div>