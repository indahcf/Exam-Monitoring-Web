<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Ruang Ujian</h4>
<div class="template-demo">
    <a href="/admin/ruang_ujian/create" class="btn btn-primary btn-icon-text">
        <i class="ti-plus btn-icon-prepend"></i>
        Tambah
    </a>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="matkul" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Ruang Ujian</th>
                                <th>Kapasitas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($ruang_ujian as $r) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $r['ruang_ujian']; ?></td>
                                    <td><?= $r['kapasitas']; ?></td>
                                    <td>
                                        <a href="/admin/ruang_ujian/edit/<?= $r['id_ruang_ujian']; ?>" class="btn btn-warning btn-rounded btn-icon">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <button data-id="<?= $r['id_ruang_ujian']; ?>" data-model="ruang_ujian" type="submit" class="btn btn-danger btn-rounded btn-icon delete">
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
                            $('#matkul').DataTable();
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>