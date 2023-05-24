<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Jadwal Ujian</h4>
                <form action="<?= base_url('/admin/jadwal_ujian/save') ?>" method="post" class="forms-sample">
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
                        <select class="form-control <?= (validation_show_error('kelas')) ? 'is-invalid' : ''; ?>" id="kelas" name="kelas" data-value="<?= old('kelas') ?>">
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('kelas'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dosen">Dosen</label>
                        <input type="text" class="form-control" id="dosen" name="dosen" value="" placeholder="Dosen" readonly>
                    </div>
                    <div class="form-group">
                        <label for="ruang_ujian">Ruang Ujian</label>
                        <select class="form-control <?= (validation_show_error('ruang_ujian')) ? 'is-invalid' : ''; ?>" id="ruang_ujian" name="ruang_ujian">
                            <option value="">Pilih Ruang Ujian</option>
                            <?php foreach ($ruang_ujian as $r) : ?>
                                <option value="<?= $r['id_ruang_ujian']; ?>" <?= old('ruang_ujian') == $r['id_ruang_ujian'] ? 'selected' : '' ?>>
                                    <?= $p['ruang_ujian']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('ruang_ujian'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="jumlah_peserta">Jumlah Peserta</label>
                        <input type="number" class="form-control <?= (validation_show_error('jumlah_peserta')) ? 'is-invalid' : ''; ?>" id="jumlah_peserta" name="jumlah_peserta" value="<?= old('jumlah_peserta'); ?>" placeholder="Jumlah Peserta">
                        <div class="invalid-feedback">
                            <?= validation_show_error('jumlah_peserta'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="waktu_ujian">Waktu Ujian</label>
                        <input type="datetime-local" class="form-control <?= (validation_show_error('waktu_ujian')) ? 'is-invalid' : ''; ?>" id="waktu_ujian" name="waktu_ujian" value="<?= old('waktu_ujian'); ?>" placeholder="Waktu Ujian">
                        <div class="invalid-feedback">
                            <?= validation_show_error('waktu_ujian'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                </form>

                <script>
                    $(document).ready(function() {
                        let id_prodi = $('select[name=prodi]').val();
                        let id_kelas = $('select[name=kelas]').val();
                        console.log('prodi', id_prodi)
                        console.log('kelas', id_prodi)
                        if (id_prodi !== '') {
                            getKelas(id_prodi)
                        }
                        if (id_kelas !== '') {
                            getDosen(id_kelas)
                        }

                    })

                    function getKelas(id_prodi) {
                        if (id_prodi !== '') {
                            let id_kelas = $('select[name=kelas]').data('value');
                            $.ajax({
                                url: window.location.origin + '/api/kelas/' + id_prodi,
                                type: 'GET',
                                success: function(response) {
                                    let options = `<option value="">Pilih Kelas</option>`
                                    for (const data of response) {
                                        options += `<option value="${data.id_kelas}" ${id_kelas == data.id_kelas ? 'selected' : ''}>${data.matkul} - ${data.kelas}</option>`
                                    }
                                    $('select[name=kelas]').html(options)
                                },
                            })
                        }

                    }

                    function getDosen(id_kelas) {
                        if (id_kelas !== '') {
                            let id_dosen = $('select[name=dosen]').data('value');
                            $.ajax({
                                url: window.location.origin + '/api/dosen/' + id_kelas,
                                type: 'GET',
                                success: function(response) {
                                    $('input[name=dosen]').val(response.data)
                                },
                            })
                        }

                    }

                    $('select[name=prodi]').on('change', function() {
                        getKelas(this.value)
                    })

                    $('select[name=kelas]').on('change', function() {
                        getDosen(this.value)
                    })
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>