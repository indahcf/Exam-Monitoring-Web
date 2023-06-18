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
                <div>
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
                            <?php foreach ($jadwal_ujian as $id_jadwal_ujian => $group) : ?>
                                <?php $rowspan = count($group); ?>
                                <?php foreach ($group as $index => $jadwal) : ?>
                                    <?php if ($index == 0) : ?>
                                        <tr>
                                            <td rowspan="<?= $rowspan; ?>"><?= $i++; ?></td>
                                            <td rowspan="<?= $rowspan; ?>"><?= hari($jadwal['tanggal']); ?></td>
                                            <td rowspan="<?= $rowspan; ?>"><?= date('d-m-Y', strtotime($jadwal['tanggal'])); ?></td>
                                            <td rowspan="<?= $rowspan; ?>"><?= date('H.i', strtotime($jadwal['jam_mulai'])); ?> - <?= date('H.i', strtotime($jadwal['jam_selesai'])); ?></td>
                                            <td rowspan="<?= $rowspan; ?>"><?= $jadwal['kode_matkul']; ?></td>
                                            <td rowspan="<?= $rowspan; ?>"><?= $jadwal['matkul']; ?></td>
                                            <td rowspan="<?= $rowspan; ?>"><?= $jadwal['prodi']; ?></td>
                                            <td rowspan="<?= $rowspan; ?>"><?= $jadwal['dosen']; ?></td>
                                            <td rowspan="<?= $rowspan; ?>"><?= $jadwal['kelas']; ?></td>
                                            <td><?= $jadwal['ruang_ujian']; ?></td>
                                            <td><?= $jadwal['jumlah_peserta']; ?></td>
                                            <td rowspan="<?= $rowspan; ?>">
                                                <a href="/admin/jadwal_ujian/edit/<?= $jadwal['id_jadwal_ujian']; ?>" class="btn btn-warning btn-rounded btn-icon">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                                <button data-id="<?= $jadwal['id_jadwal_ujian']; ?>" data-model="jadwal_ujian" type="submit" class="btn btn-danger btn-rounded btn-icon delete">
                                                    <i class="ti-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php else : ?>
                                        <tr>
                                            <td><?= $jadwal['ruang_ujian']; ?></td>
                                            <td><?= $jadwal['jumlah_peserta']; ?></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <script src="/assets/vendors/jquery-3.5.1/jquery-3.5.1.min.js "></script>

                    <script>
                        $(document).ready(function() {
                            $('#jadwal_ujian').DataTable({
                                "scrollX": true
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>