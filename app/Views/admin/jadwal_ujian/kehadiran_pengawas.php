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
                    <div id="ruangan" data-ruangan='<?= json_encode(old('ruang_ujian', $ruang_ujian)) ?>' data-pengawas1='<?= json_encode(old('pengawas1', $pengawas)) ?>' data-pengawas2='<?= json_encode(old('pengawas2', $pengawas)) ?>'>
                        <?php foreach ($ruang_ujian as $i => $r) : ?>
                            <div class="row mb-3">
                                <div class="col-sm-3">Ruang Ujian</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm"><?= $r['ruang_ujian']; ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">Jumlah Peserta</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm"><?= $jumlah_peserta[$i]; ?></div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">Pengawas 1</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm">
                                    <select class="form-control <?= (validation_show_error('pengawas1.0')) ? 'is-invalid' : ''; ?>" id="pengawas1_<?= $r['id_ruang_ujian'] ?>" name="pengawas1">
                                        <option value="">Pilih Pengawas</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?= validation_show_error('pengawas1.0'); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">Pengawas 2</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm">
                                    <select class="form-control" id="pengawas2_<?= $r['id_ruang_ujian'] ?>" name="pengawas2">
                                        <option value="">Pilih Pengawas</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-sm-3">Pengawas 3</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm">
                                    <select class="form-control" id="pengawas3" name="pengawas3">
                                        <option value="">Pilih Pengawas</option>
                                    </select>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>

                <script>
                    const pengawas1 = JSON.parse(
                        '<?= json_encode($pengawas) ?>'
                    )
                    // console.log(pengawas1)

                    const jadwal_ujian = JSON.parse(
                        '<?= json_encode($jadwal_ujian) ?>'
                    )
                    // console.log(jadwal_ujian)

                    $(document).ready(function() {
                        let old_ruangan = $('#ruangan').data('ruangan')
                        // console.log('old ruangan', old_ruangan)
                        let old_pengawas1 = $('#ruangan').data('pengawas1')
                        let old_pengawas2 = $('#ruangan').data('pengawas2')
                        console.log(old_pengawas2)
                        getPengawasTersedia()
                        getDosenPengawas3()
                        setTimeout(() => {
                            for (const i in old_ruangan) {
                                let id_ruangan = old_ruangan[i].id_ruang_ujian
                                // console.log(id_ruangan)
                                // console.log(old_pengawas1[id_ruangan]['Pengawas 1'])
                                $(`select[id=pengawas1_${id_ruangan}]`).val(old_pengawas1[id_ruangan]['Pengawas 1'])
                                $(`select[id=pengawas2_${id_ruangan}]`).val(old_pengawas2[id_ruangan]['Pengawas 2'])
                            }
                        }, 1000);
                        // console.log(old_pengawas1);
                        // console.log(old_pengawas2);
                    })

                    function getPengawasTersedia() {
                        let tanggal = jadwal_ujian.tanggal;
                        let jam_mulai = jadwal_ujian.jam_mulai;
                        let jam_selesai = jadwal_ujian.jam_selesai;
                        let id_jadwal_ujian = jadwal_ujian.id_jadwal_ujian;
                        if (tanggal != null && jam_mulai != null && jam_selesai != null) {
                            // console.log('tanggal', tanggal)
                            // console.log('jam mulai', jam_mulai)
                            // console.log('jam selesai', jam_selesai)
                            $.ajax({
                                url: window.location.origin + '/api/pengawas?tanggal=' + tanggal + '&jam_mulai=' + jam_mulai + '&jam_selesai=' + jam_selesai + '&id_jadwal_ujian=' + id_jadwal_ujian,
                                type: 'GET',
                                success: function(response) {
                                    // console.log('data pengawas', response)
                                    let options = `<option value="">Pilih Pengawas</option>`
                                    for (const data of response) {
                                        options += `<option value="${data.id_pengawas}">${data.pengawas}</option>`
                                    }
                                    $('select[name^=pengawas]').html(options)
                                }
                            })
                        }
                    }

                    function getDosenPengawas3() {
                        let id_kelas = jadwal_ujian.id_kelas;
                        let id_dosen = jadwal_ujian.id_dosen;
                        if (id_kelas !== '') {
                            // console.log('id kelas', id_kelas)
                            console.log('id dosen', id_dosen)
                            $.ajax({
                                url: window.location.origin + '/api/dosen?id_kelas=' + id_kelas,
                                type: 'GET',
                                success: function(response) {
                                    // console.log('data dosen', response)
                                    let options = `<option value="">Pilih Pengawas</option>`
                                    options += `<option value="${response.id_dosen}" ${id_dosen == response.id_dosen ? 'selected' : ''}>${response.dosen}</option>`
                                    $('select[name=pengawas3]').html(options)
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