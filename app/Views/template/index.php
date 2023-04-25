<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $title; ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= base_url(); ?>/assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/vertical-layout-light/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/vertical-layout-light/style_baru.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= base_url(); ?>/assets/images/logo_unsoed.png" />
    <link href="https://cdn.jsdelivr.net/npm/@sweetalert2/theme-bootstrap-4@5.0.15/bootstrap-4.min.css" rel="stylesheet">
</head>

<body>
    <div class="container-scroller">

        <?= $this->include('template/navbar'); ?>

        <div class="container-fluid page-body-wrapper">

            <?= $this->include('template/sidebar') ?>

            <div class="main-panel">
                <div class="content-wrapper">
                    <?= $this->renderSection('content'); ?>
                </div>
                <!-- content-wrapper ends -->

                <?= $this->include('template/footer'); ?>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <script src="/assets/vendors/jquery-3.5.1/jquery-3.5.1.min.js "></script>
    <!-- plugins:js -->
    <script src="<?= base_url(); ?>/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url(); ?>/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url(); ?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url(); ?>/assets/js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url(); ?>/assets/js/off-canvas.js"></script>
    <script src="<?= base_url(); ?>/assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url(); ?>/assets/js/template.js"></script>
    <script src="<?= base_url(); ?>/assets/js/settings.js"></script>
    <script src="<?= base_url(); ?>/assets/js/todolist.js"></script>
    <!-- endinject -->
    <script src="<?= base_url(); ?>/assets/js/sweetalert2.all.min.js"></script>

    <?php if (session()->getFlashdata('success')) : ?>
        <script>
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Sukses',
                text: "<?= session()->getFlashdata('success'); ?>",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    <?php elseif (session()->getFlashdata('error')) : ?>
        <script>
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'Oopss...',
                text: "<?= session()->getFlashdata('error'); ?>",
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    <?php endif; ?>

    <script>
        $(document).ready(function() {
            $('body').on("click", '#logout', function(e) {
                e.preventDefault();

                Swal.fire({
                    title: 'Apakah Anda yakin untuk keluar aplikasi?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {

                        location.replace(location.origin + "/logout")
                    }
                })
            });
        })
    </script>
</body>

</html>