<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Pencetak Soal</h4>
                <form action="<?= base_url('/admin/pencetak_soal/update/' . $data_pencetak['id_pencetak_soal']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <!-- <input type="hidden" name="id_pencetak_soal" value="<?= $data_pencetak['id_pencetak_soal']; ?>"> -->
                    <div class="form-group">
                        <label for="pencetak_soal">Pencetak Soal</label>
                        <select class="form-control <?= (validation_show_error('pencetak_soal')) ? 'is-invalid' : ''; ?>" id="pencetak_soal" name="pencetak_soal">
                            <option value="">Pilih Pencetak Soal</option>
                            <?php foreach ($pencetak_soal as $p) : ?>
                                <option value="<?= $p['id_user']; ?>" <?= (old('pencetak_soal', $data_pencetak['id_user']) == $p['id_user']) ? 'selected' : ''; ?>>
                                    <?= $p['pengawas']; ?>
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
                                <option value="<?= $p['id_prodi']; ?>" <?= (old('prodi', $data_pencetak['id_prodi']) == $p['id_prodi']) ? 'selected' : ''; ?>>
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