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

    <!-- select2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
    <link href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css" rel="stylesheet">

    <!-- export excel datatable -->
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
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

    <script src="<?= base_url(); ?>/assets/vendors/jquery-3.5.1/jquery-3.5.1.min.js "></script>
    <!-- plugins:js -->
    <script src="<?= base_url(); ?>/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= base_url(); ?>/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= base_url(); ?>/assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= base_url(); ?>/assets/js/dataTables.select.min.js"></script>

    <script src="https://cdn.jsdelivr.net/gh/ashl1/datatables-rowsgroup@fbd569b8768155c7a9a62568e66a64115887d7d0/dataTables.rowsGroup.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= base_url(); ?>/assets/js/off-canvas.js"></script>
    <script src="<?= base_url(); ?>/assets/js/hoverable-collapse.js"></script>
    <script src="<?= base_url(); ?>/assets/js/template.js"></script>
    <script src="<?= base_url(); ?>/assets/js/settings.js"></script>
    <script src="<?= base_url(); ?>/assets/js/todolist.js"></script>
    <!-- endinject -->
    <script src="<?= base_url(); ?>/assets/js/sweetalert2.all.min.js"></script>

    <!-- select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <script>
        $(".select-tag").select2({
            tags: true,
            tokenSeparators: [',', ' '],
            width: '100%',
            theme: "bootstrap4"
        })
    </script>

    <!-- export excel datatable -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

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
                Swal.fire({
                    title: 'LOGOUT',
                    text: 'Apakah Anda yakin untuk keluar aplikasi?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.replace("<?= base_url('/logout'); ?>")
                    }
                })
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $('body').on("click", '.delete', function(e) {
                Swal.fire({
                    title: 'DELETE',
                    text: "Apakah Anda yakin akan menghapus?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        let id = $(this).data('id')
                        let model = $(this).data('model')
                        $.ajax({
                            url: "/admin/" + model + "/" + id,
                            type: "DELETE",
                            success: function() {
                                Swal.fire(
                                    'Success!',
                                    'Data Berhasil Dihapus',
                                    'success'
                                ).then(function() {
                                    location.reload()
                                })
                            },
                            error: function(xhr, ajaxOptions, thrownError) {
                                Swal.fire(
                                    'Oops!',
                                    xhr.responseJSON.message,
                                    'error'
                                ).then(function() {
                                    location.reload()
                                })
                            }
                        });
                    }
                })
            });
        })
    </script>

    <script>
        $(document).ready(function() {
            $('body').on("click", '.edit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'EDIT',
                    text: "Apakah Anda yakin ingin mengubah data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#form-edit').trigger('submit')
                    }
                })
            });
        })
    </script>
</body>

</html>