<?php
ob_start();
include_once("../../connection.php");

//check if logged in
if (isset($_SESSION['aid'])) {
    ?>
    <script>window.location.href = "../admin/index.php"</script><?php
}


if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $hashpass = "$1" . md5(md5($email)) . sha1(sha1($password));
    $adminQuery = query("select * from admin where email = '$email' and password = '$hashpass' and deleted_at is null");

    if (row($adminQuery) == 1) { //record match database
        $adminFetch = fetch($adminQuery);

        //set auth session token
        $_SESSION['aid'] = $adminFetch['id'];
        $_SESSION['super'] = $adminFetch['super'];
        //redirect to homepage
        ?>
        <script>window.location.href = "../admin/index.php"</script><?php

    } else {
        ?>
        <script>alert('Invalid account or wrong password');</script><?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <base href="../../">
    <meta charset="utf-8"/>
    <title>PriceCom | Admin</title>
    <link href="assets/app.css" rel="stylesheet" type="text/css"/>
    <link href="assets/admin/plugins/global/plugins.bundle.css" rel="stylesheet"/>
    <link href="assets/admin/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet"/>
    <link href="assets/admin/css/style.bundle.css" rel="stylesheet"/>
    <link href="assets/admin/css/themes/layout/header/base/light.css" rel="stylesheet"/>
    <link href="assets/admin/css/themes/layout/header/menu/light.css" rel="stylesheet"/>
    <link href="assets/admin/css/themes/layout/brand/dark.css" rel="stylesheet"/>
    <link href="assets/admin/css/themes/layout/aside/dark.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
<!--begin::Main-->
<div class="d-flex flex-column flex-root">
    <!--begin::Login-->
    <div class="login login-4 login-signin-on d-flex flex-row-fluid" id="kt_login">
        <div class="d-flex flex-center flex-row-fluid bgi-size-cover bgi-position-top bgi-no-repeat"
             style="background-image: url('assets/admin/media/bg/bg-4.jpg');">
            <div class="login-form text-center p-7 position-relative overflow-hidden" style="width: 23%;">
                <!--begin::Login Header-->
                <div class="d-flex flex-center tw-mb-20">
                    <div style="font-size:75px; text-shadow: #FC0 1px 0 10px;"
                         class="tw-font-bold tw-italic tw-text-black">PriceCom
                    </div>
                </div>
                <!--end::Login Header-->
                <!--begin::Login Sign in form-->
                <div class="login-signin">
                    <div class="mb-14">
                        <h3 class="tw-text-white">Sign In To Admin</h3>
                        <div class="text-muted font-weight-bold">Enter your details to login to your account:</div>
                    </div>
                    <form method="post">
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" name="email" id="email"
                                   type="email" placeholder="Email" name="email" autocomplete="email" autofocus/>
                        </div>
                        <div class="form-group mb-5">
                            <input class="form-control h-auto form-control-solid py-4 px-8" id="password"
                                   type="password" placeholder="Password" name="password" required
                                   autocomplete="current-password"/>
                        </div>
                        <button type="submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4"
                                name="submit">Sign In
                        </button>
                    </form>
                </div>
                <!--end::Login Sign in form-->
            </div>
        </div>
    </div>
</div>
</body>
<script>var HOST_URL = "https://keenthemes.com/metronic/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = {"breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="assets/admin/plugins/global/plugins.bundle.js"></script>
<script src="assets/admin/plugins/custom/prismjs/prismjs.bundle.js"></script>
<script src="assets/admin/js/scripts.bundle.js"></script>
<script type="text/javascript" src="assets/admin/plugins/custom/datatables/datatables.bundle.js" defer></script>
<script type="text/javascript" src="assets/admin/js/pages/crud/datatables/basic/scrollable.js" defer></script>
</html>