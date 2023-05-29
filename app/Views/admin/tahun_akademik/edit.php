<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Tahun Akademik</h4>
                <form action="<?= base_url('/admin/tahun_akademik/update/' . $tahun_akademik['id_tahun_akademik']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_tahun_akademik" value="<?= $tahun_akademik['id_tahun_akademik']; ?>">
                    <div class="form-group">
                        <label for="tahun_akademik">Tahun Akademik</label>
                        <input type="text" class="form-control <?= (validation_show_error('tahun_akademik')) ? 'is-invalid' : ''; ?>" id="tahun_akademik" name="tahun_akademik" value="<?= old('tahun_akademik', $tahun_akademik['tahun_akademik']); ?>" placeholder="Tahun Akademik">
                        <div class="invalid-feedback">
                            <?= validation_show_error('tahun_akademik'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control <?= (validation_show_error('semester')) ? 'is-invalid' : ''; ?>" id="semester" name="semester">
                            <option value="">Pilih Semester</option>
                            <option value="Gasal" <?= (old('semester', $tahun_akademik['semester']) == 'Gasal') ? 'selected' : '' ?>>Gasal</option>
                            <option value="Genap" <?= (old('semester', $tahun_akademik['semester']) == 'Genap') ? 'selected' : '' ?>>Genap</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('semester'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>