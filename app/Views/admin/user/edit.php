<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data User</h4>
                <form action="<?= base_url('/admin/user/update/' . $users['id']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id" value="<?= $users['id']; ?>">
                    <div class="form-group">
                        <label for="fullname">Nama User</label>
                        <input type="text" class="form-control <?= (validation_show_error('fullname')) ? 'is-invalid' : ''; ?>" id="fullname" name="fullname" value="<?= old('fullname', $users['fullname']); ?>" placeholder="Nama User">
                        <div class="invalid-feedback">
                            <?= validation_show_error('fullname'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $users['email']); ?>" placeholder="Email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control <?= (validation_show_error('role')) ? 'is-invalid' : ''; ?>" id="role" name="role">
                            <option value="">Pilih Role</option>
                            <option value="Admin" <?= (old('role', $users['role']) == 'Admin') ? 'selected' : '' ?>>Admin</option>
                            <option value="Dosen" <?= (old('role', $users['role']) == 'Dosen') ? 'selected' : '' ?>>Dosen</option>
                            <option value="Gugus Kendali Mutu" <?= (old('role', $users['role']) == 'Gugus Kendali Mutu') ? 'selected' : '' ?>>Gugus Kendali Mutu</option>
                            <option value="Panitia" <?= (old('role', $users['role']) == 'Panitia') ? 'selected' : '' ?>>Panitia</option>
                            <option value="Pengawas" <?= (old('role', $users['role']) == 'Pengawas') ? 'selected' : '' ?>>Pengawas</option>
                            <option value="Koordinator" <?= (old('role', $users['role']) == 'Koordinator') ? 'selected' : '' ?>>Koordinator</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('role'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>