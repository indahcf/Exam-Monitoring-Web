<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Hasil Review Soal Ujian</h4>
                <div class="row mb-3">
                    <div class="col-sm-4">Program Studi</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $prodi; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Kode dan Mata Kuliah</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $kode_matkul; ?> - <?= $matkul; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Kelas</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $kelas; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Dosen Pembuat Soal</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['dosen']; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Bentuk Soal</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['bentuk_soal']; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Metode</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['metode']; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Durasi Waktu Pengerjaan Seluruh Butir</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['durasi_pengerjaan']; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Informasi Sifat Ujian (Terbuka/Tertutup)</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['sifat_ujian']; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Petunjuk Cara Pengerjaan Soal</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['petunjuk']; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Mengukur Sub-CPMK di RPS</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['sub_cpmk']; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Kesesuaian Durasi Waktu Dengan Bobot SKS</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['durasi_sks']; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Kejelasan Pertanyaan (Standar : jelas dan tidak bermakna ganda/ambigu)</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['pertanyaan']; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Pembobotan Soal/Skor (Standar : Pembobotan)</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['skor']; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Gambar/Grafik/Tabel/Peta Dalam Soal Jelas (Standar : Jelas)</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['gambar']; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Catatan</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['catatan']; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Saran / Rekomendasi</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['saran']; ?></div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-4">Status</div>
                    <div class="d-none d-sm-inline">:</div>
                    <div class="col-sm"><?= $review_soal_ujian['status_soal']; ?></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>