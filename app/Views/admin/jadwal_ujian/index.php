<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Jadwal Ujian</h4>
<div class="template-demo">
    <a href="/admin/jadwal_ujian/create" class="btn btn-primary btn-icon-text">
        <i class="ti-plus btn-icon-prepend"></i>
        Tambah
    </a>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="jadwal_ujian" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Mata Kuliah</th>
                                <th>Program Studi</th>
                                <th>Dosen</th>
                                <th>Kelas</th>
                                <th>Ruang</th>
                                <th>Jumlah Peserta</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($jadwal_ujian as $j) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= hari($j['tanggal']); ?></td>
                                    <td><?= date('d-m-Y', strtotime($j['tanggal'])); ?></td>
                                    <td><?= date('H.i', strtotime($j['jam_mulai'])); ?> - <?= date('H.i', strtotime($j['jam_selesai'])); ?></td>
                                    <td><?= $j['kode_matkul']; ?></td>
                                    <td><?= $j['matkul']; ?></td>
                                    <td><?= $j['prodi']; ?></td>
                                    <td><?= $j['dosen']; ?></td>
                                    <td><?= $j['kelas']; ?></td>
                                    <td><?= $j['ruang_ujian']; ?></td>
                                    <td><?= $j['jumlah_peserta']; ?></td>
                                    <td>
                                        <a href="/admin/jadwal_ujian/edit/<?= $j['id_jadwal_ujian']; ?>" class="btn btn-warning btn-rounded btn-icon">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <button data-id="<?= $j['id_jadwal_ujian']; ?>" data-model="jadwal_ujian" type="submit" class="btn btn-danger btn-rounded btn-icon delete">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <script src="/assets/vendors/jquery-3.5.1/jquery-3.5.1.min.js "></script>

                    <script>
                        $(document).ready(function() {
                            $('#jadwal_ujian').DataTable();
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>