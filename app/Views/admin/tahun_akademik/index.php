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
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input status" checked>
                                            <label class="custom-control-label" for="status"><?= $t['status'] == '1' ? 'Aktif' : 'Tidak Aktif'; ?></label>
                                        </div>
                                    </td>
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

                    <script>
                        $(document).ready(function() {
                            $('#status').boostrapToggle({
                                on: 'Aktif',
                                off: 'Tidak Aktif',
                                onstyle: 'primary',
                                offstyle: 'info'
                            });

                            $('#status').change(function() {
                                if ($(this).prop('checked')) {
                                    $('.status').val('Aktif');
                                } else {
                                    $('.status').val('Tidak Aktif');
                                }
                            });

                            $('#insert_data').on('submit', function(event)) {
                                event.preventDefault();

                                $.ajax({

                                    url: "insert.php"
                                    method: "POST"
                                    data: $(this).serialize(),
                                    success: function(data) {

                                        if (data == 'done') {
                                            $('#insert_data')[0].reset();
                                            $('#status').bootstrapToggle('on');
                                        }
                                    }
                                });
                            };
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>