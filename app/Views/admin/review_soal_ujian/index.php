<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Review Soal Ujian</h4>
<div class="template-demo mb-3">
    <form action="<?= base_url('/admin/review_soal_ujian') ?>" method="get" id="formFilter" class="input-group" style="width: 235px;">
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
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="review_soal_ujian" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Mata Kuliah</th>
                                <th>Program Studi</th>
                                <th>Dosen Pembuat Soal</th>
                                <th>Kelas</th>
                                <th>Berkas Soal Ujian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            $temp = 0; ?>
                            <?php foreach ($review_soal_ujian as $r) : ?>
                                <tr>
                                    <?php if ($temp != $r['id_soal_ujian']) {
                                        $i++;
                                        $temp = $r['id_soal_ujian'];
                                    } ?>
                                    <td><?= $i; ?></td>
                                    <td><?= $r['kode_matkul']; ?></td>
                                    <td><?= $r['matkul']; ?></td>
                                    <td><?= $r['prodi']; ?></td>
                                    <td><?= $r['dosen']; ?></td>
                                    <td><?= $r['kelas']; ?></td>
                                    <td>
                                        <form action="<?= base_url(); ?>admin/review_soal_ujian/lihat_soal/<?= $r['soal_ujian']; ?>#toolbar=0" method="post">
                                            <button name="lihat_soal" class="btn btn-primary mb-3">Lihat Soal</button>
                                        </form>
                                        <a href="/admin/review_soal_ujian/cetak_soal/<?= $r['id_soal_ujian']; ?>" class="btn btn-info">Cetak Soal</a>
                                    </td>
                                    <td><?= $r['status_soal']; ?></td>
                                    <td>
                                        <a href="/admin/review_soal_ujian/edit/<?= $r['id_soal_ujian']; ?>" data-id="<?= $r['id_soal_ujian']; ?>" class="btn btn-warning btn-rounded btn-icon">
                                            <i class="ti-pencil"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <script src="/assets/vendors/jquery-3.5.1/jquery-3.5.1.min.js "></script>

                    <script>
                        $(document).ready(function() {
                            $('#review_soal_ujian').DataTable({
                                'scrollX': true,
                                'rowsGroup': [0, 1, 2, 3, 4, 6, 7, 8]
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