<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Mata Kuliah</h4>
<div class="template-demo">
    <a href="/admin/matkul/create" class="btn btn-primary btn-icon-text">
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
                                <th>Kode Mata Kuliah</th>
                                <th>Nama Mata Kuliah</th>
                                <th>Jumlah SKS</th>
                                <th>Semester</th>
                                <th>Program Studi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($matkul as $m) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $m['kode_matkul']; ?></td>
                                    <td><?= $m['matkul']; ?></td>
                                    <td><?= $m['jumlah_sks']; ?></td>
                                    <td><?= $m['semester']; ?></td>
                                    <td><?= $m['prodi']; ?></td>
                                    <td>
                                        <a href="/admin/matkul/edit/<?= $m['id_matkul']; ?>" class="btn btn-warning btn-rounded btn-icon">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <button data-id="<?= $m['id_matkul']; ?>" data-model="matkul" type="submit" class="btn btn-danger btn-rounded btn-icon delete">
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