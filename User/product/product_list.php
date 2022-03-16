<?php
ob_start();
include_once("../../connection.php");

$categoryid = $_GET['id'];
if($categoryid == "all"){
    $productQuery = query("select * from product where deleted_at IS NULL");
}else{
    $categoryFetch = fetch(query("select * from category where deleted_at IS NULL and id = '$categoryid' "));
    $productQuery = query("select * from product where deleted_at IS NULL and category_id = '$categoryid' ");
}
$categoryQuery = query("select * from category where deleted_at IS NULL");
$total_all_product = row($productQuery);
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
                                <div style="font-size: 30px;" class="tw-ml-5 tw-text-white tw-font-bold "><?= ($categoryid != "all")? $categoryFetch['name'] : "Product List" ?></div>
                            </div>
                            <div class="col-lg-3">
                                <ul class="d-flex justify-content-lg-end">
                                    <li>
                                        <a style="font-size: 20px" class="font-weight-600 tw-text-white tw-no-underline" href="#">Home</a>
                                    </li>
                                    <li class="tw-flex">
                                        <i style="margin-top: 5px; font-size: 20px" class="fa fa-angle-right tw-text-white ml-2 mr-2" aria-hidden="true"></i>
                                        <div style="font-size: 20px" class="font-weight-600 tw-text-gray-300 tw-no-underline"><?= ($categoryid != "all")? $categoryFetch['name'] : "Product list" ?></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
            <div class="container tw-my-32">
                <div class="row">
                    <div class="col-4 tw-mb-10">
                        <div class="    order-lg-first shopping-sidebar">
                            <div class="border-bottom border-color-medium-gray padding-3-rem-bottom margin-3-rem-bottom wow animate__fadeIn" style="visibility: visible; animation-name: fadeIn;">
                                <span class="shop-title alt-font font-weight-600 text-extra-dark-gray d-block margin-20px-bottom">Filter by category</span>
                                <ul class="list-style-07 filter-category p-0">
                                    <div class="tw-justify-between tw-flex tw-mb-4">
                                        <button style="text-decoration: none; width:100%;">
                                            <div class="tw-flex tw-w-full tw-justify-between">
                                                <div>
                                                    <li class="p-0"><i class="fa fa-angle-right tw-text-black" aria-hidden="true"></i>
                                                    <span class="font-weight-500 tw-opacity-80 tw-no-underline ml-2 <?=($categoryid == "all")?'tw-text-red-500':'tw-text-black hover:tw-text-red-500'?>">All</span>
                                                </div>
                                                <span class="item-qty font-weight-500 tw-text-black tw-opacity-80"><?= $total_all_product ?></span></li>
                                            </div>
                                        </button>
                                    </div>
                                    <?php while($category=fetch($categoryQuery)) {
                                        $current_category_id = $category['id'];
                                        $category_product_Query = query("select * from product where deleted_at IS NULL and category_id = '$current_category_id' ");
                                        $total_category_product = row($category_product_Query);
                                    ?>
                                    <div class="tw-justify-between tw-flex tw-mb-4">
                                        <button style="text-decoration: none; width:100%;">
                                            <div class="tw-flex tw-w-full tw-justify-between">
                                                <div>
                                                    <li class="p-0"><i class="fa fa-angle-right tw-text-black" aria-hidden="true"></i>
                                                    <span class="font-weight-500 tw-opacity-80 tw-no-underline ml-2 <?=($categoryid == $category['id'])?'tw-text-red-500':'tw-text-black hover:tw-text-red-500'?>"><?= $category['name']?></span>
                                                </div>
                                                <span class="item-qty font-weight-500 tw-text-black tw-opacity-80"><?= $total_category_product ?></span></li>
                                            </div>
                                        </button>
                                    </div>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-8 tw-mb-10">
                        <div class="row">
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
                                <div class="col-4 tw-pr-10 tw-mb-10">
                                    <div class="shadow tw-mx-auto tw-rounded-lg" style="width: 18.5rem;">
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
                                                    <div class="tw-bg-blue-900 tw-py-2 tw-w-full tw-text-white tw-font-semibold tw-px-4" style="border-bottom-right-radius: 5px; border-bottom-left-radius: 5px;"><?= $total_store ?> Store Compared</div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            <?php }}} ?>
                        </div>
                    </div>
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