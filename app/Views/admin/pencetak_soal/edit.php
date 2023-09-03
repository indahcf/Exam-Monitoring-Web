<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Pencetak Soal</h4>
                <form action="<?= base_url('/admin/pencetak_soal/update/' . $pencetak_soal['id_user']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="pencetak_soal">Pencetak Soal</label>
                        <input type="text" class="form-control" id="pencetak_soal" name="pencetak_soal" value="<?= old('pencetak_soal', $pencetak_soal['pengawas']); ?>" placeholder="Pencetak Soal" readonly>
                    </div>
                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <select class="form-control <?= (validation_show_error('prodi')) ? 'is-invalid' : ''; ?>" id="prodi" name="prodi[]" placeholder="Pilih Program Studi" data-allow-clear="1" multiple>
                            <?php foreach ($prodi as $p) : ?>
                                <?php if ($p['prodi'] != 'Non Teknik') : ?>
                                    <option value="<?= $p['id_prodi']; ?>" <?= in_array($p['id_prodi'], old('prodi', $prodi_pencetak)) ? 'selected' : ''; ?>>
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

                <script>
                    $(document).ready(function() {
                        $('#prodi').each(function() {
                            $(this).select2({
                                theme: 'bootstrap4',
                                width: 'style',
                                placeholder: $(this).attr('placeholder'),
                                allowClear: Boolean($(this).data('allow-clear')),
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>