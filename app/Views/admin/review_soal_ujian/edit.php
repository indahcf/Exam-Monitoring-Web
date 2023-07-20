<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tambah Data Review Soal Ujian</h4>
                <form action="<?= base_url('/admin/user/update/' . $review_soal_ujian['id_soal_ujian']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <div class="form-group">
                        <label for="kode_matkul">Kode Mata Kuliah</label>
                        <input type="kode_matkul" class="form-control" id="kode_matkul" name="kode_matkul" value="<?= old('kode_matkul', $kode_matkul); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="matkul">Mata Kuliah</label>
                        <input type="matkul" class="form-control" id="matkul" name="matkul" value="<?= old('matkul', $matkul); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="prodi">Program Studi</label>
                        <input type="prodi" class="form-control" id="prodi" name="prodi" value="<?= old('prodi', $prodi_matkul); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="kelas">Kelas</label>
                        <input type="kelas" class="form-control" id="kelas" name="kelas" value='<?= old('kelas', $kelas) ?>' readonly>
                    </div>
                    <div class="form-group">
                        <label for="dosen">Dosen Pembuat Soal</label>
                        <input type="dosen" class="form-control" id="dosen" name="dosen" value="<?= old('dosen', $review_soal_ujian['dosen']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="bentuk_soal">Bentuk Soal</label>
                        <input type="bentuk_soal" class="form-control" id="bentuk_soal" name="bentuk_soal" value="<?= old('bentuk_soal', $review_soal_ujian['bentuk_soal']); ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="metode">Metode</label>
                        <input type="metode" class="form-control" id="metode" name="metode" value="<?= old('metode', $review_soal_ujian['metode']); ?>" readonly>
                    </div>

                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>