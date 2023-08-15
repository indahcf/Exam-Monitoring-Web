<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Review Soal Ujian</h4>
                <form action="<?= base_url('/admin/review_soal/update_review/' . $review_soal_ujian['id_soal_ujian']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
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
                        <div class="col-sm">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="durasi_pengerjaan" id="durasi_pengerjaan" value="Ada" <?= (old('durasi_pengerjaan', $review_soal_ujian['durasi_pengerjaan']) == 'Ada') ? 'checked' : '' ?>>
                                <label class="mb-0" for="durasi_pengerjaan">Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="durasi_pengerjaan" id="durasi_pengerjaan" value="Tidak Ada" <?= (old('durasi_pengerjaan', $review_soal_ujian['durasi_pengerjaan']) == 'Tidak Ada') ? 'checked' : '' ?>>
                                <label class="mb-0" for="durasi_pengerjaan">Tidak Ada</label>
                            </div>
                            <div>
                                <small class="text-danger">
                                    <?= validation_show_error('durasi_pengerjaan'); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Informasi Sifat Ujian (Terbuka/Tertutup)</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sifat_ujian" id="sifat_ujian" value="Ada" <?= (old('sifat_ujian', $review_soal_ujian['sifat_ujian']) == 'Ada') ? 'checked' : '' ?>>
                                <label class="mb-0" for="sifat_ujian">Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sifat_ujian" id="sifat_ujian" value="Tidak Ada" <?= (old('sifat_ujian', $review_soal_ujian['sifat_ujian']) == 'Tidak Ada') ? 'checked' : '' ?>>
                                <label class="mb-0" for="sifat_ujian">Tidak Ada</label>
                            </div>
                            <div>
                                <small class="text-danger">
                                    <?= validation_show_error('sifat_ujian'); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Petunjuk Cara Pengerjaan Soal</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="petunjuk" id="petunjuk" value="Ada" <?= (old('petunjuk', $review_soal_ujian['petunjuk']) == 'Ada') ? 'checked' : '' ?>>
                                <label class="mb-0" for="petunjuk">Ada</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="petunjuk" id="petunjuk" value="Tidak Ada" <?= (old('petunjuk', $review_soal_ujian['petunjuk']) == 'Tidak Ada') ? 'checked' : '' ?>>
                                <label class="mb-0" for="petunjuk">Tidak Ada</label>
                            </div>
                            <div>
                                <small class="text-danger">
                                    <?= validation_show_error('petunjuk'); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Mengukur Sub-CPMK di RPS</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sub_cpmk" id="sub_cpmk" value="Ya" <?= (old('sub_cpmk', $review_soal_ujian['sub_cpmk']) == 'Ya') ? 'checked' : '' ?>>
                                <label class="mb-0" for="sub_cpmk">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="sub_cpmk" id="sub_cpmk" value="Tidak" <?= (old('sub_cpmk', $review_soal_ujian['sub_cpmk']) == 'Tidak') ? 'checked' : '' ?>>
                                <label class="mb-0" for="sub_cpmk">Tidak</label>
                            </div>
                            <div>
                                <small class="text-danger">
                                    <?= validation_show_error('sub_cpmk'); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Kesesuaian Durasi Waktu Dengan Bobot SKS</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="durasi_sks" id="durasi_sks" value="Ya" <?= (old('durasi_sks', $review_soal_ujian['durasi_sks']) == 'Ya') ? 'checked' : '' ?>>
                                <label class="mb-0" for="durasi_sks">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="durasi_sks" id="durasi_sks" value="Tidak" <?= (old('durasi_sks', $review_soal_ujian['durasi_sks']) == 'Tidak') ? 'checked' : '' ?>>
                                <label class="mb-0" for="durasi_sks">Tidak</label>
                            </div>
                            <div>
                                <small class="text-danger">
                                    <?= validation_show_error('durasi_sks'); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Kejelasan Pertanyaan (Standar : jelas dan tidak bermakna ganda/ambigu)</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pertanyaan" id="pertanyaan" value="Ya" <?= (old('pertanyaan', $review_soal_ujian['pertanyaan']) == 'Ya') ? 'checked' : '' ?>>
                                <label class="mb-0" for="pertanyaan">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="pertanyaan" id="pertanyaan" value="Tidak" <?= (old('pertanyaan', $review_soal_ujian['pertanyaan']) == 'Tidak') ? 'checked' : '' ?>>
                                <label class="mb-0" for="pertanyaan">Tidak</label>
                            </div>
                            <div>
                                <small class="text-danger">
                                    <?= validation_show_error('pertanyaan'); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Pembobotan Soal/Skor (Standar : Pembobotan)</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="skor" id="skor" value="Ya" <?= (old('skor', $review_soal_ujian['skor']) == 'Ya') ? 'checked' : '' ?>>
                                <label class="mb-0" for="skor">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="skor" id="skor" value="Tidak" <?= (old('skor', $review_soal_ujian['skor']) == 'Tidak') ? 'checked' : '' ?>>
                                <label class="mb-0" for="skor">Tidak</label>
                            </div>
                            <div>
                                <small class="text-danger">
                                    <?= validation_show_error('skor'); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Gambar/Grafik/Tabel/Peta Dalam Soal Jelas (Standar : Jelas)</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar" value="Ya" <?= (old('gambar', $review_soal_ujian['gambar']) == 'Ya') ? 'checked' : '' ?>>
                                <label class="mb-0" for="gambar">Ya</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gambar" id="gambar" value="Tidak" <?= (old('gambar', $review_soal_ujian['gambar']) == 'Tidak') ? 'checked' : '' ?>>
                                <label class="mb-0" for="gambar">Tidak</label>
                            </div>
                            <div>
                                <small class="text-danger">
                                    <?= validation_show_error('gambar'); ?>
                                </small>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Catatan</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <textarea class="form-control <?= (validation_show_error('catatan')) ? 'is-invalid' : ''; ?>" name="catatan" id="catatan" rows="3"><?= old('catatan', $review_soal_ujian['catatan']) ?></textarea>
                            <div class="invalid-feedback">
                                <?= validation_show_error('catatan'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Saran / Rekomendasi</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <textarea class="form-control <?= (validation_show_error('saran')) ? 'is-invalid' : ''; ?>" name="saran" id="saran" rows="3"><?= old('saran', $review_soal_ujian['saran']) ?></textarea>
                            <div class="invalid-feedback">
                                <?= validation_show_error('saran'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Status</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm">
                            <select class="form-control <?= (validation_show_error('status_soal')) ? 'is-invalid' : ''; ?>" id="status_soal" name="status_soal">
                                <option value="">Pilih Status</option>
                                <option value="Menunggu Direview" <?= (old('status_soal', $review_soal_ujian['status_soal']) == 'Menunggu Direview') ? 'selected' : '';  ?>>Menunggu Direview</option>
                                <option value="Revisi" <?= (old('status_soal', $review_soal_ujian['status_soal']) == 'Revisi') ? 'selected' : '';  ?>>Revisi</option>
                                <option value="Diterima" <?= (old('status_soal', $review_soal_ujian['status_soal']) == 'Diterima') ? 'selected' : '';  ?>>Diterima</option>
                                <option value="Dicetak" <?= (old('status_soal', $review_soal_ujian['status_soal']) == 'Dicetak') ? 'selected' : '';  ?>>Dicetak</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= validation_show_error('status_soal'); ?>
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