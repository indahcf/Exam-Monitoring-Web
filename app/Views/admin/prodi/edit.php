<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Program Studi</h4>
                <form action="<?= base_url('/admin/prodi/update/' . $prodi['id_prodi']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <!-- <input type="hidden" name="id_prodi" value="<?= $prodi['id_prodi']; ?>"> -->
                    <div class="form-group">
                        <label for="prodi">Nama Program Studi</label>
                        <input type="text" class="form-control <?= (validation_show_error('prodi')) ? 'is-invalid' : ''; ?>" id="prodi" name="prodi" value="<?= old('prodi', $prodi['prodi']); ?>" placeholder="Nama Program Studi">
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