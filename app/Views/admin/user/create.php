<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data User</h4>
                <form action="<?= base_url('/admin/user/save') ?>" method="post" class="forms-sample">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="fullname">Nama User</label>
                        <input type="text" class="form-control <?= (validation_show_error('fullname')) ? 'is-invalid' : ''; ?>" id="fullname" name="fullname" value="<?= old('fullname'); ?>" placeholder="Nama User">
                        <div class="invalid-feedback">
                            <?= validation_show_error('fullname'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>" placeholder="Email">
                        <div class="invalid-feedback">
                            <?= validation_show_error('email'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control <?= (validation_show_error('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" value="<?= old('password'); ?>" placeholder="Password">
                        <div class="invalid-feedback">
                            <?= validation_show_error('password'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pass_confirm">Repeat Password</label>
                        <input type="password" class="form-control <?= (validation_show_error('pass_confirm')) ? 'is-invalid' : ''; ?>" id="pass_confirm" name="pass_confirm" value="<?= old('pass_confirm'); ?>" placeholder="Repeat Password">
                        <div class="invalid-feedback">
                            <?= validation_show_error('pass_confirm'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control <?= (validation_show_error('role')) ? 'is-invalid' : ''; ?>" id="role" name="role">
                            <option value="">Pilih Role</option>
                            <option value="Admin" <?= old('role') == 'Admin' ? 'selected' : '';  ?>>Admin</option>
                            <option value="Dosen" <?= old('role') == 'Dosen' ? 'selected' : '';  ?>>Dosen</option>
                            <option value="Gugus Kendali Mutu" <?= old('role') == 'Gugus Kendali Mutu' ? 'selected' : '';  ?>>Gugus Kendali Mutu</option>
                            <option value="Panitia" <?= old('role') == 'Panitia' ? 'selected' : '';  ?>>Panitia</option>
                            <option value="Pengawas" <?= old('role') == 'Pengawas' ? 'selected' : '';  ?>>Pengawas</option>
                            <option value="Koordinator" <?= old('role') == 'Koordinator' ? 'selected' : '';  ?>>Koordinator</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('role'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>