<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Register &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/jquery-selectric/selectric.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/css/components.css">

    <link rel="stylesheet" href="/magento-ecommerce/public/include/css/toastr.min.css" />

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
        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                        <div class="login-brand">
                            <img src="<?= ADMIN_URL ?>assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Register</h4>
                            </div>
                            <div class="card-body">
                                <form action="<?= ROOT_URL ?>register" method="POST" class="needs-validation" novalidate="">
                                    <div class="form-group ">
                                        <label for="fullname">Full Name <span class="text-danger">*</span></label>
                                        <input id="fullname" type="text" class="form-control" name="fullname" tabindex="1" required autofocus value="<?= $data['fullname'] ?? "" ?>">
                                        <div class="invalid-feedback">
                                            Please fill in your fullname
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email <span class="text-danger">*</span></label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required value="<?= $data['email'] ?? "" ?>">
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="password" class="d-block">Password <span class="text-danger">*</span></label>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="1" required>
                                        <div class="invalid-feedback">
                                            Please fill in your pasword
                                        </div>
                                    </div>

                                    <div class="form-group ">
                                        <label for="password2" class="d-block">Password Confirmation <span class="text-danger">*</span></label>
                                        <input id="password2" type="password" class="form-control" name="password-confirm" tabindex="1" required>
                                        <div class="invalid-feedback">
                                            Please fill in your password-confirm
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block">
                                            Register
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; Stisla 2018
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= ADMIN_URL ?>assets/modules/jquery.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/popper.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/tooltip.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/moment.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/js/stisla.js"></script>

    <!-- JS Libraies -->
    <script src="<?= ADMIN_URL ?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
    <script src="<?= ADMIN_URL ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>

    <!-- Page Specific JS File -->
    <script src="<?= ADMIN_URL ?>assets/js/page/auth-register.js"></script>
    <script src="/magento-ecommerce/public/include/js/toastr.min.js"></script>

    <!-- Template JS File -->
    <script src="<?= ADMIN_URL ?>assets/js/scripts.js"></script>
    <script src="<?= ADMIN_URL ?>assets/js/custom.js"></script>


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

        use Libs\Session;

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

        $(document).ready(function() {
            $("input[type='password']").on("keydown", function(e) {
                if (e.key === " ") {
                    e.preventDefault(); // Ngăn không cho nhập khoảng trắng
                }
            });


        })
    </script>
</body>

</html>