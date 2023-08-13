<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Pengawas</h4>
                <form action="<?= base_url('/admin/pengawas/save') ?>" method="post" class="forms-sample">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control <?= (validation_show_error('nip')) ? 'is-invalid' : ''; ?>" id="nip" name="nip" value="<?= old('nip'); ?>" placeholder="NIP">
                        <div class="invalid-feedback">
                            <?= validation_show_error('nip'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="pengawas">Nama Pengawas</label>
                        <input type="text" class="form-control <?= (validation_show_error('pengawas')) ? 'is-invalid' : ''; ?>" id="pengawas" name="pengawas" value="<?= old('pengawas'); ?>" placeholder="Nama Pengawas">
                        <div class="invalid-feedback">
                            <?= validation_show_error('pengawas'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control <?= (validation_show_error('email')) ? 'is-invalid' : ''; ?>" id="email" name="email" value="<?= old('email'); ?>" placeholder="Email">
                        <div class="invalid-feedback">
                            <?= validation_show_error('email'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>