<?= $this->extend('template/index'); ?>

<?= $this->section('content'); ?>

<h4 class="card-title">Data Jadwal Ujian</h4>
<div class="template-demo">
    <a href="" class="btn btn-primary btn-icon-text">
        <i class="ti-plus btn-icon-prepend"></i>
        Tambah
    </a>
</div>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="matkul" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Jam</th>
                                <th>Kode Mata Kuliah</th>
                                <th>Mata Kuliah</th>
                                <th>Program Studi</th>
                                <th>Dosen</th>
                                <th>Kelas</th>
                                <th>Ruang</th>
                                <th>Jumlah Peserta</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Senin</td>
                                <td>10 April 2023</td>
                                <td>08.00 - 09.30</td>
                                <td>TKG20212</td>
                                <td>Geofisika Umum</td>
                                <td>Teknik Geologi</td>
                                <td>Eko Bayu Purwasatriya</td>
                                <td>A</td>
                                <td>E.101</td>
                                <td>15</td>
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
                                <td>Senin</td>
                                <td>10 April 2023</td>
                                <td>08.00 - 09.30</td>
                                <td>TKG20212</td>
                                <td>Geofisika Umum</td>
                                <td>Teknik Geologi</td>
                                <td>Eko Bayu Purwasatriya</td>
                                <td>B</td>
                                <td>E.102</td>
                                <td>20</td>
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
                            $('#matkul').DataTable();
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>