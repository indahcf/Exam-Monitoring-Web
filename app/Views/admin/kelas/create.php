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
                        <label for="prodi">Program Studi</label>
                        <select class="form-control <?= (validation_show_error('prodi')) ? 'is-invalid' : ''; ?>" id="prodi" name="prodi">
                            <option value="">Pilih Program Studi</option>
                            <?php foreach ($prodi as $p) : ?>
                                <?php if ($p['prodi'] != 'Non Teknik') : ?>
                                    <option value="<?php echo $p['id_prodi']; ?>" <?= old('id_prodi') == $p['id_prodi'] ? 'selected' : null ?>>
                                        <?php echo $p['prodi']; ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('prodi'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="matkul">Mata Kuliah</label>
                        <select class="form-control <?= (validation_show_error('matkul')) ? 'is-invalid' : ''; ?>" id="matkul" name="matkul">
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('matkul'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="id_prodi">Dosen</label>
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-control <?= (validation_show_error('asal_dosen')) ? 'is-invalid' : ''; ?>" id="asal_dosen" name="asal_dosen">
                                        <option value="">Pilih Asal Dosen</option>
                                        <?php foreach ($prodi as $p) : ?>
                                            <option value="<?php echo $p['id_prodi']; ?>" <?= old('id_prodi') == $p['id_prodi'] ? 'selected' : null ?>>
                                                <?php echo $p['prodi']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('asal_dosen'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <select class="form-control <?= (validation_show_error('dosen')) ? 'is-invalid' : ''; ?>" id="dosen" name="dosen">
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('dosen'); ?>
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

                <script>
                    $('select[name=prodi]').on('change', function() {
                        let id = this.value
                        $.ajax({
                            url: window.location.origin + '/api/matkul/' + id,
                            type: 'GET',
                            success: function(response) {
                                let options = `<option value="">Pilih Mata Kuliah</option>`
                                for (const data of response) {
                                    options += `<option value="${data.id_matkul}">${data.kode_matkul} - ${data.matkul}</option>`
                                }
                                $('select[name=matkul]').html(options)
                            },
                        })
                    })
                </script>

                <script>
                    $('select[name=asal_dosen]').on('change', function() {
                        let id = this.value
                        $.ajax({
                            url: window.location.origin + '/api/dosen/' + id,
                            type: 'GET',
                            success: function(response) {
                                let options = `<option value="">Pilih Dosen Pengampu</option>`
                                for (const data of response) {
                                    options += `<option value="${data.id_dosen}">${data.dosen}</option>`
                                }
                                $('select[name=dosen]').html(options)
                            },
                        })
                    })
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>