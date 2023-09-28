<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Rekap Data Distribusi Hasil Ujian</h4>
                <form action="<?= base_url('/admin/distribusi_hasil_ujian/update/' . $distribusi_hasil_ujian['id_jadwal_ruang']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <div class="row mb-3">
                        <div class="col-sm-3">Hari</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= hari($distribusi_hasil_ujian['tanggal']); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Tanggal</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= date('d-m-Y', strtotime($distribusi_hasil_ujian['tanggal'])); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Jam</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= date('H.i', strtotime($distribusi_hasil_ujian['jam_mulai'])); ?> - <?= date('H.i', strtotime($distribusi_hasil_ujian['jam_selesai'])); ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Kode Mata Kuliah</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $kode_matkul; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Mata Kuliah</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $matkul; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Program Studi</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $prodi; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Dosen</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $dosen; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Kelas</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $kelas; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Ruang Ujian</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"><?= $distribusi_hasil_ujian['ruang_ujian']; ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Status</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <select class="form-control <?= (validation_show_error('status_distribusi')) ? 'is-invalid' : ''; ?>" id="status_distribusi" name="status_distribusi">
                                <option value="">Pilih Status</option>
                                <option value="Belum" <?= (old('status_distribusi', $distribusi_hasil_ujian['status_distribusi']) == 'Belum') ? 'selected' : '';  ?>>Belum</option>
                                <option value="Dikirim" <?= (old('status_distribusi', $distribusi_hasil_ujian['status_distribusi']) == 'Dikirim') ? 'selected' : '';  ?>>Dikirim</option>
                                <option value="Diterima" <?= (old('status_distribusi', $distribusi_hasil_ujian['status_distribusi']) == 'Diterima') ? 'selected' : '';  ?>>Diterima</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= validation_show_error('status_distribusi'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">Penerima</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <input type="text" class="form-control <?= (validation_show_error('penerima')) ? 'is-invalid' : ''; ?>" id="penerima" name="penerima" value="<?= old('penerima', $distribusi_hasil_ujian['penerima']); ?>" placeholder="Penerima">
                            <div class="invalid-feedback">
                                <?= validation_show_error('penerima'); ?>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>