<?php
ob_start();
include_once("../connection.php");

if(!isset($_SESSION['uid'])) { //check if logged in
    ?><script>window.location.href="auth/login.php"</script><?php
}

$categoryQuery = query("select * from category where deleted_at IS NULL");

?>
<!DOCTYPE html>
<html>
    <head>
        <base href="../">
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
            <?php include "layout/header.php" ?>
            <div class="tw-inset-0 tw-bg-center tw-bg-cover tw-w-full tw-bg-no-repeat" style="background-image: url('assets/image/bg-01.jpg');">
                <div class="container-fluid tw-bg-black tw-w-full tw-h-full tw-bg-opacity-20" style="padding-left: 70px; padding-right: 70px; padding-top: 10%; padding-bottom:50px">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-12 col-xl-6 col-sm-7 d-flex flex-column justify-content-center text-center">
                                <span class="alt-font font-weight-500 text-extra-medium letter-spacing-2px text-white text-uppercase d-block margin-40px-bottom"></span>
                                <h1 style="font-size: 60px" class="alt-font letter-spacing-2px font-weight-800 text-white text-uppercase text-shadow-large margin-35px-bottom xs-w-90 mx-auto">WELCOME TO <br>PRICECOM</h1>
                                <a href="#" class="btn btn-fancy btn-large btn-dark-gray btn-box-shadow align-self-center">View All Product</a>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="tw-w-2/3 tw-mx-auto tw-z-10 tw-mb-10">
            <div class="tw-relative tw--mt-14 tw-rounded-xl tw-bg-white tw-shadow-xl tw-px-12 tw-py-auto tw-w-full tw-h-auto">
                <div class="row tw-py-8">
                    <div class="col-3 tw-py-2">
                        <div style="font-size: 25px; width: 250px;" class="tw-font-semibold tw-text-black">Categories</div>
                            <div style="font-size: 15px; width: 250px;" class="tw-mb-3 tw-text-gray-500">Choose the product category</div>
                            <a href="#" class="tw-w-full tw-no-underline">
                                <div style="border: 1.5px solid; width:125px;" class="tw-rounded tw-text-center tw-border-gray-700 tw-text-black hover:tw-text-white hover:tw-bg-black hover:tw-border-black tw-bg-white tw-font-semibold tw-py-2">View All</div>
                            </a>
                    </div>
                    <div class="col-9 tw-w-full tw-flex">
                        <!-- start slider navigation -->
                        <div class="swiper-button-previous-nav tw-w-12 tw-h-12 tw-text-center tw-border-gray-700 tw-text-black hover:tw-text-white hover:tw-bg-black hover:tw-border-black tw-py-3 tw-my-8 tw-rounded tw-float-left tw-bg-white light" style="border: 1px solid"><i class="fas fa-chevron-left"></i></div>
                        <div class="swiper-container text-center" style="width: 40rem" data-slider-options='{ "slidesPerView": 1, "navigation": { "nextEl": ".swiper-button-next-nav", "prevEl": ".swiper-button-previous-nav" }, "autoplay": { "delay": 3000, "disableOnInteraction": false }, "keyboard": { "enabled": true, "onlyInViewport": true }, "breakpoints": { "1200": { "slidesPerView": 4 }, "992": { "slidesPerView": 3 }, "768": { "slidesPerView": 3 } } }'>
                            <div class="swiper-wrapper">
                                <?php while($category=fetch($categoryQuery)) { ?>
                                <!-- start slider item -->
                                    <div class="swiper-slide tw--pr-4">
                                        <a href="#" style="text-decoration: none;" class="tw-w-full tw-no-underline">
                                            <div style="height: 120px; width:120px;" class="tw-rounded-md tw-pt-4 tw-bg-gray-100 hover:tw-shadow-xl">
                                                <img src="../Admin/category/.<?= $category['image'] ?>" class="tw-rounded-md tw-mx-auto" style="width: 75px; height:75px;" alt="">
                                                <div class="tw-mt-1 tw-font-semibold tw-text-black tw-line-clamp-2 tw-px-2 tw-text-center" style="font-size: 12px"><?= $category['name'] ?></div>
                                            </div>
                                        </a>
                                    </div>
                                <!-- end slider item -->
                                <?php } ?>
                            </div>
                        </div>
                        <div class="swiper-button-next-nav tw-w-12 tw-h-12 tw--ml-5 tw-text-center tw-border-gray-700 tw-text-black hover:tw-bg-black hover:tw-border-black hover:tw-text-white tw-py-3 tw-my-8 tw-rounded tw-float-right tw-bg-white light" style="border: 1px solid "><i class="fas fa-chevron-right"></i></div>
                        <!-- end slider navigation -->
                    </div>
                </div>
            </div>
        </div>
        <?php include "layout/footer.php" ?>
    </body>
    <script type="text/javascript" src="assets/user/js/theme-vendors.min.js"></script>
    <script type="text/javascript" src="assets/user/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/user/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>