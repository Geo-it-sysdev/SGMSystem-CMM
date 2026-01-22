<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grading Management System</title>
    <link rel="shortcut icon" href="<?= base_url('assets/images/CMMBG1-removebg.png'); ?>" />
    <!--=============== REMIXICONS ===============-->
    <link href="<?php echo base_url('assets/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
    <!-- SweetAlert CSS -->
    <link href="<?php echo base_url('assets/libs/sweetalert2/sweetalert2.min.css'); ?>" rel="stylesheet"
        type="text/css" />
    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>">
    <!-- Layout config Js -->
    <script src="<?php echo base_url('assets/js/layout.js'); ?>"></script>


</head>

<body>
    <!--===============SIDE LOGIN IMAGE ===============-->
    <svg class="login__blob" viewBox="0 0 566 840" xmlns="http://www.w3.org/2000/svg">
        <mask id="mask0" mask-type="alpha">
            <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538 
      0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393 
      591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824 
      167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z" />
        </mask>

        <g mask="url(#mask0)">
            <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538 
      0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393 
      591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824 
      167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z" />

            <image class="login__img" href="<?php echo base_url('assets/images/CMMSYSTEM.png'); ?>" width="830"
                height="840" preserveAspectRatio="xMidYMid slice" />
        </g>
    </svg>
    <!--===============END SIDE LOGIN IMAGE ===============-->

    <!--=============== LOGIN ===============-->
    <div class="login container grid" id="loginAccessRegister">
        <!--===== LOGIN ACCESS =====-->
        <div class="login__access">
            <!-- <h6 class="login__title">Pharma - Reordering Management System</h6> -->
            <div class="navbar-brand-box horizontal-logo">
                <a href="#" class="logo logo-dark">
                    <span class="logo-sm ">
                        <img src="<?= base_url('assets/images/CMMBG1.png'); ?>" alt="Pharma Logo" width="250"
                            height="130" style="margin-left: 16%;" />
                    </span>
                </a>
            </div>
            <br>
            <div class="login__area">
                <form action="<?= base_url('AuthController/login'); ?>" method="POST" class="login__form">
                    <div class="login__content grid">
                        <div class="login__box">
                            <input type="text" id="username" name="username" required placeholder=" "
                                class="login__input">
                            <label for="username" class="login__label">Username</label>
                            <i class="ri-user-line login__icon"></i>
                        </div>

                        <div class="login__box">
                            <input type="password" id="password" name="password" required placeholder=" "
                                class="login__input">
                            <label for="password" class="login__label">Password</label>
                            <i class="ri-eye-off-fill login__icon login__password" id="loginPassword"></i>
                        </div>
                    </div>



                    <!-- <a href="#" class="login__forgot">Forgot your password?</a> -->
                    <button type="submit" class="login__button">Login</button>
                </form>




                <p class="login__switch">
                    <script>
                    document.write(new Date().getFullYear())
                    </script> © Student - Grading Management System. ❤ Design by Love
                </p>
            </div>
        </div>

        <!--===============END LOGIN FORM ===============-->


        <!--===== LOGIN REGISTER FORM =====-->
        <div class="login__register">
            <h1 class="login__title">Create new account.</h1>

            <div class="login__area">
                <form action="" class="login__form">
                    <div class="login__content grid">
                        <div class="login__group grid">
                            <div class="login__box">
                                <input type="text" id="names" required placeholder=" " class="login__input">
                                <label for="names" class="login__label">Names</label>

                                <i class="ri-id-card-fill login__icon"></i>
                            </div>

                            <div class="login__box">
                                <input type="text" id="surnames" required placeholder=" " class="login__input">
                                <label for="surnames" class="login__label">Surnames</label>

                                <i class="ri-id-card-fill login__icon"></i>
                            </div>
                        </div>

                        <div class="login__box">
                            <input type="text" id="emailCreate" required placeholder=" " class="login__input">
                            <label for="emailCreate" class="login__label">Email</label>

                            <i class="ri-mail-fill login__icon"></i>
                        </div>

                        <div class="login__box">
                            <input type="password" id="passwordCreate" required placeholder=" " class="login__input">
                            <label for="passwordCreate" class="login__label">Password</label>

                            <i class="ri-eye-off-fill login__icon login__password" id="loginPasswordCreate"></i>
                        </div>
                    </div>

                    <button type="submit" class="login__button">Create account</button>
                </form>

                <p class="login__switch">
                    Already have an account?
                    <button id="loginButtonAccess">Log In</button>
                </p>
            </div>
        </div>
        <!--=====END LOGIN REGISTER FORM=====-->
    </div>
    <!-- Sweet Alerts js -->
    <script src="<?php echo base_url('assets/libs/sweetalert2/sweetalert2.min.js'); ?>"></script>

    <!-- Sweet alert init js-->
    <script src="<?php echo base_url('assets/js/pages/sweetalerts.init.js'); ?>"></script>

    <!--=============== MAIN JS ===============-->
    <script src="<?php echo base_url('assets/js/main.js'); ?>"></script>
    <?php if ($this->session->flashdata('error')): ?>
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?= $this->session->flashdata('error'); ?>',
    });
    </script>
    <?php endif; ?>

    <?php if($this->session->flashdata('swal_error')): ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: '<?= $this->session->flashdata('swal_error'); ?>'
        });
    </script>
<?php endif; ?>

</body>

</html>