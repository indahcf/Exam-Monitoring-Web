<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Soal Ujian</h4>
                <form action="<?= base_url('/admin/soal_ujian/save') ?>" method="post" class="forms-sample">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <select class="form-control <?= (validation_show_error('prodi')) ? 'is-invalid' : ''; ?>" id="prodi" name="prodi">
                            <option value="">Pilih Program Studi</option>
                            <?php foreach ($prodi as $p) : ?>
                                <?php if ($p['prodi'] != 'Non Teknik') : ?>
                                    <option value="<?= $p['id_prodi']; ?>" <?= old('prodi') == $p['id_prodi'] ? 'selected' : '' ?>>
                                        <?= $p['prodi']; ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('prodi'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control js-example-basic-multiple <?= (validation_show_error('kelas')) ? 'is-invalid' : ''; ?>" id="kelas" name="kelas[]" placeholder="Pilih Kelas" data-value="<?= old('kelas') ?>" multiple>
                            <!-- <option value="">Pilih Kelas</option> -->
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('kelas'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dosen">Dosen</label>
                        <select class="form-control <?= (validation_show_error('dosen')) ? 'is-invalid' : ''; ?>" id="dosen" name="dosen" data-value="<?= old('dosen') ?>">
                            <option value="">Pilih Dosen</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('dosen'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="soal_ujian">Soal Ujian</label>
                        <input type="file" class="form-control-file <?= (validation_show_error('soal_ujian')) ? 'is-invalid' : ''; ?>" id="soal_ujian" name="soal_ujian" value="<?= old('soal_ujian'); ?>" placeholder="Soal Ujian">
                        <div class="invalid-feedback">
                            <?= validation_show_error('soal_ujian'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="periode_ujian">Periode Ujian</label>
                        <select class="form-control <?= (validation_show_error('periode_ujian')) ? 'is-invalid' : ''; ?>" id="periode_ujian" name="periode_ujian">
                            <option value="">Pilih Periode Ujian</option>
                            <option value="UTS" <?= old('periode_ujian') == 'UTS' ? 'selected' : '';  ?>>UTS</option>
                            <option value="UAS" <?= old('periode_ujian') == 'UAS' ? 'selected' : '';  ?>>UAS</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('periode_ujian'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bentuk_soal">Bentuk Soal</label>
                        <select class="form-control <?= (validation_show_error('bentuk_soal')) ? 'is-invalid' : ''; ?>" id="bentuk_soal" name="bentuk_soal">
                            <option value="">Pilih Bentuk Soal</option>
                            <option value="Uraian" <?= old('bentuk_soal') == 'Uraian' ? 'selected' : '';  ?>>Uraian</option>
                            <option value="Pilihan Ganda" <?= old('bentuk_soal') == 'Pilihan Ganda' ? 'selected' : '';  ?>>Pilihan Ganda</option>
                            <option value="Uraian dan Pilihan Ganda" <?= old('bentuk_soal') == 'Uraian dan Pilihan Ganda' ? 'selected' : '';  ?>>Uraian dan Pilihan Ganda</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('bentuk_soal'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="metode">Metode</label>
                        <select class="form-control <?= (validation_show_error('metode')) ? 'is-invalid' : ''; ?>" id="metode" name="metode">
                            <option value="">Pilih Metode</option>
                            <option value="Luring" <?= old('metode') == 'Luring' ? 'selected' : '';  ?>>Luring</option>
                            <option value="Daring" <?= old('metode') == 'Daring' ? 'selected' : '';  ?>>Daring</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('metode'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                </form>

                <script>
                    $(document).ready(function() {
                        $('.js-example-basic-multiple').select2({
                            ajax: {
                                url: "<?= base_url('SoalUjian/getDataMultipleSelect') ?>"
                            },
                            placeholder: 'Pilih Kelas',
                            templateResult: format,
                            templateSelection: formatSelection
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>