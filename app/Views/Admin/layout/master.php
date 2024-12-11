<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport" />
    <title>Ecommerce Dashboard &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/fontawesome/css/all.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />


    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/jqvmap/dist/jqvmap.min.css">
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/summernote/summernote-bs4.css">
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/select2/dist/css/select2.min.css">
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/jquery-selectric/selectric.css">




    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/css/components.css">

    <!-- Toastr Css -->
    <link rel="stylesheet" href="/magento-ecommerce/public/include/css/toastr.min.css" />
    <!-- DataTable Css -->
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/dropzonejs/dropzone.css">

    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11">
    </script>



    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->



</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <!-- Navbar -->
            <?php

            use Libs\Session;
            use Libs\Route;

            include_once 'partials/navbar.php'
            ?>

            <!-- Sidebar -->
            <?php
            include_once 'partials/sidebar.php'
            ?>

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <?php
                    require_once APP_PATH . "Views" . DS . $this->fileView . ".php"; ?>
                </section>
            </div>
            <?php

            ?>
            <!-- Footer -->
            <?php
            include_once 'partials/footer.php'
            ?>
        </div>
    </div>

    <!-- General JS Scripts -->
    <!-- <script src="<?= ADMIN_URL ?>assets/modules/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/popper.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/tooltip.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/moment.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="<?= ADMIN_URL ?>assets/modules/jquery.sparkline.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/chart.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/summernote/summernote-bs4.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/select2/dist/js/select2.full.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>


    <script src="<?= ADMIN_URL ?>assets/js/page/modules-ion-icons.js"></script>
    <!-- Template JS File -->
    <script src="<?= ADMIN_URL ?>assets/js/scripts.js"></script>
    <script src="<?= ADMIN_URL ?>assets/js/custom.js"></script>

    <!-- DataTable JS  -->
    <script src="<?= ADMIN_URL ?>assets/modules/datatables/datatables.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <!-- <script src="<?= ADMIN_URL ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script> -->

    <script src="<?= ADMIN_URL ?>assets/js/page/modules-datatables.js"></script>

    <!-- Toastr Js -->
    <script src="/magento-ecommerce/public/include/js/toastr.min.js"></script>

    <!-- Customer -->
    <script src="<?= ADMIN_URL ?>assets/js/customer/main.js"></script>


    <!-- Page Specific JS File -->
    <script src="<?= ADMIN_URL ?>assets/js/page/index.js"></script>


    <script src="<?= ADMIN_URL ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

    <script src="<?= ADMIN_URL ?>assets/modules/dropzonejs/min/dropzone.min.js"></script>

    <script src="<?= $this->js ?? "hahaha" ?>"></script>

    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    <script>
        toastr.options = {
            "closeButton": true,
            "debug": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
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

        <?php
        $errors = Session::getSession('errors');
        if (!empty($errors)) {
            foreach ($errors as $error) {
        ?>
                toastr.error("<?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>");
        <?php
                Session::deleteSession('errors');
            }
        }

        ?>
    </script>

    <script>
        // let table = new DataTable("#myTable");


        // ChangeStatus
        function changeStatus(id, url) {
            urlPath = "<?= ROOT_URL ?>admin/" + url + "/changeStatus/" + id;

            $.ajax({
                type: "POST",
                url: urlPath,
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                    } else if (response.status === 'error') {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);

                }
            });
        }
        /** ChangeStatusFeature */
        function changeStatusIsFeature(id, url) {
            urlPath = "/magento-ecommerce/admin/" + url + "/changeStatusIsFeature/" + id;
            console.log(urlPath);

            $.ajax({
                type: "POST",
                url: urlPath,
                dataType: "json",
                success: function(response) {
                    console.log(response);

                    if (response.status === "success") {
                        toastr.success(response.message);
                    } else if (response.status === "error") {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                },
            });
        }


        // Delete Item
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
        // Dropzone has been added as a global variable.
        const dropzone = new Dropzone("form.my-dropzone", {
            url: "/file/post"
        });
    </script>
</body>

</html>