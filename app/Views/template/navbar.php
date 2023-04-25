<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="index.html"><img src="<?= base_url(); ?>/assets/images/logo_unsoed.png" class="mr-2" alt="logo" /><b>SIMONJI</b></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="<?= base_url(); ?>/assets/images/logo_unsoed.png" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle d-flex flex-row align-items-center" href="#" data-toggle="dropdown" id="profileDropdown">
                    <img class="mr-2" src="<?= base_url(); ?>/assets/images/profile.jpg" alt="profile" />
                    <div>
                        <p class="m-0 text-black"><?= user()->email; ?></p>
                        <span class="badge bg-primary text-light"><?= user()->role; ?></span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <button class="dropdown-item">
                        <i class="ti-settings text-primary"></i>
                        Ubah Password
                    </button>
                    <button class="dropdown-item" href="<?= base_url('logout'); ?>" id="logout">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </button>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>

<script src="/assets/vendors/jquery-3.5.1/jquery-3.5.1.min.js "></script>
<!-- partial -->