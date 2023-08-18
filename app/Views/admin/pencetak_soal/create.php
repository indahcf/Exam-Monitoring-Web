<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Pencetak Soal</h4>
                <form action="<?= base_url('/admin/pencetak_soal/save') ?>" method="post" class="forms-sample">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="dosen">Pencetak Soal</label>
                        <select class="form-control <?= (validation_show_error('pencetak_soal')) ? 'is-invalid' : ''; ?>" id="pencetak_soal" name="pencetak_soal">
                            <option value="">Pilih Pencetak Soal</option>
                            <?php foreach ($pencetak_soal as $p) : ?>
                                <option value="<?php echo $p['id_pengawas']; ?>" <?= old('pencetak_soal') == $p['id_pengawas'] ? 'selected' : null ?>>
                                    <?php echo $p['pengawas']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('pencetak_soal'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <select class="form-control <?= (validation_show_error('prodi')) ? 'is-invalid' : ''; ?>" id="prodi" name="prodi">
                            <option value="">Pilih Program Studi</option>
                            <?php foreach ($prodi as $p) : ?>
                                <option value="<?php echo $p['id_prodi']; ?>" <?= old('prodi') == $p['id_prodi'] ? 'selected' : null ?>>
                                    <?php echo $p['prodi']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('prodi'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>