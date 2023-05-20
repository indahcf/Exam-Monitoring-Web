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
                        <label for="id_prodi">Program Studi</label>
                        <select class="form-control <?= (validation_show_error('id_prodi')) ? 'is-invalid' : ''; ?>" id="id_prodi" name="id_prodi">
                            <option value="">Pilih Program Studi</option>
                            <?php foreach ($prodi as $p) : ?>
                                <option value="<?php echo $p['id_prodi']; ?>" <?= old('prodi') == $p['id_prodi'] ? 'selected' : null ?>>
                                    <?php echo $p['prodi']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('id_prodi'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_matkul">Mata Kuliah</label>
                        <select class="form-control <?= (validation_show_error('id_matkul')) ? 'is-invalid' : ''; ?>" id="id_matkul" name="id_matkul">
                            <option value="">Pilih Mata Kuliah</option>
                            <?php foreach ($matkul as $m) : ?>
                                <option value="<?php echo $m['id_matkul']; ?>" <?= old('matkul') == $m['id_matkul'] ? 'selected' : null ?>>
                                    <?php echo $m['kode_matkul'] . " " . $m['matkul']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('id_matkul'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_prodi">Dosen</label>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-control <?= (validation_show_error('id_prodi')) ? 'is-invalid' : ''; ?>" id="id_prodi" name="id_prodi">
                                        <option value="">Pilih Asal Dosen</option>
                                        <?php foreach ($prodi as $p) : ?>
                                            <option value="<?php echo $p['id_prodi']; ?>" <?= old('prodi') == $p['id_prodi'] ? 'selected' : null ?>>
                                                <?php echo $p['prodi']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('id_prodi'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-control <?= (validation_show_error('id_dosen')) ? 'is-invalid' : ''; ?>" id="id_dosen" name="id_dosen">
                                        <option value="">Pilih Dosen Pengampu</option>
                                        <?php foreach ($dosen as $d) : ?>
                                            <option value="<?php echo $d['id_dosen']; ?>" <?= old('dosen') == $d['id_dosen'] ? 'selected' : null ?>>
                                                <?php echo $d['dosen']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('id_dosen'); ?>
                                    </div>
                                </div>
                            </div>
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
                        <label for="jumlah_mahasiswa">Jumlah Mahasiswa</label>
                        <input type="number" class="form-control <?= (validation_show_error('jumlah_mahasiswa')) ? 'is-invalid' : ''; ?>" id="jumlah_mahasiswa" name="jumlah_mahasiswa" value="<?= old('jumlah_mahasiswa'); ?>" placeholder="Jumlah Mahasiswa">
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