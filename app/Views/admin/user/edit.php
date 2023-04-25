<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<div class="card">
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Data User</h4>
                <form class="forms-sample">
                    <div class="form-group">
                        <label for="exampleInputName1">Nama User</label>
                        <input type="text" class="form-control" id="exampleInputName1" placeholder="Nama User">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail3">Email</label>
                        <input type="email" class="form-control" id="exampleInputEmail3" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword4">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword4" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="exampleSelectGender">Role</label>
                        <select class="form-control" id="exampleSelectGender">
                            <option>Pilih Role</option>
                            <option>Admin</option>
                            <option>Dosen</option>
                            <option>Gugus Kendali Mutu</option>
                            <option>Panitia</option>
                            <option>Pengawas</option>
                            <option>Koordinator</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>