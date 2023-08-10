<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title font-weight-bold">Data User</h4>
<div class="template-demo">
    <a href="<?= base_url(); ?>admin/user/create" class="btn btn-primary btn-icon-text">
        <i class="ti-plus btn-icon-prepend"></i>
        Tambah
    </a>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div>
                    <table id="user" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($users as $u) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $u['fullname']; ?></td>
                                    <td><?= $u['email']; ?></td>
                                    <td><?= $u['role']; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>admin/user/edit/<?= $u['id']; ?>" class="btn btn-warning btn-rounded btn-icon">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <button data-id="<?= $u['id']; ?>" data-model="user" type="submit" class="btn btn-danger btn-rounded btn-icon delete">
                                            <i class="ti-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <script src="<?= base_url(); ?>/assets/vendors/jquery-3.5.1/jquery-3.5.1.min.js "></script>

                    <script>
                        $(document).ready(function() {
                            $('#user').DataTable({
                                "scrollX": true
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>