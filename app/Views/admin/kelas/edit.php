<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Kelas</h4>
                <form action="<?= base_url('/admin/kelas/update/' . $kelas['id_kelas']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_kelas" value="<?= $kelas['id_kelas']; ?>">
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
                        <label for="dosen">Nama Dosen</label>
                        <input type="text" class="form-control <?= (validation_show_error('dosen')) ? 'is-invalid' : ''; ?>" id="dosen" name="dosen" value="<?= old('dosen', $dosen['dosen']); ?>" placeholder="Nama Dosen">
                        <div class="invalid-feedback">
                            <?= validation_show_error('dosen'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="text" class="form-control <?= (validation_show_error('kelas')) ? 'is-invalid' : ''; ?>" id="kelas" name="kelas" value="<?= old('kelas', $kelas['kelas']); ?>" placeholder="Kelas">
                        <div class="invalid-feedback">
                            <?= validation_show_error('kelas'); ?>
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
                    <div class="form-group">
                        <label for="jumlah_mahasiswa">Jumlah Mahasiswa</label>
                        <input type="text" class="form-control <?= (validation_show_error('jumlah_mahasiswa')) ? 'is-invalid' : ''; ?>" id="jumlah_mahasiswa" name="jumlah_mahasiswa" value="<?= old('jumlah_mahasiswa', $kelas['jumlah_mahasiswa']); ?>" placeholder="Jumlah Mahasiswa">
                        <div class="invalid-feedback">
                            <?= validation_show_error('jumlah_mahasiswa'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>