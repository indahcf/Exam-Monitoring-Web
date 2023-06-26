<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Ruang Ujian</h4>
<div class="template-demo">
    <a href="/admin/ruang_ujian/create" class="btn btn-primary btn-icon-text">
        <i class="ti-plus btn-icon-prepend"></i>
        Tambah
    </a>
    <button type="button" class="btn btn-success btn-icon-text" data-toggle="modal" data-target="#modalImport">
        <i class="ti-import btn-icon-prepend"></i>
        Import
    </button>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div>
                    <table id="ruang_ujian" class="table table-striped w-100">
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
                            $('#ruang_ujian').DataTable({
                                "scrollX": true
                            });
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
                <h5 class="modal-title" id="exampleModalLabel">Import Data Ruang Ujian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?= base_url('/admin/ruang_ujian/simpanExcel') ?>" enctype="multipart/form-data">
                    <label for="file_excel">File Excel</label>
                    <input type="file" class="form-control-file" name="fileexcel" id="file_excel" required accept=".xls, .xlsx">
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