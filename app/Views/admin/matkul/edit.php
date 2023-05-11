<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Mata Kuliah</h4>
                <form action="<?= base_url('/admin/matkul/update/' . $matkul['id_matkul']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_matkul" value="<?= $matkul['id_matkul']; ?>">
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
                        <label for="jumlah_sks">Jumlah SKS</label>
                        <input type="text" class="form-control <?= (validation_show_error('jumlah_sks')) ? 'is-invalid' : ''; ?>" id="jumlah_sks" name="jumlah_sks" value="<?= old('jumlah_sks', $matkul['jumlah_sks']); ?>" placeholder="Jumlah SKS">
                        <div class="invalid-feedback">
                            <?= validation_show_error('jumlah_sks'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control <?= (validation_show_error('semester')) ? 'is-invalid' : ''; ?>" id="semester" name="semester">
                            <option value="">Pilih Semester</option>
                            <option value="Gasal" <?= (old('semester', $matkul['semester']) == 'Gasal') ? 'selected' : '' ?>>Gasal</option>
                            <option value="Genap" <?= (old('semester', $matkul['semester']) == 'Genap') ? 'selected' : '' ?>>Genap</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('semester'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <select class="form-control <?= (validation_show_error('prodi')) ? 'is-invalid' : ''; ?>" id="prodi" name="prodi">
                            <option value="">Pilih Program Studi</option>
                            <?php foreach ($prodi as $p) : ?>
                                <option value="<?= $p['id_prodi']; ?>" <?= ($p['id_prodi'] == $matkul['id_prodi'] || $p['id_prodi'] == old('id_prodi')) ? 'selected' : ' '; ?>>
                                    <?= $p['prodi']; ?>
                                </option>
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