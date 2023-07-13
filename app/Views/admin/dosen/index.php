<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Dosen</h4>
<div class="template-demo">
    <a href="/admin/dosen/create" class="btn btn-primary btn-icon-text">
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
                    <table id="dosen" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIDN</th>
                                <th>Nama Dosen</th>
                                <th>Program Studi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($dosen as $d) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $d['nidn']; ?></td>
                                    <td><?= $d['dosen']; ?></td>
                                    <td><?= $d['prodi']; ?></td>
                                    <td>
                                        <a href="/admin/dosen/edit/<?= $d['id_dosen']; ?>" class="btn btn-warning btn-rounded btn-icon">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <button data-id="<?= $d['id_dosen']; ?>" data-model="dosen" type="submit" class="btn btn-danger btn-rounded btn-icon delete">
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
                            $('#dosen').DataTable({
                                "scrollX": true
                            });

                            $('.form_modal').submit(function(e) {
                                e.preventDefault();
                                $.ajax({
                                    type: "post",
                                    url: $(this).attr('action'),
                                    enctype: 'multipart/form-data',
                                    data: new FormData(this),
                                    processData: false,
                                    contentType: false,
                                    success: function(response) {
                                        if (response.error) {
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
                                $('#file_excel').removeClass('is-invalid');
                                $('.errorFileExcel').html('');
                                $('input[name=fileexcel]').val('')
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
                <h5 class="modal-title" id="exampleModalLabel">Import Data Dosen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="<?= base_url('/admin/dosen/simpanExcel') ?>" enctype="multipart/form-data" class="form_modal">
                <div class="modal-body">
                    <label for="file_excel">File Excel</label>
                    <input type="file" class="form-control-file" name="fileexcel" id="file_excel" accept=".xls, .xlsx">
                    <div class="invalid-feedback errorFileExcel">
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