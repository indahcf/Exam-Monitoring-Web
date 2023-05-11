<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Ruang Ujian</h4>
                <form action="<?= base_url('/admin/ruang_ujian/update/' . $ruang_ujian['id_ruang_ujian']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_ruang_ujian" value="<?= $ruang_ujian['id_ruang_ujian']; ?>">
                    <div class="form-group">
                        <label for="ruang_ujian">Nama Ruang Ujian</label>
                        <input type="text" class="form-control <?= (validation_show_error('ruang_ujian')) ? 'is-invalid' : ''; ?>" id="ruang_ujian" name="ruang_ujian" value="<?= old('ruang_ujian', $ruang_ujian['ruang_ujian']); ?>" placeholder="Nama Ruang Ujian">
                        <div class="invalid-feedback">
                            <?= validation_show_error('ruang_ujian'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kapasitas">Kapasitas</label>
                        <input type="text" class="form-control <?= (validation_show_error('kapasitas')) ? 'is-invalid' : ''; ?>" id="kapasitas" name="kapasitas" value="<?= old('kapasitas', $ruang_ujian['kapasitas']); ?>" placeholder="Kapasitas">
                        <div class="invalid-feedback">
                            <?= validation_show_error('kapasitas'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>