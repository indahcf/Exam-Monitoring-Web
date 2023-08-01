<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Detail Jadwal Ujian</h4>
                <div class="row mb-3">
                    <div class="col-sm-4">Hari</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= old('prodi', $prodi_matkul); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Tanggal</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= old('kode_matkul', $kode_matkul); ?> - <?= old('matkul', $matkul); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Jam</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= old('kelas', $kelas) ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Kode Mata Kuliah</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= old('dosen', $review_soal_ujian['dosen']); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Mata Kuliah</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= old('bentuk_soal', $review_soal_ujian['bentuk_soal']); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Program Studi</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= old('metode', $review_soal_ujian['metode']); ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Dosen</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Kelas</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Ruang Ujian</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Jumlah Peserta</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Pengawas</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Koordinator Ujian</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>