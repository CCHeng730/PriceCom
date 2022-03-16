<?php
ob_start();
include_once("../connection.php");

if(!isset($_SESSION['uid'])) { //check if logged in
    ?><script>window.location.href="auth/login.php"</script><?php
}

$categoryQuery = query("select * from category where deleted_at IS NULL");
$productQuery = query("select * from product where deleted_at IS NULL");

?>
<!DOCTYPE html>
<html>
    <head>
        <base href="../">
        <meta charset="utf-8" />
        <title>PriceCom</title>
        <link rel="stylesheet" type="text/css" href="assets/user/css/font-icons.min.css">
        <link rel="stylesheet" type="text/css" href="assets/user/css/theme-vendors.min.css">
        <link rel="stylesheet" type="text/css" href="assets/user/css/style.css" />
        <link rel="stylesheet" type="text/css" href="assets/user/css/responsive.css" />
        <link rel="stylesheet" type="text/css" href="assets/app.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
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
                                <a href="User/product/product_list.php?id=all" class="btn btn-fancy btn-large btn-dark-gray btn-box-shadow align-self-center">View All Product</a>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="tw-py-5 tw-px-0 tw-bg-gray-100">
            <div class="container">
                <div class="row">
                    <div class="col-9 tw-p-2 tw-mx-auto tw-rounded-md">
                        <div class="row">
                            <div class="col-12 tw-mb-5 tw-font-black tw-text-center" style="font-size:30px;">CATEGORY</div>
                            <?php while($category=fetch($categoryQuery)) { ?>
                                <div class="col-2">
                                    <a href="User/product/product_list.php?id=<?=$category['id']?>">
                                        <div class="tw-py-2 tw-rounded-lg tw-px-1" style="height: 10rem;">
                                            <img style="width: 80px; height: 80px;" class="tw-my-2 tw-mx-auto tw-object-cover tw-rounded-full tw-inset-0" src="<?= 'Admin/category/'.$category['image']?>" alt="">
                                            <div class="tw-text-center tw-font-semibold tw-uppercase tw-text-black tw-line-clamp-2"><?= $category['name'] ?></div>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-9 tw-p-2 tw-mx-auto tw-rounded-md">
                        <div class="row">
                            <div class="col-12 tw-font-black tw-text-center" style="font-size:30px;">PRODUCT</div>
                            <div class="col-12 tw-mb-5 tw-text-gray-500 tw-text-center" style="font-size:16px;">PriceCom compared all the Product in below.</div>
                            <?php 
                                while($product=fetch($productQuery)) { 
                                    $product_id = $product['id'];
                                    $product_storeQuery = query("select * from productstore where deleted_at IS NULL and product_id = '$product_id'");
                                    $total_store = mysqli_num_rows($product_storeQuery);
                                    $lowest_priceFetch = fetch(query("select * from productstore where deleted_at IS NULL and product_id = '$product_id' order by price "));
                                    $purchaseQuery = query("select * from purchase_history where product_id = '$product_id'");
                                    $total_product_sold = mysqli_num_rows($purchaseQuery);
                                    if(isset($product_storeQuery)){
                                        if($total_store > 1){
                            ?>
                                        <!-- start slider item -->
                                        <div class="col-2 tw-mr-10 tw-mb-10">
                                            <div class="shadow tw-mx-auto" style="width: 16rem;">
                                                <img src="<?= 'Admin/product/'.$product['image']?>" alt="" style="width: 210px; height: 200px;" class="tw-inset-0 tw-mx-auto tw-object-contain">
                                                <div class="product-overlay bg-gradient-extra-midium-gray-transparent" style="top:-128px;"></div>
                                                <div class="tw-absolute" style="left: 79px; top: 80px;"></div>
                                                <a href="User/product/product_detail.php?id=<?=$product['id']?>" class="tw-no-underline tw-w-full">
                                                    <div class="product_info tw-w-full">
                                                        <div class="tw-w-full">
                                                            <div class="font-weight-600 tw-px-3 tw-w-full tw-text-black tw-line-clamp-1 tw-no-underline hover:tw-text-blue-500" style="font-size: 20px; cursor: pointer;"><?= $product['name'] ?></div>
                                                            <div class="tw-w-full tw-px-3 tw-pb-5">
                                                                <span class="font-weight-600 tw-text-red-500" style="font-size: 20px;">RM <?= $lowest_priceFetch['price'] ?></span>
                                                            </div>
                                                            <div class="tw-w-full tw-text-right tw-px-3 tw-pb-2">
                                                                <span class="font-weight-600 tw-text-gray-500" style="font-size: 18px;"><?= $total_product_sold ?> sold</span>
                                                            </div>
                                                            <div class="tw-bg-blue-900 tw-py-2 tw-w-full tw-text-white tw-font-semibold tw-px-4"><?= $total_store ?> Store Compared</div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <!-- end slider item -->
                            <?php       
                                        }
                                    }
                                } 
                            ?>
                        </div>
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