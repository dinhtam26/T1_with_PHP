<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Login &mdash; Stisla</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="<?= ADMIN_URL ?>assets/modules/bootstrap-social/bootstrap-social.css">

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
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="<?= ADMIN_URL ?>assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="http://localhost/magento-ecommerce/admin/login" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus value="<?= $data['email'] ?? null  ?>">
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                                <a href="auth-forgot-password.html" class="text-small">
                                                    Forgot Password?
                                                </a>
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="mt-5 text-muted text-center">
                            Don't have an account? <a href="auth-register.html">Create One</a>
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
    <script src="/magento-ecommerce/public/include/js/toastr.min.js"></script>


    <!-- JS Libraies -->

    <!-- Page Specific JS File -->

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

        <?php
        $success = Session::getSession('success');
        if (!empty($success)) {
        ?>
            toastr.success("<?php echo htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?>");
        <?php
            Session::deleteSession('success');
        }




        ?>
    </script>
</body>

</html>