<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <?php if (user()->role == 'Admin') : ?>
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url(''); ?>">
                    <i class="ti-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="ti-server menu-icon"></i>
                    <span class="menu-title">Data Master</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/user'); ?>">Data User</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/prodi'); ?>">Data Program Studi</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/matkul'); ?>">Data Mata Kuliah</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/dosen'); ?>">Data Dosen</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/kelas'); ?>">Data Kelas</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/ruang_ujian'); ?>">Data Ruang Ujian</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('admin/pengawas'); ?>">Data Pengawas</a></li>
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
            <li class="nav-item">
                <a class="nav-link" href="<?= base_url('admin/soal_ujian'); ?>">
                    <i class="ti-file menu-icon"></i>
                    <span class="menu-title">Soal Ujian</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (user()->role == 'Dosen') : ?>
            <li class="nav-item">
                <a class="nav-link" href="#tables">
                    <i class="ti-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#tables">
                    <i class="ti-file menu-icon"></i>
                    <span class="menu-title">Soal Ujian</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (user()->role == 'Gugus Kendali Mutu') : ?>
            <li class="nav-item">
                <a class="nav-link" href="#icons">
                    <i class="ti-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#auth">
                    <i class="ti-file menu-icon"></i>
                    <span class="menu-title">Soal Ujian</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (user()->role == 'Panitia') : ?>
            <li class="nav-item">
                <a class="nav-link" href="#error">
                    <i class="ti-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/documentation/documentation.html">
                    <i class="ti-file menu-icon"></i>
                    <span class="menu-title">Soal Ujian</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="ti-user menu-icon"></i>
                    <span class="menu-title">Kehadiran</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('panitia/kehadiran_peserta'); ?>">Kehadiran Peserta</a></li>
                        <li class="nav-item"> <a class="nav-link" href="<?= base_url('panitia/kehadiran_pengawas'); ?>">Kehadiran Pengawas</a></li>
                    </ul>
                </div>
            </li>
        <?php endif; ?>

        <?php if (user()->role == 'Pengawas') : ?>
            <li class="nav-item">
                <a class="nav-link" href="#error">
                    <i class="ti-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/documentation/documentation.html">
                    <i class="ti-user menu-icon"></i>
                    <span class="menu-title">Kehadiran Peserta</span>
                </a>
            </li>
        <?php endif; ?>

        <?php if (user()->role == 'Koordinator') : ?>
            <li class="nav-item">
                <a class="nav-link" href="#error">
                    <i class="ti-home menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/documentation/documentation.html">
                    <i class="ti-user menu-icon"></i>
                    <span class="menu-title">Kehadiran Peserta</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="pages/documentation/documentation.html">
                    <i class="ti-user menu-icon"></i>
                    <span class="menu-title">Kehadiran Pengawas</span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</nav>
<!-- partial -->