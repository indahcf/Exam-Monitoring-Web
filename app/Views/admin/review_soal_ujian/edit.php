<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Review Soal Ujian</h4>
                <form action="<?= base_url('/admin/user/update/' . $review_soal_ujian['id_soal_ujian']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td>Program Studi</td>
                                <td>:</td>
                                <td><?= old('prodi', $prodi_matkul); ?></td>
                            </tr>
                            <tr>
                                <td>Kode dan Mata Kuliah</td>
                                <td>:</td>
                                <td><?= old('kode_matkul', $kode_matkul); ?> <?= old('matkul', $matkul); ?></td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:</td>
                                <td><?= old('kelas', $kelas) ?></td>
                            </tr>
                            <tr>
                                <td>Dosen Pembuat Soal</td>
                                <td>:</td>
                                <td><?= old('dosen', $review_soal_ujian['dosen']); ?></td>
                            </tr>
                            <tr>
                                <td>Bentuk Soal</td>
                                <td>:</td>
                                <td><?= old('bentuk_soal', $review_soal_ujian['bentuk_soal']); ?></td>
                            </tr>
                            <tr>
                                <td>Metode</td>
                                <td>:</td>
                                <td><?= old('metode', $review_soal_ujian['metode']); ?></td>
                            </tr>
                            <tr>
                                <td>Durasi Waktu Pengerjaan Seluruh Butir</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="durasi"></td>
                            </tr>
                            <tr>
                                <td>Informasi Sifat Ujian (Terbuka/Tertutup)</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="durasi"></td>
                            </tr>
                            <tr>
                                <td>Petunjuk Cara Pengerjaan Soal</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="durasi"></td>
                            </tr>
                            <tr>
                                <td>Mengukur Sub-CPMK di RPS</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="durasi"></td>
                            </tr>
                            <tr>
                                <td>Kesesuaian Durasi Waktu Dengan Bobot SKS</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="durasi"></td>
                            </tr>
                            <tr>
                                <td>Kejelasan Pertanyaan (Standar : jelas dan tidak bermakna ganda/ambigu)</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="durasi"></td>
                            </tr>
                            <tr>
                                <td>Pembobotan Soal/Skor (Standar : Ada Pembobotan)</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="durasi"></td>
                            </tr>
                            <tr>
                                <td>Gambar/Grafik/Tabel/Peta Dalam Soal Jelas (Standar : Jelas)</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="durasi"></td>
                            </tr>
                            <tr>
                                <td>Catatan</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="durasi"></td>
                            </tr>
                            <tr>
                                <td>Saran / Rekomendasi</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="durasi"></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td><input type="text" class="form-control" id="durasi"></td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>