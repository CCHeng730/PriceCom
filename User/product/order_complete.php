<?php
ob_start();
include_once("../../connection.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <base href="../../">
        <meta charset="utf-8" />
        <title>PriceCom</title>
        <link href="assets/app.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <link rel="stylesheet" type="text/css" href="assets/user/css/font-icons.min.css">
        <link rel="stylesheet" type="text/css" href="assets/user/css/theme-vendors.min.css">
        <link rel="stylesheet" type="text/css" href="assets/user/css/style.css" />
        <link rel="stylesheet" type="text/css" href="assets/user/css/responsive.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="tw-bg-gray-50">
            <?php include "../layout/header.php" ?>
            <div class="tw-inset-0 tw-bg-center tw-bg-cover tw-w-full tw-bg-no-repeat" style="background-image: url('assets/image/bg-01.jpg');">
                <div class="container-fluid tw-bg-black tw-w-full tw-h-full tw-bg-opacity-20" style="padding-left: 70px; padding-right: 70px; padding-top: 20%; padding-bottom:50px">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-lg-9">
                                <div style="font-size: 30px;" class="tw-ml-5 tw-text-white tw-font-bold ">Order Completed</div>
                            </div>
                            <div class="col-lg-3">
                                <ul class="d-flex justify-content-lg-end">
                                    <li>
                                        <a style="font-size: 20px" class="font-weight-600 tw-text-white tw-no-underline" href="#">Home</a>
                                    </li>
                                    <li class="tw-flex">
                                        <i style="margin-top: 5px; font-size: 20px" class="fa fa-angle-right tw-text-white ml-2 mr-2" aria-hidden="true"></i>
                                        <div style="font-size: 20px" class="font-weight-600 tw-text-gray-300 tw-no-underline">Profile</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
            <div class="container tw-my-32">
                <div class="tw-text-center">
                    <i style="font-size: 90px;" class="far fa-check-circle"></i>
                    <div style="font-size: 30px;" class="tw-my-6 tw-font-semibold tw-text-black">Your Order Is Completed!</div>
                    <div style="font-size: 15px;" class="tw-mb-8">Thank you for your order! Your order is being processed and will <br>be completed within 3-6 hours.</div>
                    <a href="User/index.php" class="tw-no-underline tw-font-semibold tw-rounded tw-px-6 tw-py-3 tw-text-white tw-bg-gray-700 hover:tw-text-white tw-bg-gradient-to-b hover:tw-from-black hover:tw-to-gray-500">Back to Homepage</a>
                </div>
            </div>
        </div>
        <?php include "../layout/footer.php" ?>
    </body>
    <script type="text/javascript" src="assets/user/js/theme-vendors.min.js"></script>
    <script type="text/javascript" src="assets/user/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/user/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>