<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Ubah Password User</h4>
                <form action="<?= base_url('/admin/user/update_password/' . $users['id']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <!-- <input type="hidden" name="id" value="<?= $users['id']; ?>"> -->
                    <div class="form-group">
                        <label for="password_baru">Password Baru</label>
                        <input type="password" class="form-control <?= (validation_show_error('password_baru')) ? 'is-invalid' : ''; ?>" id="password_baru" name="password_baru" value="<?= old('password_baru'); ?>" placeholder="Password Baru">
                        <div class="invalid-feedback">
                            <?= validation_show_error('password_baru'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="konfirmasi_password_baru">Konfirmasi Password Baru</label>
                        <input type="password" class="form-control <?= (validation_show_error('konfirmasi_password_baru')) ? 'is-invalid' : ''; ?>" id="konfirmasi_password_baru" name="konfirmasi_password_baru" value="<?= old('konfirmasi_password_baru'); ?>" placeholder="Konfirmasi Password Baru">
                        <div class="invalid-feedback">
                            <?= validation_show_error('konfirmasi_password_baru'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>