<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Dosen</h4>
                <form action="<?= base_url('/admin/dosen/update/' . $dosen['id_dosen']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <!-- <input type="hidden" name="id_dosen" value="<?= $dosen['id_dosen']; ?>"> -->
                    <div class="form-group">
                        <label for="nidn">NIDN</label>
                        <input type="text" class="form-control <?= (validation_show_error('nidn')) ? 'is-invalid' : ''; ?>" id="nidn" name="nidn" value="<?= old('nidn', $dosen['nidn']); ?>" placeholder="NIDN">
                        <div class="invalid-feedback">
                            <?= validation_show_error('nidn'); ?>
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
                        <label for="prodi">Program Studi</label>
                        <select class="form-control <?= (validation_show_error('prodi')) ? 'is-invalid' : ''; ?>" id="prodi" name="prodi">
                            <option value="">Pilih Program Studi</option>
                            <?php foreach ($prodi as $p) : ?>
                                <option value="<?= $p['id_prodi']; ?>" <?= (old('prodi', $dosen['id_prodi']) == $p['id_prodi']) ? 'selected' : ''; ?>>
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