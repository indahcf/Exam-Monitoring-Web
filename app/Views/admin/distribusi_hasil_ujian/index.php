<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Distribusi Hasil Ujian</h4>
<div class="template-demo row mb-3 mt-4">
    <div class="col-md-5 col-lg-4 col-xl-4 mb-2">
        <?php if (count(array_intersect(user()->roles, ['Admin'])) > 0) : ?>
            <form action="<?= base_url('/admin/distribusi_hasil_ujian') ?>" method="get" id="formFilter" class="input-group">
                <select class="form-control" id="filter" name="filter">
                    <option value="">Pilih Tahun Akademik</option>
                    <?php foreach ($tahun_akademik as $t) : ?>
                        <option value="<?= $t['id_tahun_akademik']; ?>" <?= old('filter', $filter) == $t['id_tahun_akademik'] ? 'selected' : '' ?>>
                            <?= $t['periode_ujian']; ?> <?= $t['semester']; ?> <?= $t['tahun_akademik']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="input-group-append">
                    <span class="input-group-text">
                        <i class="ti-filter btn-icon-prepend"></i>
                    </span>
                </div>
            </form>
        <?php endif; ?>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div>
                    <table id="distribusi_hasil_ujian" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Mata Kuliah</th>
                                <th>Program Studi</th>
                                <th>Dosen</th>
                                <th>Kelas</th>
                                <th>Ruang</th>
                                <th>Status</th>
                                <th>Penerima</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            $temp = 0; ?>
                            <?php foreach ($distribusi_hasil_ujian as $d) : ?>
                                <tr>
                                    <?php if ($temp != $d['id_jadwal_ujian']) {
                                        $i++;
                                        $temp = $d['id_jadwal_ujian'];
                                    } ?>
                                    <td><?= $i; ?></td>
                                    <td><?= hari($d['tanggal']); ?>, <?= date('d-m-Y', strtotime($d['tanggal'])); ?></td>
                                    <td><?= date('H.i', strtotime($d['jam_mulai'])); ?> - <?= date('H.i', strtotime($d['jam_selesai'])); ?></td>
                                    <td><?= $d['kode_matkul']; ?> - <?= $d['matkul']; ?></td>
                                    <td><?= $d['prodi']; ?></td>
                                    <td><?= $d['dosen']; ?></td>
                                    <td><?= $d['kelas']; ?></td>
                                    <td><?= $d['ruang_ujian']; ?></td>
                                    <td><?= $d['status_distribusi']; ?></td>
                                    <td><?= $d['penerima']; ?></td>
                                    <td>
                                        <?php if (count(array_intersect(user()->roles, ['Admin', 'Pendistribusi Hasil Ujian'])) > 0) : ?>
                                            <a href="<?= base_url(); ?>admin/distribusi_hasil_ujian/edit/<?= $d['id_jadwal_ruang']; ?>" data-id="<?= $d['id_jadwal_ruang']; ?>" class="btn btn-warning btn-rounded btn-icon">
                                                <i class="ti-pencil"></i>
                                            </a>
                                        <?php endif; ?>
                                        <?php if (count(array_intersect(user()->roles, ['Admin', 'Dosen'])) > 0) : ?>
                                            <?php if ($d['status_distribusi'] != 'Belum') : ?>
                                                <a href="<?= base_url(); ?>admin/distribusi_hasil_ujian/terima/<?= $d['id_jadwal_ruang']; ?>" class="btn btn-success btn-rounded btn-icon">
                                                    <i class="ti-check"></i>
                                                </a>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <script src="<?= base_url(); ?>/assets/vendors/jquery-3.5.1/jquery-3.5.1.min.js "></script>

                    <script>
                        $(document).ready(function() {
                            $('#distribusi_hasil_ujian').DataTable({
                                'scrollX': true,
                                'rowsGroup': [0, 1, 2, 3, 4, 5, 6]
                            });
                        });

                        $("#filter").change(function() {
                            $("#formFilter").submit();
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>