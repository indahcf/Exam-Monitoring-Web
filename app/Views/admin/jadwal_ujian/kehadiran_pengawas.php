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
                        <div class="col-sm-4">Hari</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Tanggal</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Jam</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Kode Mata Kuliah</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Mata Kuliah</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-4">Program Studi</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"></div>
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
                        <div class="col-sm-4">Koordinator Ujian</div>
                        <div class="d-none d-sm-inline">:</div>
                        <div class="col-sm"></div>
                    </div>
                    <!-- <div id="ruangan" data-ruangan='<?= json_encode(old('ruang_ujian', $ruang_ujian)) ?>' data-peserta='<?= json_encode(old('jumlah_peserta', $jumlah_peserta)) ?>' data-pengawas1='<?= json_encode(old('pengawas1', $pengawas)) ?>' data-pengawas2='<?= json_encode(old('pengawas2', $pengawas)) ?>'> -->
                    <div class="row fg_ruangan_peserta">
                        <div class="form-group col-md-3">
                            <label for="ruang_ujian">Ruang Ujian 1</label>
                            <input type="text" class="form-control" id="ruang_ujian" name="ruang_ujian[]" placeholder="Ruang Ujian 1" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="jumlah_peserta">Jumlah Peserta Ruang Ujian 1</label>
                            <input type="number" class="form-control" id="jumlah_peserta" name="jumlah_peserta[]" placeholder="Jumlah Peserta Ruang Ujian 1" readonly>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="pengawas1">Pengawas 1 Ruang Ujian 1</label>
                            <select class="form-control <?= (validation_show_error('pengawas1.0')) ? 'is-invalid' : ''; ?>" id="pengawas1" name="pengawas1[]">
                                <option value="">Pilih Pengawas 1 Ruang Ujian 1</option>
                            </select>
                            <div class="invalid-feedback">
                                <?= validation_show_error('pengawas1.0'); ?>
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="pengawas2">Pengawas 2 Ruang Ujian 1</label>
                            <select class="form-control" id="pengawas2" name="pengawas2[]">
                                <option value="">Pilih Pengawas 2 Ruang Ujian 1</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?= $this->endSection(); ?>