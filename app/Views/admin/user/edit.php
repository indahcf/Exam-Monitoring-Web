<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data User</h4>
                <form action="<?= base_url('/admin/user/update/' . $users['id']); ?>" method="post" class="forms-sample" id="form-edit">
                    <?= csrf_field(); ?>
                    <!-- <input type="hidden" name="id" value="<?= $users['id']; ?>"> -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $users['email']); ?>" placeholder="Email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control <?= (validation_show_error('role')) ? 'is-invalid' : ''; ?>" id="role" name="role[]" data-allow-clear="1" multiple>
                            <option value="">Pilih Role</option>
                            <?php foreach ($data_role as $dr) : ?>
                                <option value="<?= $dr['id_role']; ?>" <?= in_array($dr['id_role'], old('role', $role)) ? 'selected' : ''; ?>>
                                    <?= $dr['role'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback">
                            <?= validation_show_error('role'); ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2 edit">Simpan</button>
                </form>

                <script>
                    $(document).ready(function() {
                        $('#role').each(function() {
                            $(this).select2({
                                theme: 'bootstrap4',
                                width: 'style',
                                placeholder: $(this).attr('placeholder'),
                                allowClear: Boolean($(this).data('allow-clear')),
                            });
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>