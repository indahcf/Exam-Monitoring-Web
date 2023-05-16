<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Kelas</h4>
                <form action="<?= base_url('/admin/kelas/save') ?>" method="post" class="forms-sample">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="kode_matkul">Kode Mata Kuliah</label>
                        <input type="text" class="form-control <?= (validation_show_error('kode_matkul')) ? 'is-invalid' : ''; ?>" id="kode_matkul" name="kode_matkul" value="<?= old('kode_matkul'); ?>" placeholder="Kode Mata Kuliah">
                        <div class="invalid-feedback">
                            <?= validation_show_error('kode_matkul'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="matkul">Nama Mata Kuliah</label>
                        <input type="text" class="form-control <?= (validation_show_error('matkul')) ? 'is-invalid' : ''; ?>" id="matkul" name="matkul" value="<?= old('matkul'); ?>" placeholder="Nama Mata Kuliah">
                        <div class="invalid-feedback">
                            <?= validation_show_error('matkul'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dosen">Nama Dosen</label>
                        <input type="text" class="form-control <?= (validation_show_error('dosen')) ? 'is-invalid' : ''; ?>" id="dosen" name="dosen" value="<?= old('dosen'); ?>" placeholder="Nama Dosen">
                        <div class="invalid-feedback">
                            <?= validation_show_error('dosen'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control <?= (validation_show_error('kelas')) ? 'is-invalid' : ''; ?>" id="kelas" name="kelas" value="<?= old('kelas'); ?>" placeholder="Kelas">
                        <div class="invalid-feedback">
                            <?= validation_show_error('kelas'); ?>
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
                    <div class="form-group">
                        <label for="jumlah_mahasiswa">Jumlah Mahasiswa</label>
                        <input type="text" class="form-control <?= (validation_show_error('jumlah_mahasiswa')) ? 'is-invalid' : ''; ?>" id="jumlah_mahasiswa" name="jumlah_mahasiswa" value="<?= old('jumlah_mahasiswa'); ?>" placeholder="Jumlah Mahasiswa">
                        <div class="invalid-feedback">
                            <?= validation_show_error('jumlah_mahasiswa'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>