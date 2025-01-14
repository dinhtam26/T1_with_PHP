<!DOCTYPE html>
<html
    lang="en"
    data-layout="vertical"
    data-topbar="light"
    data-sidebar="dark"
    data-sidebar-size="lg"
    data-sidebar-image="none"
    data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>CRM | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?= ADMIN_URL ?>assets/images/favicon.ico" />

    <!-- dropzone css -->
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/libs/dropzone/dropzone.css" type="text/css" />

    <!-- Layout config Js -->
    <script src="<?= ADMIN_URL ?>assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="<?= ADMIN_URL ?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="<?= ADMIN_URL ?>assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="<?= ADMIN_URL ?>assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="<?= ADMIN_URL ?>assets/css/custom.min.css" rel="stylesheet" type="text/css" />
    <!-- Toastr Css -->
    <link rel="stylesheet" href="/magento-ecommerce/public/include/css/toastr.min.css" />

    <link rel="stylesheet" href="/magento-ecommerce/public/include/css/upload.css">
</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">

        <!-- Navbar -->
        <?php

        use Libs\Session;

        include_once 'partials/navbar.php'
        ?>
        <!-- removeNotificationModal -->
        <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                            id="NotificationModalbtn-close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mt-2 text-center">
                            <lord-icon
                                src="https://cdn.lordicon.com/gsqxdxog.json"
                                trigger="loop"
                                colors="primary:#f7b84b,secondary:#f06548"
                                style="width: 100px; height: 100px"></lord-icon>
                            <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                                <h4>Are you sure ?</h4>
                                <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                            </div>
                        </div>
                        <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                            <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!</button>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!-- ========== Sidebar ========== -->
        <?php
        include_once 'partials/sidebar.php'
        ?>


        <div class="vertical-overlay"></div>

        <!-- Start right Content here -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <?php require_once APP_PATH . "Views" . DS . $this->fileView . ".php"; ?>
                </div>
            </div>

            <!-- Footer -->
            <?php
            include_once 'partials/footer.php'
            ?>
        </div>
    </div>

    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!-- JAVASCRIPT -->
    <script src="<?= ADMIN_URL ?>assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/libs/simplebar/simplebar.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/libs/node-waves/waves.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/libs/feather-icons/feather.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="<?= ADMIN_URL ?>assets/js/plugins.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- dropzone min -->
    <script src="<?= ADMIN_URL ?>assets/libs/dropzone/dropzone-min.js"></script>

    <script src="<?= ADMIN_URL ?>assets/js/pages/form-file-upload.init.js"></script>

    <!-- Validate form -->
    <script src="<?= ADMIN_URL ?>assets/js/pages/form-validation.init.js"></script>

    <!-- App js -->
    <script src="<?= ADMIN_URL ?>assets/js/app.js"></script>

    <script src="/magento-ecommerce/public/include/js/upload.js"></script>

    <!-- Toastr Js -->
    <script src="/magento-ecommerce/public/include/js/toastr.min.js"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-center",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3500",
            "extendedTimeOut": "8000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        <?php
        $success = Session::getSession('success');
        if (!empty($success)) {
        ?>
            toastr.success("<?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?>");
        <?php
            Session::deleteSession('success');
        }
        ?>

        $(document).ready(function() {
            $(".delete_item").on('click', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');


                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            type: "GET",
                            url: url,
                            dataType: "json",
                            success: function(response) {
                                if (response.status === 'success') {
                                    toastr.success(response.message);
                                    $("#item-" + response.id).hide(1000);
                                } else if (response.status === 'error') {
                                    toastr.error(response.message);
                                }
                            },
                            error: function(xhr, status, error) {
                                console.error(error);
                            },
                        });
                    }
                });
            })
        });
    </script>


</body>

</html>