<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Data User</h4>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="user" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Nama Level</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Subekti Afrianto</td>
                                <td>bapendik@unsoed.ac.id</td>
                                <td>admin</td>
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
                                <td>Yogiek Indra Kurniawan</td>
                                <td>yogiek@unsoed.ac.id</td>
                                <td>dosen</td>
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
                            $('#user').DataTable();
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>