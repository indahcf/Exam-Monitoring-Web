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
                    <!-- <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <select class="form-control <?= (validation_show_error('kelas')) ? 'is-invalid' : ''; ?>" id="kelas" name="kelas" data-value="<?= old('kelas') ?>">
                            <option value="">Pilih Kelas</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('kelas'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dosen">Dosen</label>
                        <input type="text" class="form-control" id="dosen" name="dosen" value="" data-value="<?= old('dosen') ?>" placeholder="Dosen" readonly>
                    </div> -->
                    <div class="form-group">
                        <label for="soal_ujian">Soal Ujian</label>
                        <input type="file" class="form-control <?= (validation_show_error('soal_ujian')) ? 'is-invalid' : ''; ?>" id="soal_ujian" name="soal_ujian" value="<?= old('soal_ujian'); ?>" placeholder="Soal Ujian">
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
                        let id_prodi = $('select[name=prodi]').val();
                        console.log('prodi', id_prodi)
                        getKelas(id_prodi)
                        setTimeout(() => {
                            let id_kelas = $('select[name=kelas]').val();
                            // console.log('kelas', id_kelas)
                            getDosen(id_kelas)
                        }, 1000);
                    })

                    function getKelas(id_prodi) {
                        if (id_prodi !== '') {
                            let id_kelas = $('select[name=kelas]').data('value');
                            $.ajax({
                                url: window.location.origin + '/api/kelas?id_prodi=' + id_prodi,
                                type: 'GET',
                                success: function(response) {
                                    // console.log('data kelas', response)
                                    let options = `<option value="">Pilih Kelas</option>`
                                    for (const data of response) {
                                        options += `<option value="${data.id_kelas}" data-peserta="${data.jumlah_mahasiswa}" ${id_kelas == data.id_kelas ? 'selected' : ''}>${data.matkul} - ${data.kelas}</option>`
                                    }
                                    $('select[name=kelas]').html(options)
                                },
                            })
                        }

                    }

                    function getDosen(id_kelas) {
                        if (id_kelas !== '') {
                            let id_dosen = $('input[name=dosen]').data('value');
                            $.ajax({
                                url: window.location.origin + '/api/dosen?id_kelas=' + id_kelas,
                                type: 'GET',
                                success: function(response) {
                                    // console.log('data dosen', response)
                                    $('input[name=dosen]').val(response.dosen)
                                },
                            })
                        }
                    }

                    function getPesertaKelas() {
                        let peserta_kelas = $('select[name=kelas]').children('option:selected').data('peserta');
                        console.log('peserta_kelas', peserta_kelas);
                        $('input[name^=jumlah_peserta]').val(peserta_kelas);
                    }

                    function setRuangan(el) {
                        let peserta_kelas = $('select[name=kelas]').children('option:selected').data('peserta');
                        let kapasitas_ruangan = el.children('option:selected').data('kapasitas');
                        let sisa_peserta = peserta_kelas - kapasitas_ruangan;
                        console.log('peserta_kelas', peserta_kelas);
                        console.log('kapasitas_ruangan', kapasitas_ruangan);
                        console.log('sisa_peserta', sisa_peserta);
                        if (peserta_kelas <= kapasitas_ruangan) {
                            $('input[name^=jumlah_peserta]').val(peserta_kelas);
                        } else {
                            $('input[name^=jumlah_peserta]').val(kapasitas_ruangan);
                            $('.fg_ruangan_peserta').clone().appendTo('#ruangan')
                        }

                        // $('input[name^=jumlah_peserta]').val(sisa_peserta);
                        // if (sisa_peserta > 0) {
                        //     $('input[name^=jumlah_peserta]').val(kapasitas_ruangan);
                        // } else {
                        //     $('input[name^=jumlah_peserta]').val(peserta_kelas);
                        // }
                    }

                    // function getSisaPeserta(el) {
                    //     let peserta_kelas = $('select[name=kelas]').children('option:selected').data('peserta');
                    //     let kapasitas_ruangan = $('select[name^=ruang_ujian]').children('option:selected').data('kapasitas');
                    //     let sisa_peserta = peserta_kelas - kapasitas_ruangan;
                    //     console.log('sisa_peserta', sisa_peserta);
                    //     $('input[name^=jumlah_peserta]').val(sisa_peserta);
                    //     $('.fg_ruangan_peserta').clone().appendTo('#ruangan')
                    //     if (sisa_peserta > 0) {
                    //         $('input[name^=jumlah_peserta]').val(kapasitas_ruangan);
                    //     } else {
                    //         $('input[name^=jumlah_peserta]').val(peserta_kelas);
                    //     }
                    // }

                    $('select[name=prodi]').on('change', function() {
                        getKelas(this.value)
                    })

                    $('select[name=kelas]').on('change', function() {
                        getDosen(this.value)
                        getPesertaKelas()
                    })

                    $('select[name^=ruang_ujian]').on('change', function() {
                        setRuangan($(this))
                        // getKapasitasRuangan($(this))
                        // getSisaPeserta($(this))
                        // console.log(this);
                        console.log($(this))
                    })

                    // $('select[name=ruang_ujian]').clone().appendTo('#ruangan')
                    // $('select[name=jumlah_peserta]').on('change', function() {
                    //     getSisaPeserta()
                    // })
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>