<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Pencetak Soal</h4>
<div class="template-demo">
    <a href="<?= base_url(); ?>admin/pencetak_soal/create" class="btn btn-primary btn-icon-text">
        <i class="ti-plus btn-icon-prepend"></i>
        Tambah
    </a>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div>
                    <table id="pencetak_soal" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pencetak Soal</th>
                                <th>Program Studi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($pencetak_soal as $p) : ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $p['pengawas']; ?></td>
                                    <td><?= $p['prodi']; ?></td>
                                    <td>
                                        <a href="<?= base_url(); ?>admin/pencetak_soal/edit/<?= $p['id_pencetak_soal']; ?>" class="btn btn-warning btn-rounded btn-icon">
                                            <i class="ti-pencil"></i>
                                        </a>
                                        <button data-id="<?= $p['id_pencetak_soal']; ?>" data-model="pencetak_soal" type="submit" class="btn btn-danger btn-rounded btn-icon delete">
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
                            $('#pencetak_soal').DataTable({
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