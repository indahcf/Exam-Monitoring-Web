<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Mata Kuliah</h4>
                <form action="<?= base_url('/admin/matkul/update/' . $matkul['id_matkul']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <!-- <input type="hidden" name="id_matkul" value="<?= $matkul['id_matkul']; ?>"> -->
                    <div class="form-group">
                        <label for="kode_matkul">Kode Mata Kuliah</label>
                        <input type="text" class="form-control <?= (validation_show_error('kode_matkul')) ? 'is-invalid' : ''; ?>" id="kode_matkul" name="kode_matkul" value="<?= old('kode_matkul', $matkul['kode_matkul']); ?>" placeholder="Kode Mata Kuliah">
                        <div class="invalid-feedback">
                            <?= validation_show_error('kode_matkul'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="matkul">Nama Mata Kuliah</label>
                        <input type="text" class="form-control <?= (validation_show_error('matkul')) ? 'is-invalid' : ''; ?>" id="matkul" name="matkul" value="<?= old('matkul', $matkul['matkul']); ?>" placeholder="Nama Mata Kuliah">
                        <div class="invalid-feedback">
                            <?= validation_show_error('matkul'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <select class="form-control <?= (validation_show_error('prodi')) ? 'is-invalid' : ''; ?>" id="prodi" name="prodi">
                            <option value="">Pilih Program Studi</option>
                            <?php foreach ($prodi as $p) : ?>
                                <?php if ($p['prodi'] != 'Non Teknik') : ?>
                                    <option value="<?= $p['id_prodi']; ?>" <?= (old('prodi', $matkul['id_prodi']) == $p['id_prodi']) ? 'selected' : ''; ?>>
                                        <?= $p['prodi']; ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('prodi'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>