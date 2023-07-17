<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Soal Ujian</h4>
                <form action="<?= base_url('/admin/soal_ujian/update/' . $soal_ujian['id_soal_ujian']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="periode_ujian">Periode Ujian</label>
                        <select class="form-control <?= (validation_show_error('periode_ujian')) ? 'is-invalid' : ''; ?>" id="periode_ujian" name="periode_ujian">
                            <option value="">Pilih Periode Ujian</option>
                            <option value="UTS" <?= (old('periode_ujian', $soal_ujian['periode_ujian']) == 'UTS') ? 'selected' : '' ?>>UTS</option>
                            <option value="UAS" <?= (old('periode_ujian', $soal_ujian['periode_ujian']) == 'UAS') ? 'selected' : '' ?>>UAS</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('periode_ujian'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <select class="form-control <?= (validation_show_error('prodi')) ? 'is-invalid' : ''; ?>" id="prodi" name="prodi">
                            <option value="">Pilih Program Studi</option>
                            <?php foreach ($prodi as $p) : ?>
                                <?php if ($p['prodi'] != 'Non Teknik') : ?>
                                    <option value="<?= $p['id_prodi']; ?>" <?= (old('id_prodi', $prodi_matkul) == $p['id_prodi']) ? 'selected' : ''; ?>>
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
                        <label for="matkul">Mata Kuliah</label>
                        <select class="form-control <?= (validation_show_error('matkul')) ? 'is-invalid' : ''; ?>" id="matkul" name="matkul" data-value="<?= old('matkul') ?>">
                            <option value="">Pilih Mata Kuliah</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('matkul'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control <?= (validation_show_error('kelas')) ? 'is-invalid' : ''; ?>" id="kelas" name="kelas[]" placeholder="Pilih Kelas" data-value="<?= json_encode(old('kelas', $soal_ujian['id_kelas'])) ?>" data-allow-clear="1" multiple>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('kelas'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dosen">Dosen</label>
                        <select class="form-control <?= (validation_show_error('dosen')) ? 'is-invalid' : ''; ?>" id="dosen" name="dosen" data-value="<?= old('dosen', $kelas['id_dosen']) ?>">
                            <option value="">Pilih Dosen</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('dosen'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="soal_ujian">Soal Ujian</label>
                        <input type="file" class="form-control-file <?= (validation_show_error('soal_ujian')) ? 'is-invalid' : ''; ?>" id="soal_ujian" name="soal_ujian" placeholder="Soal Ujian">
                        <div class="invalid-feedback">
                            <?= validation_show_error('soal_ujian'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="bentuk_soal">Bentuk Soal</label>
                        <select class="form-control <?= (validation_show_error('bentuk_soal')) ? 'is-invalid' : ''; ?>" id="bentuk_soal" name="bentuk_soal">
                            <option value="">Pilih Bentuk Soal</option>
                            <option value="Uraian" <?= (old('bentuk_soal', $soal_ujian['bentuk_soal']) == 'Uraian') ? 'selected' : '' ?>>Uraian</option>
                            <option value="Pilihan Ganda" <?= (old('bentuk_soal', $soal_ujian['bentuk_soal']) == 'Pilihan Ganda') ? 'selected' : '' ?>>Pilihan Ganda</option>
                            <option value="Uraian dan Pilihan Ganda" <?= (old('bentuk_soal', $soal_ujian['bentuk_soal']) == 'Uraian dan Pilihan Ganda') ? 'selected' : '' ?>>Uraian dan Pilihan Ganda</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('bentuk_soal'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="metode">Metode</label>
                        <select class="form-control <?= (validation_show_error('metode')) ? 'is-invalid' : ''; ?>" id="metode" name="metode">
                            <option value="">Pilih Metode</option>
                            <option value="Luring" <?= (old('metode', $soal_ujian['metode']) == 'Luring') ? 'selected' : '' ?>>Luring</option>
                            <option value="Daring" <?= (old('metode', $soal_ujian['metode']) == 'Daring') ? 'selected' : '' ?>>Daring</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('metode'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>

                <script>
                    $(document).ready(function() {
                        $('#kelas').each(function() {
                            $(this).select2({
                                theme: 'bootstrap4',
                                width: 'style',
                                placeholder: $(this).attr('placeholder'),
                                allowClear: Boolean($(this).data('allow-clear')),
                            });
                        });

                        let id_prodi = $('select[name=prodi]').val();
                        // console.log('prodi', id_prodi)
                        getMatkul(id_prodi)
                        let id_matkul = $('select[name=matkul]').val();
                        // console.log('matkul', id_matkul)
                        getKelas(id_matkul)
                        getDosen(id_matkul)
                    });

                    function getMatkul(id_prodi) {
                        if (id_prodi !== '') {
                            let id_matkul = $('select[name=matkul]').data('value');
                            $.ajax({
                                url: window.location.origin + '/api/matkul?id_prodi=' + id_prodi,
                                type: 'GET',
                                success: function(response) {
                                    let options = `<option value="">Pilih Mata Kuliah</option>`
                                    for (const data of response) {
                                        options += `<option value="${data.id_matkul}" ${id_matkul == data.id_matkul ? 'selected' : ''}>${data.kode_matkul} - ${data.matkul}</option>`
                                    }
                                    $('select[name=matkul]').html(options)
                                },
                            })
                        } else {
                            let options = `<option value="">Pilih Mata Kuliah</option>`
                            $('select[name=matkul]').html(options)
                            $('select[name^=kelas]').html('')
                        }
                    }

                    function getKelas(id_matkul) {
                        if (id_matkul !== '') {
                            let id_kelas = $('select[name=kelas]').data('value');
                            $.ajax({
                                url: window.location.origin + '/api/kelas?id_matkul=' + id_matkul,
                                type: 'GET',
                                success: function(response) {
                                    // console.log('data kelas', response)
                                    let options = ``
                                    for (const data of response) {
                                        options += `<option value="${data.id_kelas}" ${id_kelas == data.id_kelas ? 'selected' : ''}>${data.kelas}</option>`
                                    }
                                    $('select[name^=kelas]').html(options)
                                },
                            })
                        } else {
                            $('select[name^=kelas]').html('')
                        }
                    }

                    function getDosen(id_matkul) {
                        if (id_matkul !== '') {
                            let id_dosen = $('select[name=dosen]').data('value');
                            $.ajax({
                                url: window.location.origin + '/api/dosen?id_matkul=' + id_matkul,
                                type: 'GET',
                                success: function(response) {
                                    // console.log('data dosen', response)
                                    let options = `<option value="">Pilih Dosen</option>`
                                    for (const data of response) {
                                        options += `<option value="${data.id_dosen}" ${id_dosen == data.id_dosen ? 'selected' : ''}>${data.dosen}</option>`
                                    }
                                    $('select[name=dosen]').html(options)
                                },
                            })
                        } else {
                            let options = `<option value="">Pilih Dosen</option>`
                            $('select[name=dosen]').html(options)
                            $('select[name^=kelas]').html('')
                        }
                    }

                    $('select[name=prodi]').on('change', function() {
                        getMatkul(this.value)
                    })

                    $('select[name=matkul]').on('change', function() {
                        getKelas(this.value)
                        getDosen(this.value)
                    })
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>