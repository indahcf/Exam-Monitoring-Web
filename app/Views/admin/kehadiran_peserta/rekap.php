<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Rekap Data Kehadiran Peserta</h4>
                <form action="<?= base_url('/admin/kehadiran_peserta/save/' . $id_jadwal_ujian . '/' . $id_jadwal_ruang); ?>" method="post" class="" id="form-edit">
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
                    <div class="row mb-3">
                        <div class="col-sm-3">Ruang Ujian</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $ruang_ujian; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Jumlah Peserta</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $jumlah_peserta; ?></div>
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
                                <?php if ($kehadiran_peserta == NULL) : ?>
                                    <option value="">Pilih Pengawas</option>
                                    <option value="<?= $pengawas3['id_dosen']; ?>" <?= (old('pengawas3') == $pengawas3['id_dosen']) ? 'selected' : ''; ?>>
                                    <?php else : ?>
                                    <option value="">Pilih Pengawas</option>
                                    <option value="<?= $pengawas3['id_dosen']; ?>" <?= (old('pengawas3', $pengawas3_hadir) == $pengawas3['id_dosen']) ? 'selected' : ''; ?>>
                                        <?= $pengawas3['dosen']; ?>
                                    </option>
                                <?php endif; ?>
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
                            <input type="number" class="form-control" id="sakit" name="sakit" value="<?= old('sakit', $kehadiran_peserta ? $kehadiran_peserta['sakit'] : ''); ?>" placeholder="Sakit" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">NIM Sakit</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <select class="form-control select-tag" multiple="multiple" id="nim_sakit" name="nim_sakit[]">
                                <?php if ($kehadiran_peserta && $kehadiran_peserta['nim_sakit'] != 'null' && $kehadiran_peserta['nim_sakit'] != NULL) : ?>
                                    <?php foreach (json_decode($kehadiran_peserta['nim_sakit']) as $ns) : ?>
                                        <option value="<?= $ns; ?>" <?= in_array($ns, old('nim_sakit', json_decode($kehadiran_peserta['nim_sakit']))) ? 'selected' : '' ?>><?= $ns ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Izin</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <input type="number" class="form-control" id="izin" name="izin" value="<?= old('izin', $kehadiran_peserta ? $kehadiran_peserta['izin'] : ''); ?>" placeholder="Izin" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">NIM Izin</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <select class="form-control select-tag" multiple="multiple" id="nim_izin" name="nim_izin[]">
                                <?php if ($kehadiran_peserta && $kehadiran_peserta['nim_izin'] != 'null' && $kehadiran_peserta['nim_izin'] != NULL) : ?>
                                    <?php foreach (json_decode($kehadiran_peserta['nim_izin']) as $ni) : ?>
                                        <option value="<?= $ni; ?>" <?= in_array($ni, old('nim_izin', json_decode($kehadiran_peserta['nim_izin']))) ? 'selected' : '' ?>><?= $ni ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Tanpa Keterangan</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <input type="number" class="form-control" id="tanpa_ket" name="tanpa_ket" value="<?= old('tanpa_ket', $kehadiran_peserta ? $kehadiran_peserta['tanpa_ket'] : ''); ?>" placeholder="Tanpa Keterangan" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">NIM Tanpa Keterangan</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <select class="form-control select-tag" multiple="multiple" id="nim_tanpa_ket" name="nim_tanpa_ket[]">
                                <?php if ($kehadiran_peserta && $kehadiran_peserta['nim_tanpa_ket'] != 'null' && $kehadiran_peserta['nim_tanpa_ket'] != NULL) : ?>
                                    <?php foreach (json_decode($kehadiran_peserta['nim_tanpa_ket']) as $ntk) : ?>
                                        <option value="<?= $ntk; ?>" <?= in_array($ntk, old('nim_tanpa_ket', json_decode($kehadiran_peserta['nim_tanpa_ket']))) ? 'selected' : '' ?>><?= $ntk ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Tidak Memenuhi Syarat</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <input type="number" class="form-control" id="tidak_memenuhi_syarat" name="tidak_memenuhi_syarat" value="<?= old('tidak_memenuhi_syarat', $kehadiran_peserta ? $kehadiran_peserta['tidak_memenuhi_syarat'] : ''); ?>" placeholder="Tidak Memenuhi Syarat" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">NIM Tidak Memenuhi Syarat</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <select class="form-control select-tag" multiple="multiple" id="nim_tidak_memenuhi_syarat" name="nim_tidak_memenuhi_syarat[]">
                                <?php if ($kehadiran_peserta && $kehadiran_peserta['nim_tidak_memenuhi_syarat'] != 'null' && $kehadiran_peserta['nim_tidak_memenuhi_syarat'] != NULL) : ?>
                                    <?php foreach (json_decode($kehadiran_peserta['nim_tidak_memenuhi_syarat']) as $ntms) : ?>
                                        <option value="<?= $ntms; ?>" <?= in_array($ntms, old('nim_tidak_memenuhi_syarat', json_decode($kehadiran_peserta['nim_tidak_memenuhi_syarat']))) ? 'selected' : '' ?>><?= $ntms ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Presensi Kurang</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <input type="number" class="form-control" id="presensi_kurang" name="presensi_kurang" value="<?= old('presensi_kurang', $kehadiran_peserta ? $kehadiran_peserta['presensi_kurang'] : ''); ?>" placeholder="Presensi Kurang" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">NIM Presensi Kurang</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <select class="form-control select-tag" multiple="multiple" id="nim_presensi_kurang" name="nim_presensi_kurang[]">
                                <?php if ($kehadiran_peserta && $kehadiran_peserta['nim_presensi_kurang'] != 'null' && $kehadiran_peserta['nim_presensi_kurang'] != NULL) : ?>
                                    <?php foreach (json_decode($kehadiran_peserta['nim_presensi_kurang']) as $npk) : ?>
                                        <option value="<?= $npk; ?>" <?= in_array($npk, old('nim_presensi_kurang', json_decode($kehadiran_peserta['nim_presensi_kurang']))) ? 'selected' : '' ?>><?= $npk ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
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
                            <div>
                                <div id="dynamicForm">
                                </div>
                                <button type="button" class="btn btn-success btn-tambah btn-sm" id="addRow"><i class="ti-plus"></i></button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var oldData = <?= json_encode(old('kejadian', $kejadian)); ?>;
    console.log(oldData)

    function repopulateForm(data) {
        data.forEach(function(item, index) {
            addRow(item, index);
            console.log(index, item)
        });
    }

    function addRow(item, index) {
        var html = `
                        <div class="row mb-3 kejadian">
                            <div class="col-md-4">
                                <input type="text" name="kejadian[${index}][nama_mhs]" class="form-control" placeholder="Nama" value="${item ? item.nama_mhs : ''}" required>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="kejadian[${index}][nim]" class="form-control" placeholder="NIM Mahasiswa" value="${item ? item.nim : ''}" required>
                            </div>
                            <div class="col-md-3">
                                <select name="kejadian[${index}][jenis_kejadian]" class="form-control" required>
                                    <option value="">Pilih Kejadian</option>
                                    <option value="1" ${item && item.jenis_kejadian === '1' ? 'selected' : ''}>Menyontek</option>
                                    <option value="2" ${item && item.jenis_kejadian === '2' ? 'selected' : ''}>Ke Toilet/Tindakan Mencurigakan</option>
                                    <option value="3" ${item && item.jenis_kejadian === '3' ? 'selected' : ''}>Tidak Tercantum di Absen</option>
                                    <option value="4" ${item && item.jenis_kejadian === '4' ? 'selected' : ''}>Lain-lain</option>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-danger btn-hapus btn-sm remove-row"><i class="ti-close"></i></button>
                            </div>
                        </div>
                    `;
        $("#dynamicForm").append(html);
    }

    $(document).ready(function() {
        repopulateForm(oldData);

        $("#addRow").click(function() {
            var newIndex = $(".kejadian").length;
            addRow(null, newIndex);
        });

        $(document).on("click", ".remove-row", function() {
            $(this).closest(".kejadian").remove();
        });

        $("form input").keydown(function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                return false;
            }
        });

        $('select[name^="nim_sakit"]').on('change', function() {
            var selectedNim = $(this).val();
            var inputSakitValue = selectedNim.length;

            $('input[name="sakit"]').val(inputSakitValue);
        });

        $('select[name^="nim_izin"]').on('change', function() {
            var selectedNim = $(this).val();
            var inputIzinValue = selectedNim.length;

            $('input[name="izin"]').val(inputIzinValue);
        });

        $('select[name^="nim_tanpa_ket"]').on('change', function() {
            var selectedNim = $(this).val();
            var inputTanpaKetValue = selectedNim.length;

            $('input[name="tanpa_ket"]').val(inputTanpaKetValue);
        });

        $('select[name^="nim_tidak_memenuhi_syarat"]').on('change', function() {
            var selectedNim = $(this).val();
            var inputTidakMemenuhiSyaratValue = selectedNim.length;

            $('input[name="tidak_memenuhi_syarat"]').val(inputTidakMemenuhiSyaratValue);
        });

        $('select[name^="nim_presensi_kurang"]').on('change', function() {
            var selectedNim = $(this).val();
            var inputPresensiKurangValue = selectedNim.length;

            $('input[name="presensi_kurang"]').val(inputPresensiKurangValue);
        });

    });
</script>
<?= $this->endSection(); ?>