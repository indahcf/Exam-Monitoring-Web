<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Tahun Akademik</h4>
<div class="template-demo">
    <a href="/admin/tahun_akademik/create" class="btn btn-primary btn-icon-text">
        <i class="ti-plus btn-icon-prepend"></i>
        Tambah
    </a>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="tahun_akademik" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Semester</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($tahun_akademik as $t) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $t['tahun']; ?></td>
                                    <td><?= $t['semester']; ?></td>
                                    <td><?= $t['status'] == '1' ? 'Aktif' : 'Tidak Aktif'; ?></td>
                                    <td>
                                        <a href="/admin/tahun_akademik/edit/<?= $t['id_tahun_akademik']; ?>" type="button" class="btn btn-warning btn-rounded btn-icon">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <button data-id="<?= $t['id_tahun_akademik']; ?>" data-model="tahun_akademik" type="submit" class="btn btn-danger btn-rounded btn-icon delete">
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
                            $('#tahun_akademik').DataTable();
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>