<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Kehadiran Peserta</h4>
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
                    <table id="kehadiran_peserta" class="table table-striped">
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
                                <th>Sakit</th>
                                <th>NIM Sakit</th>
                                <th>TK</th>
                                <th>NIM TK</th>
                                <th>Izin</th>
                                <th>NIM Izin</th>
                                <th>NIM Kejadian</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            $temp = 0; ?>
                            <?php foreach ($kehadiran_peserta as $k) : ?>
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
                                    <td><?= $k['sakit']; ?></td>
                                    <td><?php if ($k['nim_sakit'] != NULL && $k['nim_sakit'] != 'null') : ?><?php foreach (json_decode($k['nim_sakit']) as $n => $nim_sakit) : ?><?= $nim_sakit ?><?= count(json_decode($k['nim_sakit'])) == $n + 1 ? '' : ', ' ?><?php endforeach; ?><?php endif; ?></td>
                                    <td><?= $k['tanpa_ket']; ?></td>
                                    <td><?php if ($k['nim_tanpa_ket'] != NULL && $k['nim_tanpa_ket'] != 'null') : ?><?php foreach (json_decode($k['nim_tanpa_ket']) as $n => $nim_tanpa_ket) : ?><?= $nim_tanpa_ket ?><?= count(json_decode($k['nim_tanpa_ket'])) == $n + 1 ? '' : ', ' ?><?php endforeach; ?><?php endif; ?></td>
                                    <td><?= $k['izin']; ?></td>
                                    <td><?php if ($k['nim_izin'] != NULL && $k['nim_izin'] != 'null') : ?><?php foreach (json_decode($k['nim_izin']) as $n => $nim_izin) : ?><?= $nim_izin ?><?= count(json_decode($k['nim_izin'])) == $n + 1 ? '' : ', ' ?><?php endforeach; ?><?php endif; ?></td>
                                    <td><?= $k['nim']; ?></td>
                                    <td>
                                        <?php if ($k['jenis_kejadian']) : ?>
                                            <?= $jenis_kejadian[intval($k['jenis_kejadian']) - 1]; ?>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if ($k['nama_pengawas1']) : ?>
                                            <?php if ($k['id_kehadiran_peserta']) : ?>
                                                <a href="<?= base_url(); ?>admin/kehadiran_peserta/rekap/<?= $k['id_jadwal_ujian']; ?>/<?= $k['id_ruang_peserta']; ?>" class="btn btn-warning btn-rounded btn-icon">
                                                    <i class="ti-pencil"></i>
                                                </a>
                                                <a href="<?= base_url(); ?>admin/kehadiran_peserta/export/<?= $k['id_jadwal_ujian']; ?>/<?= $k['id_ruang_peserta']; ?>" class="btn btn-success btn-rounded btn-icon">
                                                    <i class="ti-eye"></i>
                                                </a>
                                            <?php else : ?>
                                                <a href="<?= base_url(); ?>admin/kehadiran_peserta/rekap/<?= $k['id_jadwal_ujian']; ?>/<?= $k['id_ruang_peserta']; ?>" class="btn btn-primary btn-rounded btn-icon">
                                                    <i class="ti-plus"></i>
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
                            $('#kehadiran_peserta').DataTable({
                                'scrollX': true,
                                'rowsGroup': [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 17],
                                dom: 'lBfrtip',
                                buttons: [{
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5, 6, 7, 8, 10, 12, 14, 15, 16]
                                    }
                                }]
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