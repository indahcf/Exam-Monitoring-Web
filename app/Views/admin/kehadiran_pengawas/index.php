<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Kehadiran Pengawas</h4>
<div class="template-demo row mb-3 mt-4">
    <div class="col-md-5 col-lg-4 col-xl-4 mb-2">
        <form action="<?= base_url('/admin/kehadiran_pengawas') ?>" method="get" id="formFilter" class="input-group">
            <select class="form-control" id="filter" name="filter">
                <option value="">Pilih Tahun Akademik</option>
                <?php foreach ($tahun_akademik as $t) : ?>
                    <?php foreach (["UTS", "UAS"] as $periode_ujian) : ?>
                        <option value="<?= $t['id_tahun_akademik']; ?>_<?= $periode_ujian; ?>" <?= old('filter', $filter) == $t['id_tahun_akademik'] . "_" . $periode_ujian ? 'selected' : '' ?>>
                            <?= $periode_ujian; ?> <?= $t['semester']; ?> <?= $t['tahun_akademik']; ?>
                        </option>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </select>
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="ti-filter btn-icon-prepend"></i>
                </span>
            </div>
        </form>
    </div>
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
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Mata Kuliah</th>
                                <th>Program Studi</th>
                                <th>Dosen</th>
                                <th>Kelas</th>
                                <th>Ruang Ujian</th>
                                <th>Peserta</th>
                                <th>Pengawas</th>
                                <th>Pengawas Bertugas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            $temp = 0; ?>
                            <?php foreach ($kehadiran_pengawas as $k) : ?>
                                <tr>
                                    <?php if ($temp != $k['id_jadwal_ujian']) {
                                        $i++;
                                        $temp = $k['id_jadwal_ujian'];
                                    } ?>
                                    <td><?= $i; ?></td>
                                    <td><?= hari($k['tanggal']); ?>, <?= date('d-m-Y', strtotime($k['tanggal'])); ?></td>
                                    <td><?= date('H.i', strtotime($k['jam_mulai'])); ?> - <?= date('H.i', strtotime($k['jam_selesai'])); ?></td>
                                    <td><?= $k['kode_matkul']; ?> - <?= $k['matkul']; ?></td>
                                    <td><?= $k['prodi']; ?></td>
                                    <td><?= $k['dosen']; ?></td>
                                    <td><?= $k['kelas']; ?></td>
                                    <td><?= $k['ruang_ujian']; ?></td>
                                    <td><?= $k['jumlah_peserta']; ?></td>
                                    <td>
                                        <?php foreach ($groupedPengawas[$k['id_jadwal_ruang']] as $grup) : ?>
                                            <p><?= $grup['pengawas'] ?></p>
                                        <?php endforeach; ?>
                                    </td>
                                    <td>
                                        <p><?= $k['pengawas_bertugas_1']; ?></p>
                                        <p><?= $k['pengawas_bertugas_2']; ?></p>
                                    </td>
                                    <td>
                                        <a href="/admin/kehadiran_pengawas/rekap/<?= $k['id_jadwal_ujian']; ?>/<?= $k['id_jadwal_ruang']; ?>" class="btn btn-success btn-rounded btn-icon">
                                            <i class="ti-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <script src="/assets/vendors/jquery-3.5.1/jquery-3.5.1.min.js "></script>

                    <script>
                        $(document).ready(function() {
                            $('#jadwal_ujian').DataTable({
                                'scrollX': true,
                                'rowsGroup': [0, 1, 2, 3, 4, 5, 6, 7, 8, 11]
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