<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Jadwal Ujian</h4>
<div class="template-demo row mb-3 mt-4">
    <div class="col-md-5 col-lg-4 col-xl-4 mb-2">
        <form action="<?= base_url('/admin/jadwal_ujian') ?>" method="get" id="formFilter" class="input-group">
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
    <div class="col-md-7 col-lg-8 col-xl-8 mb-2 d-flex justify-content-md-end justify-content-center">
        <a href="/admin/jadwal_ujian/create" class="btn btn-primary btn-icon-text mr-2">
            <div class="d-md-block d-flex flex-column">
                <i class="ti-plus"></i>
                <span class="d-none d-md-inline ml-1">
                    Tambah
                </span>
            </div>
        </a>
        <button type="button" class="btn btn-success btn-icon-text mr-2" data-toggle="modal" data-target="#modalImport">
            <div class="d-md-block d-flex flex-column">
                <i class="ti-import"></i>
                <span class="d-none d-md-inline ml-1">
                    Import
                </span>
            </div>
        </button>
        <?php if (!empty($jadwal_ujian)) : ?>
            <a href="<?= $url_export ?>" class="btn btn-danger btn-icon-text">
                <div class="d-md-block d-flex flex-column">
                    <i class="ti-export"></i>
                    <span class="d-none d-md-inline ml-1">
                        Export
                    </span>
                </div>
            </a>
        <?php endif; ?>
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
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Mata Kuliah</th>
                                <th>Program Studi</th>
                                <th>Dosen</th>
                                <th>Kelas</th>
                                <th>Ruang Ujian</th>
                                <th>Jumlah Peserta</th>
                                <th>Pengawas</th>
                                <th>Koordinator Ujian</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 0;
                            $temp = 0; ?>
                            <?php foreach ($jadwal_ujian as $j) : ?>
                                <tr>
                                    <?php if ($temp != $j['id_jadwal_ujian']) {
                                        $i++;
                                        $temp = $j['id_jadwal_ujian'];
                                    } ?>
                                    <td><?= $i; ?></td>
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
                                    <td><?= $j['pengawas']; ?></td>
                                    <td><?= $j['nama_koordinator']; ?></td>
                                    <td>
                                        <a href="/admin/jadwal_ujian/edit/<?= $j['id_jadwal_ujian']; ?>" data-id="<?= $j['id_jadwal_ujian']; ?>" class="btn btn-warning btn-rounded btn-icon">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <button data-id="<?= $j['id_jadwal_ujian']; ?>" data-model="jadwal_ujian" type="submit" class="btn btn-danger btn-rounded btn-icon delete">
                                            <i class="ti-trash"></i>
                                        </button>
                                        <a href="/admin/jadwal_ujian/kehadiran_pengawas/<?= $j['id_jadwal_ujian']; ?>" class="btn btn-success btn-rounded btn-icon">
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
                                'rowsGroup': [0, 1, 2, 3, 4, 5, 6, 7, 8, 12, 13, 9, 10]
                            });

                            $('.form_modal').submit(function(e) {
                                e.preventDefault();
                                let data = new FormData(this)
                                console.log(data);
                                $.ajax({
                                    type: "post",
                                    url: $(this).attr('action'),
                                    enctype: 'multipart/form-data',
                                    data: new FormData(this),
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        if (response.error) {
                                            if (response.error.periode_ujian) {
                                                $('#periode_ujian').addClass('is-invalid');
                                                $('.errorPeriodeUjian').html(response.error.periode_ujian);
                                            } else {
                                                $('#periode_ujian').removeClass('is-invalid');
                                                $('.errorPeriodeUjian').html('');
                                            }
                                            if (response.error.fileexcel) {
                                                $('#file_excel').addClass('is-invalid');
                                                $('.errorFileExcel').html(response.error.fileexcel);
                                            } else {
                                                $('#file_excel').removeClass('is-invalid');
                                                $('.errorFileExcel').html('');
                                            }
                                        } else {
                                            window.location.reload()
                                        }
                                    }
                                });
                            });

                            $('#modalImport').on('hidden.bs.modal', function(e) {
                                $('#periode_ujian').removeClass('is-invalid');
                                $('.errorPeriodeUjian').html('');
                                $('#file_excel').removeClass('is-invalid');
                                $('.errorFileExcel').html('');
                                $('select[name=periode_ujian]').val('')
                                $('input[name=fileexcel]').val('')
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

<div class="modal fade" id="modalImport">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Jadwal Ujian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('/admin/jadwal_ujian/simpanExcel') ?>" enctype="multipart/form-data" class="form_modal">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="periode_ujian">Periode Ujian</label>
                        <select class="form-control" id="periode_ujian" name="periode_ujian">
                            <option value="">Pilih Periode Ujian</option>
                            <option value="UTS" <?= old('periode_ujian') == 'UTS' ? 'selected' : '' ?>>UTS</option>
                            <option value="UAS" <?= old('periode_ujian') == 'UAS' ? 'selected' : '' ?>>UAS</option>
                        </select>
                        <div class="invalid-feedback errorPeriodeUjian">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="file_excel">File Excel</label>
                        <input type="file" class="form-control-file" name="fileexcel" id="file_excel">
                        <div class="invalid-feedback errorFileExcel">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>