<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Ruang Ujian</h4>
                <form action="<?= base_url('/admin/ruang_ujian/save') ?>" method="post" class="forms-sample">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="ruang_ujian">Nama Ruang Ujian</label>
                        <input type="text" class="form-control <?= (validation_show_error('ruang_ujian')) ? 'is-invalid' : ''; ?>" id="ruang_ujian" name="ruang_ujian" value="<?= old('ruang_ujian'); ?>" placeholder="Nama Ruang Ujian">
                        <div class="invalid-feedback">
                            <?= validation_show_error('ruang_ujian'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kapasitas">Kapasitas</label>
                        <input type="text" class="form-control <?= (validation_show_error('kapasitas')) ? 'is-invalid' : ''; ?>" id="kapasitas" name="kapasitas" value="<?= old('kapasitas'); ?>" placeholder="Kapasitas">
                        <div class="invalid-feedback">
                            <?= validation_show_error('kapasitas'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>