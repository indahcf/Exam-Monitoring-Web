<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data Kehadiran Pengawas</h4>
                <form action="<?= base_url('/admin/jadwal_ujian/update_kehadiran_pengawas/' . $jadwal_ujian['id_jadwal_ujian']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <div class="row mb-3">
                        <div class="col-sm-3">Hari</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= hari($jadwal_ujian['tanggal']); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Tanggal</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= date('d-m-Y', strtotime($jadwal_ujian['tanggal'])); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Jam</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= date('H.i', strtotime($jadwal_ujian['jam_mulai'])); ?> - <?= date('H.i', strtotime($jadwal_ujian['jam_selesai'])); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Kode Mata Kuliah</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $jadwal_ujian['kode_matkul']; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Mata Kuliah</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $jadwal_ujian['matkul']; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Program Studi</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $jadwal_ujian['prodi']; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Dosen</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $jadwal_ujian['dosen']; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Kelas</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $jadwal_ujian['kelas']; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Koordinator Ujian</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $jadwal_ujian['nama_koordinator']; ?></div>
                    </div>
                    <div id="ruangan" data-pengawas1='<?= json_encode(old('pengawas1', $pengawas)) ?>' data-pengawas2='<?= json_encode(old('pengawas2', $pengawas)) ?>'>
                        <?php foreach ($ruang_ujian as $i => $r) : ?>
                            <div class="row fg_ruangan_peserta">
                                <div class="form-group col-md-3">
                                    <label for="ruang_ujian">Ruang Ujian 1</label>
                                    <input type="text" class="form-control" id="ruang_ujian" name="ruang_ujian" value="<?= $r; ?>" placeholder="Ruang Ujian 1" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="jumlah_peserta">Jumlah Peserta Ruang Ujian 1</label>
                                    <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta" value="<?= $jumlah_peserta[$i]; ?>" placeholder="Jumlah Peserta Ruang Ujian 1" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="pengawas1">Pengawas 1 Ruang Ujian 1</label>
                                    <select class="form-control <?= (validation_show_error('pengawas1.0')) ? 'is-invalid' : ''; ?>" id="pengawas1" name="pengawas1[]">
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
                        <?php endforeach; ?>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>

                <script>
                    $(document).ready(function() {
                        let old_pengawas1 = $('#ruangan').data('pengawas1')
                        let old_pengawas2 = $('#ruangan').data('pengawas2')
                        getPengawasTersedia()
                        setTimeout(() => {
                            for (const i in old_ruangan) {
                                let fg_ruangan_peserta = $('.fg_ruangan_peserta').first().clone()
                                let id_ruangan = old_ruangan[i]
                                if (i == 0) {
                                    $('.fg_ruangan_peserta').remove()
                                }
                                console.log(old_ruangan[i]);
                                console.log(old_peserta[i]);
                                fg_ruangan_peserta.find('select[name^=pengawas1]').val(old_pengawas1[id_ruangan]['Pengawas 1'])
                                fg_ruangan_peserta.find('select[name^=pengawas2]').val(old_pengawas2[id_ruangan]['Pengawas 2'])
                                $('#ruangan').append(fg_ruangan_peserta)
                            }
                            handleRuangan()
                        }, 1000);
                        console.log(old_pengawas1);
                        // console.log(old_pengawas2);
                    })

                    function handleRuangan() {
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
                    }

                    function getPengawasTersedia() {
                        let tanggal = $('input[name=tanggal]').val();
                        let jam_mulai = $('input[name=jam_mulai]').val();
                        let jam_selesai = $('input[name=jam_selesai]').val();
                        let id_jadwal_ujian = $('input[name=id_jadwal_ujian]').val();
                        if (tanggal != null && jam_mulai != null && jam_selesai != null) {
                            console.log('tanggal', tanggal)
                            console.log('jam mulai', jam_mulai)
                            console.log('jam selesai', jam_selesai)
                            $.ajax({
                                url: window.location.origin + '/api/pengawas?tanggal=' + tanggal + '&jam_mulai=' + jam_mulai + '&jam_selesai=' + jam_selesai + '&id_jadwal_ujian=' + id_jadwal_ujian,
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
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>