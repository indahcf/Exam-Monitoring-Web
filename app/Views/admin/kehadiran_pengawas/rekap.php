<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Rekap Data Kehadiran Pengawas</h4>
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
                <form action="<?= base_url('/admin/kehadiran_pengawas/save/' . $id_jadwal_ujian . '/' . $id_jadwal_ruang); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <input type="hidden" name="id_jadwal_ruang" value="<?= $id_jadwal_ruang; ?>">
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
                                <select class="form-control <?= (validation_show_error('pengawas1')) ? 'is-invalid' : ''; ?>" id="pengawas1" name="pengawas1">
                                    <option value="">Pilih Pengawas</option>
                                    <?php foreach ($pengawas as $p) : ?>
                                        <option value="<?= $p['id_pengawas']; ?>" <?= (old('pengawas1', $pengawas1) == $p['id_pengawas']) ? 'selected' : ''; ?>>
                                            <?= $p['pengawas']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('pengawas1'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">Pengawas 2</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <select class="form-control" id="pengawas2" name="pengawas2">
                                    <option value="">Pilih Pengawas</option>
                                    <?php foreach ($pengawas as $p) : ?>
                                        <option value="<?= $p['id_pengawas']; ?>" <?= (old('pengawas2', $pengawas2) == $p['id_pengawas']) ? 'selected' : ''; ?>>
                                            <?= $p['pengawas']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-3">Pengawas 3</div>
                            <div class="d-none d-sm-inline">:</div>
                            <div class="col-sm">
                                <select class="form-control <?= (validation_show_error('pengawas3')) ? 'is-invalid' : ''; ?>" id="pengawas3" name="pengawas3">
                                    <option value="">Pilih Pengawas</option>
                                    <option value="<?= $pengawas3['id_dosen']; ?>" <?= (old('pengawas3', $pengawas3['id_dosen']) == $pengawas3['id_dosen']) ? 'selected' : ''; ?>>
                                        <?= $pengawas3['dosen']; ?>
                                    </option>
                                </select>
                                <div class="invalid-feedback">
                                    <?= validation_show_error('pengawas3'); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>