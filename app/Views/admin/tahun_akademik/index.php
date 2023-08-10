<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Tahun Akademik</h4>
<div class="template-demo">
    <a href="<?= base_url(); ?>admin/tahun_akademik/create" class="btn btn-primary btn-icon-text">
        <i class="ti-plus btn-icon-prepend"></i>
        Tambah
    </a>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div>
                    <table id="tahun_akademik" class="table table-striped w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tahun Akademik</th>
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
                                    <td><?= $t['tahun_akademik']; ?></td>
                                    <td><?= $t['semester']; ?></td>
                                    <td>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input status" name="status" id="status-<?= $t['id_tahun_akademik']; ?>" data-id="<?= $t['id_tahun_akademik']; ?>" <?= $t['status'] == '1' ? 'disabled' : ''; ?> <?= $t['status'] == '1' ? 'checked' : ''; ?>>
                                            <label class="custom-control-label label_status" data-id="<?= $t['id_tahun_akademik']; ?>" for="status-<?= $t['id_tahun_akademik']; ?>"><?= $t['status'] == '1' ? 'Aktif' : 'Tidak Aktif'; ?></label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?= base_url(); ?>admin/tahun_akademik/edit/<?= $t['id_tahun_akademik']; ?>" type="button" class="btn btn-warning btn-rounded btn-icon">
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

                    <script src="<?= base_url(); ?>/assets/vendors/jquery-3.5.1/jquery-3.5.1.min.js "></script>

                    <script>
                        $(document).ready(function() {
                            $('#tahun_akademik').DataTable({
                                "scrollX": true
                            });
                        });
                    </script>

                    <script>
                        $(document).ready(function() {
                            $('input[name=status]').on('change', function() {
                                let id = $(this).data('id');
                                // ubah label yg diklik jadi aktif 
                                $(this).next().text('Aktif');
                                // disable input yg sudah aktif 
                                $(this).prop('disabled', true);
                                // uncheck input, enable iput, dan ubah label jadi tidak aktif di tahun akademik yg lain 
                                $('input[name=status]').each((i, el) => {
                                    if ($(el).data('id') != id) {
                                        $(el).prop('checked', false)
                                        $(el).prop('disabled', false)
                                        $(el).next().text('Tidak Aktif');
                                    }
                                });
                                console.log('id', id)
                                $.ajax({
                                    url: "/admin/tahun_akademik/update_status/" + id,
                                    type: "POST",
                                    success: function(response) {
                                        if (response.success) {
                                            Swal.fire(
                                                'Success!',
                                                response.message,
                                                'success'
                                            ).then(function() {
                                                // location.reload()
                                            })
                                        } else {
                                            Swal.fire(
                                                'Oops!',
                                                response.message,
                                                'error'
                                            ).then(function() {
                                                location.reload()
                                            })
                                        }

                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        Swal.fire(
                                            'Oops!',
                                            'Gagal diaktifkan!',
                                            'error'
                                        ).then(function() {
                                            location.reload()
                                        })
                                    }
                                });
                            })
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>