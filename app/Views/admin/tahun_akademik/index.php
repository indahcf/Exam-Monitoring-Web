<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Data Tahun Akademik</h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="tahun_akademik" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun</th>
                                <th>Semester</th>
                                <th>Aktif</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2022/2023</td>
                                <td>2</td>
                                <td>true</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-rounded btn-icon">
                                        <i class="ti-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-rounded btn-icon">
                                        <i class="ti-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>2023/2024</td>
                                <td>1</td>
                                <td>false</td>
                                <td>
                                    <button type="button" class="btn btn-warning btn-rounded btn-icon">
                                        <i class="ti-pencil"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-rounded btn-icon">
                                        <i class="ti-trash"></i>
                                    </button>
                                </td>
                            </tr>
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