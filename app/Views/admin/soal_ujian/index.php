<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Soal Ujian</h4>
<div class="template-demo row mb-3 mt-4">
    <div class="col-md-5 col-lg-4 col-xl-4 mb-2">
        <?php if (count(array_intersect(user()->roles, ['Admin'])) > 0) : ?>
            <form action="<?= base_url('/admin/soal_ujian') ?>" method="get" id="formFilter" class="input-group" style="width: 235px;">
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
        <?php endif; ?>
    </div>
    <div class="col-md-7 col-lg-8 col-xl-8 mb-2 d-flex justify-content-md-end justify-content-center">
        <a href="<?= base_url(); ?>admin/soal_ujian/create" class="btn btn-primary btn-icon-text">
            <div class="d-md-block d-flex flex-column">
                <i class="ti-plus"></i>
                <span class="d-none d-md-inline ml-1">
                    Tambah
                </span>
            </div>
        </a>
    </div>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="soal_ujian" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mata Kuliah</th>
                                <th>Program Studi</th>
                                <th>Dosen Pembuat Soal</th>
                                <th>Kelas</th>
                                <th>Berkas Soal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            $temp = 0; ?>
                            <?php foreach ($soal_ujian as $s) : ?>
                                <tr>
                                    <?php if ($temp != $s['id_soal_ujian']) {
                                        $i++;
                                        $temp = $s['id_soal_ujian'];
                                    } ?>
                                    <td><?= $i; ?></td>
                                    <td><?= $s['kode_matkul']; ?> - <?= $s['matkul']; ?></td>
                                    <td><?= $s['prodi']; ?></td>
                                    <td><?= $s['dosen']; ?></td>
                                    <td><?= $s['kelas']; ?></td>
                                    <td>
                                        <form action="<?= base_url(); ?>admin/soal_ujian/lihat_soal/<?= $s['soal_ujian']; ?>#toolbar=0" method="post">
                                            <button name="lihat_soal" class="btn btn-primary mb-3">Lihat Soal</button>
                                        </form>
                                    </td>
                                    <td><?= $s['status_soal']; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>admin/soal_ujian/edit/<?= $s['id_soal_ujian']; ?>" data-id="<?= $s['id_soal_ujian']; ?>" class="btn btn-warning btn-rounded btn-icon">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <button data-id="<?= $s['id_soal_ujian']; ?>" data-model="soal_ujian" type="submit" class="btn btn-danger btn-rounded btn-icon delete">
                                            <i class="ti-trash"></i>
                                        </button>
                                        <?php if ($s['status_soal'] != 'Menunggu Direview') : ?>
                                            <a href="<?= base_url(); ?>admin/soal_ujian/hasil_review/<?= $s['id_soal_ujian']; ?>" class="btn btn-success btn-rounded btn-icon">
                                                <i class="ti-eye"></i>
                                            </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <script src="<?= base_url(); ?>/assets/vendors/jquery-3.5.1/jquery-3.5.1.min.js "></script>

                    <script>
                        $(document).ready(function() {
                            $('#soal_ujian').DataTable({
                                'scrollX': true,
                                'rowsGroup': [0, 1, 2, 3, 5, 6, 7]
                            });

                            $(".cetak-soal").click(function() {
                                let id = $(this).data('id')
                                let nama = $(this).data('nama');
                                $.ajax({
                                    type: 'GET',
                                    url: "<?= base_url(); ?>" + '/admin/soal_ujian/cetak_soal/' + id,
                                    xhrFields: {
                                        responseType: 'blob'
                                    },
                                    success: function(response) {
                                        console.log('data download', response)
                                        var blob = new Blob([response]);
                                        var link = document.createElement('a');
                                        link.href = window.URL.createObjectURL(blob);
                                        link.download = nama.trim() + ".pdf";
                                        link.click();
                                        window.location.reload()
                                    },
                                    error: function(blob) {
                                        console.log(blob);
                                    }
                                });
                            });

                            $("#filter").change(function() {
                                $("#formFilter").submit();
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>