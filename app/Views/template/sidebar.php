<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url(''); ?>">
                <i class="ti-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <?php if (count(array_intersect(user()->roles, ['Admin'])) > 0) : ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-master" aria-expanded="false" aria-controls="ui-master">
                    <i class="ti-server menu-icon"></i>
                    <span class="menu-title">Data Master</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-master">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/prodi'); ?>">Program Studi</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/dosen'); ?>">Dosen</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/pengawas_ujian'); ?>">Pengawas</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/user'); ?>">User</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/pencetak_soal'); ?>">Pencetak Soal</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/matkul'); ?>">Mata Kuliah</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/kelas'); ?>">Kelas</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/ruang_ujian'); ?>">Ruang Ujian</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/tahun_akademik'); ?>">Tahun Akademik</a></li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/jadwal_ujian'); ?>">
                    <i class="ti-calendar menu-icon"></i>
                    <span class="menu-title">Jadwal Ujian</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (count(array_intersect(user()->roles, ['Admin', 'Dosen'])) > 0) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/soal_ujian'); ?>">
                    <i class="ti-file menu-icon"></i>
                    <span class="menu-title">Soal Ujian</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (count(array_intersect(user()->roles, ['Admin', 'Gugus Kendali Mutu'])) > 0) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/review_soal'); ?>">
                    <i class="ti-book menu-icon"></i>
                    <span class="menu-title">Review Soal Ujian</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (count(array_intersect(user()->roles, ['Admin', 'Pencetak Soal'])) > 0) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/print_soal'); ?>">
                    <i class="ti-import menu-icon"></i>
                    <span class="menu-title">Cetak Soal Ujian</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (count(array_intersect(user()->roles, ['Admin', 'Koordinator'])) > 0) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/kehadiran_pengawas'); ?>">
                    <i class="ti-lock menu-icon"></i>
                    <span class="menu-title">Kehadiran Pengawas</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (count(array_intersect(user()->roles, ['Admin', 'Pengawas', 'Koordinator', 'Ketua Panitia'])) > 0) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/kehadiran_peserta'); ?>">
                    <i class="ti-user menu-icon"></i>
                    <span class="menu-title">Kehadiran Peserta</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (count(array_intersect(user()->roles, ['Admin', 'Dosen', 'Pendistribusi Hasil Ujian'])) > 0) : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/distribusi_hasil_ujian'); ?>">
                    <i class="ti-write menu-icon"></i>
                    <span class="menu-title">Distribusi Hasil Ujian</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<!-- partial -->