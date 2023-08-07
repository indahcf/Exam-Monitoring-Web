<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Rekap Data Kehadiran Peserta</h4>
                <form action="<?= base_url('/admin/kehadiran_peserta/save/' . $id_jadwal_ujian . '/' . $id_jadwal_ruang); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_jadwal_ruang" value="<?= $id_jadwal_ruang; ?>">
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
                            <div class="col-sm"><?= $pengawas ? $pengawas['nama_pengawas1'] : ''; ?></div>
                        </div>
                        <?php if ($pengawas && $pengawas['nama_pengawas2']) : ?>
                            <div class="row mb-3">
                                <div class="col-sm-3">Pengawas 2</div>
                                <div class="d-none d-sm-inline">:</div>
                                <div class="col-sm"><?= $pengawas['nama_pengawas2']; ?></div>
                            </div>
                        <?php endif; ?>
                        <div class="row mb-3">
                            <div class="col-sm-3"><?= $pengawas && $pengawas['nama_pengawas2'] ? 'Pengawas 3' : 'Pengawas 2' ?></div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <select class="form-control" id="pengawas3" name="pengawas3">
                                    <option value="">Pilih Pengawas</option>
                                    <option value="<?= $pengawas3['id_dosen']; ?>" <?= (old('pengawas3', $pengawas3['id_dosen']) == $pengawas3['id_dosen']) ? 'selected' : ''; ?>>
                                        <?= $pengawas3['dosen']; ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">Total Hadir</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <input type="number" class="form-control <?= (validation_show_error('hadir')) ? 'is-invalid' : ''; ?>" id="hadir" name="hadir" value="<?= old('hadir', $kehadiran_peserta ? $kehadiran_peserta['total_hadir'] : ''); ?>" placeholder="Total Hadir">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('hadir'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">Sakit</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <input type="number" class="form-control" id="sakit" name="sakit" value="<?= old('sakit', $kehadiran_peserta ? $kehadiran_peserta['sakit'] : ''); ?>" placeholder="Sakit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">NIM Sakit</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <select class="form-control select-tag" multiple="multiple" id="nim_sakit" name="nim_sakit" value="<?= old('nim_sakit', $kehadiran_peserta ? $kehadiran_peserta['nim_sakit'] : ''); ?>">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">Izin</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <input type="number" class="form-control" id="izin" name="izin" value="<?= old('izin', $kehadiran_peserta ? $kehadiran_peserta['izin'] : ''); ?>" placeholder="Izin">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">NIM Izin</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <select class="form-control select-tag" multiple="multiple" id="nim_izin" name="nim_izin" value="<?= old('nim_izin', $kehadiran_peserta ? $kehadiran_peserta['nim_izin'] : ''); ?>">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">Tanpa Keterangan</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <input type="number" class="form-control" id="tanpa_ket" name="tanpa_ket" value="<?= old('tanpa_ket', $kehadiran_peserta ? $kehadiran_peserta['tanpa_ket'] : ''); ?>" placeholder="Tanpa Keterangan">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">NIM Tanpa Keterangan</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <select class="form-control select-tag" multiple="multiple" id="nim_tanpa_ket" name="nim_tanpa_ket" value="<?= old('nim_tanpa_ket', $kehadiran_peserta ? $kehadiran_peserta['nim_tanpa_ket'] : ''); ?>">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">Tidak Memenuhi Syarat</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <input type="number" class="form-control" id="tidak_memenuhi_syarat" name="tidak_memenuhi_syarat" value="<?= old('tidak_memenuhi_syarat', $kehadiran_peserta ? $kehadiran_peserta['tidak_memenuhi_syarat'] : ''); ?>" placeholder="Tidak Memenuhi Syarat">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">NIM Tidak Memenuhi Syarat</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <select class="form-control select-tag" multiple="multiple" id="nim_tidak_memenuhi_syarat" name="nim_tidak_memenuhi_syarat" value="<?= old('nim_tidak_memenuhi_syarat', $kehadiran_peserta ? $kehadiran_peserta['nim_tidak_memenuhi_syarat'] : ''); ?>">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">Presensi Kurang</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <input type="number" class="form-control" id="presensi_kurang" name="presensi_kurang" value="<?= old('presensi_kurang', $kehadiran_peserta ? $kehadiran_peserta['presensi_kurang'] : ''); ?>" placeholder="Presensi Kurang">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">NIM Presensi Kurang</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <select class="form-control select-tag" multiple="multiple" id="nim_presensi_kurang" name="nim_presensi_kurang" value="<?= old('nim_presensi_kurang', $kehadiran_peserta ? $kehadiran_peserta['nim_presensi_kurang'] : ''); ?>">
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">Jumlah LJU</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <input type="number" class="form-control <?= (validation_show_error('jumlah_lju')) ? 'is-invalid' : ''; ?>" id="jumlah_lju" name="jumlah_lju" value="<?= old('jumlah_lju', $kehadiran_peserta ? $kehadiran_peserta['jumlah_lju'] : ''); ?>" placeholder="Jumlah LJU">
                                <div class="invalid-feedback">
                                    <?= validation_show_error('jumlah_lju'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">Laporan Kejadian-Kejadian yang Dianggap Perlu</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <div id="dynamic_form">
                                    <div class="row form-group baru-data">
                                        <div class="col-md-3">
                                            <input type="text" name="nim" placeholder="NIM" class="form-control" value="<?= old('nim', $kejadian ? $kejadian['nim'] : ''); ?>">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="nama_mhs" placeholder="Nama Mahasiswa" class="form-control" value="<?= old('nama_mhs', $kejadian ? $kejadian['nama_mhs'] : ''); ?>">
                                        </div>
                                        <div class="col-md-3">
                                            <select class="form-control" name="jenis_kejadian">
                                                <option value="">Pilih Kejadian</option>
                                                <option value="Menyontek" <?= (old('jenis_kejadian', $kejadian && $kejadian['jenis_kejadian']) == 'Menyontek') ? 'selected' : '' ?>>Menyontek</option>
                                                <option value="Ke Toilet/Tindakan Mencurigakan" <?= (old('jenis_kejadian', $kejadian && $kejadian['jenis_kejadian']) == 'Ke Toilet/Tindakan Mencurigakan') ? 'selected' : '' ?>>Ke Toilet/Tindakan Mencurigakan</option>
                                                <option value="Tidak Tercantum Di Absen" <?= (old('jenis_kejadian', $kejadian && $kejadian['jenis_kejadian']) == 'Tidak Tercantum Di Absen') ? 'selected' : '' ?>>Tidak Tercantum Di Absen</option>
                                                <option value="Lain-lain" <?= (old('jenis_kejadian', $kejadian && $kejadian['jenis_kejadian']) == 'Lain-lain') ? 'selected' : '' ?>>Lain-lain</option>
                                            </select>
                                        </div>
                                        <div class="button-group">
                                            <button type="button" class="btn btn-success btn-tambah btn-sm"><i class="ti-plus"></i></button>
                                            <button type="button" class="btn btn-danger btn-hapus btn-sm" style="display:none;"><i class="ti-close"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>

                <script>
                    function addForm() {
                        var addrow = '<div class="row form-group baru-data">\
             <div class="col-md-3">\
             <input type="text" name="nim" placeholder="NIM" class="form-control">\
             </div>\
             <div class="col-md-4">\
               <input type="text" name="nama_mhs" placeholder="Nama Mahasiswa" class="form-control">\
             </div>\
             <div class="col-md-3">\
             <select class="form-control" name="jenis_kejadian">\
             <option value="">Pilih Kejadian</option>\
             <option value="1">Menyontek</option>\
             <option value="2">Ke Toilet/Tindakan Mencurigakan</option>\
             <option value="3">Tidak Tercantum Di Absen</option>\
             <option value="4">Lain-lain</option>\
               </select>\
             </div>\
             <div class="button-group">\
                 <button type="button" class="btn btn-success btn-tambah btn-sm"><i class="ti-plus"></i></button>\
                 <button type="button" class="btn btn-danger btn-hapus btn-sm"><i class="ti-close"></i></button>\
             </div>\
      </div>'
                        $("#dynamic_form").append(addrow);
                    }

                    $("#dynamic_form").on("click", ".btn-tambah", function() {
                        addForm()
                        $(this).css("display", "none")
                        var valtes = $(this).parent().find(".btn-hapus").css("display", "");
                    })

                    $("#dynamic_form").on("click", ".btn-hapus", function() {
                        $(this).parent().parent('.baru-data').remove();
                        var bykrow = $(".baru-data").length;
                        if (bykrow == 1) {
                            $(".btn-hapus").css("display", "none")
                            $(".btn-tambah").css("display", "");
                        } else {
                            $('.baru-data').last().find('.btn-tambah').css("display", "");
                        }
                    });

                    $('.btn-simpan').on('click', function() {
                        $('#dynamic_form').find('input[type="text"], input[type="number"], select, textarea').each(function() {
                            if ($(this).val() == "") {
                                event.preventDefault()
                                $(this).css('border-color', 'red');

                                $(this).on('focus', function() {
                                    $(this).css('border-color', '#ccc');
                                });
                            }
                        })
                    })
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>