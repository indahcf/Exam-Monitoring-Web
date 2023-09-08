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
                            <option value="">Pilih Kelas</option>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('kelas'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dosen">Dosen</label>
                        <input type="text" class="form-control" id="dosen" name="dosen" value="" data-value="<?= old('dosen') ?>" placeholder="Dosen" readonly>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control <?= (validation_show_error('tanggal')) ? 'is-invalid' : ''; ?>" id="tanggal" name="tanggal" value="<?= old('tanggal'); ?>" placeholder="Tanggal">
                        <div class="invalid-feedback">
                            <?= validation_show_error('tanggal'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row g-2">
                            <div class="col-md">
                                <div class="form-floating">
                                    <label for="jam_mulai">Jam Mulai</label>
                                    <input type="time" class="form-control <?= (validation_show_error('jam_mulai')) ? 'is-invalid' : ''; ?>" id="jam_mulai" name="jam_mulai" value="<?= old('jam_mulai'); ?>" placeholder="Jam Mulai">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('jam_mulai'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-floating">
                                    <label for="jam_selesai">Jam Selesai</label>
                                    <input type="time" class="form-control <?= (validation_show_error('jam_selesai')) ? 'is-invalid' : ''; ?>" id="jam_selesai" name="jam_selesai" value="<?= old('jam_selesai'); ?>" placeholder="Jam Selesai">
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('jam_selesai'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="koordinator_ujian">Koordinator Ujian</label>
                        <select class="form-control <?= (validation_show_error('koordinator_ujian')) ? 'is-invalid' : ''; ?>" id="koordinator_ujian" name="koordinator_ujian">
                            <option value="">Pilih Koordinator Ujian</option>
                            <?php foreach ($koordinator_ujian as $k) : ?>
                                <option value="<?= $k['id_dosen']; ?>" <?= old('koordinator_ujian') == $k['id_dosen'] ? 'selected' : '' ?>>
                                    <?= $k['dosen']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('koordinator_ujian'); ?>
                        </div>
                    </div>
                    <div id="ruangan" data-ruangan='<?= json_encode(old('ruang_ujian')) ?>' data-peserta='<?= json_encode(old('jumlah_peserta')) ?>' data-pengawas1='<?= json_encode(old('pengawas1')) ?>' data-pengawas2='<?= json_encode(old('pengawas2')) ?>'>
                        <div class="row fg_ruangan_peserta">
                            <div class="form-group col-md-3">
                                <label for="ruang_ujian">Ruang Ujian 1</label>
                                <select class="form-control <?= (validation_show_error('ruang_ujian.0')) ? 'is-invalid' : ''; ?>" id="ruang_ujian" name="ruang_ujian[]" required>
                                    <option value="">Pilih Ruang Ujian 1</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('ruang_ujian.0'); ?>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="jumlah_peserta">Jumlah Peserta Ruang Ujian 1</label>
                                <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta[]" placeholder="Jumlah Peserta Ruang Ujian 1" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="pengawas1">Pengawas 1 Ruang Ujian 1</label>
                                <select class="form-control <?= (validation_show_error('pengawas1.0')) ? 'is-invalid' : ''; ?>" id="pengawas1" name="pengawas1[]" required>
                                    <option value="">Pilih Pengawas 1 Ruang Ujian 1</option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('pengawas1.0'); ?>
                                </div>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="pengawas2">Pengawas 2 Ruang Ujian 1</label>
                                <select class="form-control" id="pengawas2" name="pengawas2[]">
                                    <option value="">Pilih Pengawas 2 Ruang Ujian 1</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Simpan</button>
                </form>

                <script>
                    $(document).ready(function() {
                        let id_prodi = $('select[name=prodi]').val();
                        let old_ruangan = $('#ruangan').data('ruangan')
                        let old_peserta = $('#ruangan').data('peserta')
                        let old_pengawas1 = $('#ruangan').data('pengawas1')
                        let old_pengawas2 = $('#ruangan').data('pengawas2')
                        getRuanganTersedia()
                        getPengawasTersedia()
                        // console.log('prodi', id_prodi)
                        getKelas(id_prodi)
                        setTimeout(() => {
                            let id_kelas = $('select[name=kelas]').val();
                            // console.log('kelas', id_kelas)
                            getDosen(id_kelas)
                            for (const i in old_ruangan) {
                                let fg_ruangan_peserta = $('.fg_ruangan_peserta').first().clone()
                                if (i == 0) {
                                    $('.fg_ruangan_peserta').remove()
                                }
                                console.log(old_ruangan[i]);
                                console.log(old_peserta[i]);
                                fg_ruangan_peserta.find('select[name^=ruang_ujian]').val(old_ruangan[i])
                                fg_ruangan_peserta.find('input[name^=jumlah_peserta]').val(old_peserta[i])
                                fg_ruangan_peserta.find('select[name^=pengawas1]').val(old_pengawas1[i])
                                fg_ruangan_peserta.find('select[name^=pengawas2]').val(old_pengawas2[i])
                                $('#ruangan').append(fg_ruangan_peserta)
                            }
                            handleRuangan()
                        }, 1000);
                    })

                    function getKelas(id_prodi) {
                        if (id_prodi !== '') {
                            let id_kelas = $('select[name=kelas]').data('value');
                            $.ajax({
                                url: "<?= base_url(); ?>" + '/api/kelas?id_prodi=' + id_prodi,
                                type: 'GET',
                                success: function(response) {
                                    // console.log('data kelas', response)
                                    let options = `<option value="">Pilih Kelas</option>`
                                    for (const data of response) {
                                        options += `<option value="${data.id_kelas}" ${id_kelas == data.id_kelas ? 'selected' : ''} data-peserta="${data.jumlah_mahasiswa}">${data.matkul} - ${data.kelas} (${data.jumlah_mahasiswa} mhs)</option>`
                                    }
                                    $('select[name=kelas]').html(options)
                                },
                            })
                        } else {
                            let options = `<option value="">Pilih Kelas</option>`
                            $('select[name=kelas]').html(options)
                            $('input[name=dosen]').val('')
                        }
                    }

                    function getDosen(id_kelas) {
                        if (id_kelas !== '') {
                            let id_dosen = $('input[name=dosen]').data('value');
                            $.ajax({
                                url: "<?= base_url(); ?>" + '/api/dosen?id_kelas=' + id_kelas,
                                type: 'GET',
                                success: function(response) {
                                    // console.log('data dosen', response)
                                    $('input[name=dosen]').val(response.dosen)
                                },
                            })
                        } else {
                            $('input[name=dosen]').val('')
                        }
                    }

                    $('select[name=prodi]').on('change', function() {
                        getKelas(this.value)
                    })

                    $('select[name=kelas]').on('change', function() {
                        getDosen(this.value)

                        // reset select ruangan 
                        let fg_ruangan_peserta = $('.fg_ruangan_peserta').first().clone()
                        fg_ruangan_peserta.find('input[name^=jumlah_peserta]').val('')
                        $('.fg_ruangan_peserta').remove()
                        $('#ruangan').append(fg_ruangan_peserta)
                    })

                    function getTotalKapasitas() {
                        let total = 0
                        $('select[name^=ruang_ujian]').each(function(index, el) {
                            let kapasitas = $(el).children('option:selected').data('kapasitas')
                            if (kapasitas != undefined) {
                                total += kapasitas
                            }
                        })
                        return total
                    }

                    function getEmptySelect() {
                        let total = 0
                        $('select[name^=ruang_ujian]').each(function(index, el) {
                            let kapasitas = $(el).children('option:selected').data('kapasitas')
                            if (kapasitas == undefined) {
                                total++
                            }
                        })
                        return total
                    }

                    function handleRuangan() {
                        // total mahasiswa dari kelas yg dipilih 
                        let peserta_kelas = $('select[name=kelas]').children('option:selected').data('peserta')

                        // total kapasitas ruangan ujian yg dipilih 
                        let total_kapasitas = getTotalKapasitas()

                        // total select ruangan yg belum dipilih 
                        let select_ruangan_kosong = getEmptySelect()

                        if (total_kapasitas < peserta_kelas && select_ruangan_kosong == 0) {
                            // tambah ruangan 
                            let fg_ruangan_peserta = $('.fg_ruangan_peserta').first().clone()
                            fg_ruangan_peserta.find('input[select^=ruang_ujian]').val('')
                            fg_ruangan_peserta.find('input[name^=jumlah_peserta]').val('')
                            $('#ruangan').append(fg_ruangan_peserta)
                        } else {
                            // hapus ruangan yg tidak terpakai 
                            let total = 0
                            $('select[name^=ruang_ujian]').each(function(index, el) {
                                let kapasitas = $(el).children('option:selected').data('kapasitas')
                                if (kapasitas != undefined) {
                                    total += kapasitas
                                    if (total >= peserta_kelas) {
                                        $(el).closest('.fg_ruangan_peserta').nextAll().remove()
                                    }
                                }
                            })
                        }

                        // ubah label 
                        $('.fg_ruangan_peserta').each(function(index, el) {
                            $(el).find('select[name^=ruang_ujian]').prev().text(`Ruang Ujian ${index+1}`)
                            $(el).find('input[name^=jumlah_peserta]').prev().text(`Jumlah Peserta Ruang Ujian ${index+1}`)
                            $(el).find('select[name^=pengawas1]').prev().text(`Pengawas 1 Ruang Ujian ${index+1}`)
                            $(el).find('select[name^=pengawas2]').prev().text(`Pengawas 2 Ruang Ujian ${index+1}`)
                            $(el).find('select[name^=ruang_ujian]').children('option:first').text(`Pilih Ruang Ujian ${index+1}`)
                            $(el).find('input[name^=jumlah_peserta]').attr('placeholder', `Jumlah Peserta Ruang Ujian ${index+1}`)
                            $(el).find('select[name^=pengawas1]').children('option:first').text(`Pilih Pengawas 1 Ruang Ujian ${index+1}`)
                            $(el).find('select[name^=pengawas2]').children('option:first').text(`Pilih Pengawas 2 Ruang Ujian ${index+1}`)
                        })

                        // set input jumlah peserta 
                        let total2 = 0

                        total_kapasitas = getTotalKapasitas()

                        $('select[name^=ruang_ujian]').each(function(index, el) {
                            let kapasitas = $(el).children('option:selected').data('kapasitas')
                            if (kapasitas === undefined) {
                                kapasitas = 0
                            }
                            total2 += kapasitas
                            if (total2 >= peserta_kelas) {
                                // jika total semua kapasitas ruangan yg dipilih >= peserta kelas
                                // jumlah peserta = sisa peserta
                                $(el).closest('.fg_ruangan_peserta').find('input[name^=jumlah_peserta]').val(kapasitas - (total_kapasitas - peserta_kelas))
                            } else {
                                // jumlah peserta = kapasitas ruangan
                                $(el).closest('.fg_ruangan_peserta').find('input[name^=jumlah_peserta]').val(kapasitas)
                            }
                        })

                        console.log('peserta kelas', peserta_kelas)
                        console.log('total kapasitas', total_kapasitas)
                        console.log('belum punya ruangan', peserta_kelas - total_kapasitas)
                    }

                    $('body').on('change', 'select[name^=ruang_ujian]', function() {
                        handleRuangan()
                        ruanganIsDuplicate()
                    })

                    $('body').on('change', 'select[name^=pengawas1],select[name^=pengawas2]', function() {
                        pengawasIsDuplicate()
                    })

                    function getRuanganTersedia() {
                        let tanggal = $('input[name=tanggal]').val();
                        let jam_mulai = $('input[name=jam_mulai]').val();
                        let jam_selesai = $('input[name=jam_selesai]').val();
                        if (tanggal != null && jam_mulai != null && jam_selesai != null) {
                            console.log('tanggal', tanggal)
                            console.log('jam mulai', jam_mulai)
                            console.log('jam selesai', jam_selesai)
                            $.ajax({
                                url: "<?= base_url(); ?>" + '/api/ruang_ujian?tanggal=' + tanggal + '&jam_mulai=' + jam_mulai + '&jam_selesai=' + jam_selesai,
                                type: 'GET',
                                success: function(response) {
                                    console.log('data ruang', response)
                                    let options = `<option value="">Pilih Ruang Ujian</option>`
                                    for (const data of response) {
                                        options += `<option value="${data.id_ruang_ujian}" data-kapasitas="${data.kapasitas}">${data.ruang_ujian} (kapasitas: ${data.kapasitas})</option>`
                                    }
                                    $('select[name^=ruang_ujian]').html(options)
                                }
                            })
                        }
                    }

                    function getPengawasTersedia() {
                        let tanggal = $('input[name=tanggal]').val();
                        let jam_mulai = $('input[name=jam_mulai]').val();
                        let jam_selesai = $('input[name=jam_selesai]').val();
                        if (tanggal != null && jam_mulai != null && jam_selesai != null) {
                            console.log('tanggal', tanggal)
                            console.log('jam mulai', jam_mulai)
                            console.log('jam selesai', jam_selesai)
                            $.ajax({
                                url: "<?= base_url(); ?>" + '/api/pengawas?tanggal=' + tanggal + '&jam_mulai=' + jam_mulai + '&jam_selesai=' + jam_selesai,
                                type: 'GET',
                                success: function(response) {
                                    console.log('data pengawas', response)
                                    let options = `<option value="">Pilih Pengawas</option>`
                                    for (const data of response) {
                                        options += `<option value="${data.id_pengawas}">${data.pengawas}</option>`
                                    }
                                    $('select[name^=pengawas]').html(options)
                                }
                            })
                        }
                    }

                    $('input[name=tanggal]').on('change', function() {
                        getRuanganTersedia()
                        getPengawasTersedia()

                        // reset select ruangan 
                        let fg_ruangan_peserta = $('.fg_ruangan_peserta').first().clone()
                        fg_ruangan_peserta.find('input[name^=jumlah_peserta]').val('')
                        $('.fg_ruangan_peserta').remove()
                        $('#ruangan').append(fg_ruangan_peserta)
                    })

                    $('input[name=jam_mulai]').on('change', function() {
                        getRuanganTersedia()
                        getPengawasTersedia()

                        // reset select ruangan 
                        let fg_ruangan_peserta = $('.fg_ruangan_peserta').first().clone()
                        fg_ruangan_peserta.find('input[name^=jumlah_peserta]').val('')
                        $('.fg_ruangan_peserta').remove()
                        $('#ruangan').append(fg_ruangan_peserta)
                    })

                    $('input[name=jam_selesai]').on('change', function() {
                        getRuanganTersedia()
                        getPengawasTersedia()

                        // reset select ruangan 
                        let fg_ruangan_peserta = $('.fg_ruangan_peserta').first().clone()
                        fg_ruangan_peserta.find('input[name^=jumlah_peserta]').val('')
                        $('.fg_ruangan_peserta').remove()
                        $('#ruangan').append(fg_ruangan_peserta)
                    })

                    function ruanganIsDuplicate() {
                        let ruangans = []
                        $('select[name^=ruang_ujian]').each(function() {
                            let selectedValue = $(this).val()
                            if (selectedValue != '') {
                                ruangans.push(selectedValue)
                            }
                        })

                        console.log('ruangan', ruangans)

                        let isDuplicate = new Set(ruangans).size !== ruangans.length
                        console.log('ruanganIsDuplicate', isDuplicate)

                        if (isDuplicate) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Oopss...',
                                text: "Ruang Ujian yang Dipilih Ada yang Sama.",
                                showConfirmButton: true
                            })
                        }

                        return isDuplicate
                    }

                    function pengawasIsDuplicate() {
                        let pengawas1 = []
                        let pengawas2 = []
                        $('select[name^=pengawas1]').each(function() {
                            let selectedValue = $(this).val()
                            if (selectedValue != '') {
                                pengawas1.push(selectedValue)
                            }
                        })

                        $('select[name^=pengawas2]').each(function() {
                            let selectedValue = $(this).val()
                            if (selectedValue != '') {
                                pengawas2.push(selectedValue)
                            }
                        })

                        let gabunganPengawas = pengawas1.concat(pengawas2)
                        let isDuplicate = new Set(gabunganPengawas).size !== gabunganPengawas.length
                        console.log('gabunganPengawas', gabunganPengawas)
                        console.log('pengawasIsDuplicate', isDuplicate)

                        if (isDuplicate) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Oopss...',
                                text: "Pengawas yang Dipilih Ada yang Sama.",
                                showConfirmButton: true
                            })
                        }

                        return isDuplicate
                    }
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>