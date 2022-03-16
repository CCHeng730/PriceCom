<?php
ob_start();
include_once("../../connection.php");

if(!isset($_SESSION['uid'])) { //check if logged in
    ?><script>window.location.href="../auth/login.php"</script><?php
}
//Product information
$productid = $_GET['id'];
$productQuery = fetch(query("select * from product where deleted_at IS NULL and id = '$productid' "));
//Product Category
$product_category = $productQuery['category_id'];
$categoryFetch = fetch(query("select * from category where deleted_at IS NULL and id = '$product_category' "));

//Product store
$productstoreQuery = query("select * from productstore where deleted_at IS NULL and product_id = '$productid' order by price ");
$total_store = mysqli_num_rows($productstoreQuery);

//Purchase history
$purchaseQuery = query("select * from purchase_history where product_id = '$productid'");
$total_product_sold = mysqli_num_rows($purchaseQuery);

//Product Review
$feedbackQuery = query("select * from feedback where product_id = '$productid'");
$total_feedback = row($feedbackQuery);

//Product Rating
$ratingQuery = query("select sum(rate) as total from feedback where product_id = '$productid'");
$ratingFetch = fetch($ratingQuery);
$rating_sum = $ratingFetch['total'];
if($rating_sum != null){
    $total_rating = row($ratingQuery);
    $Product_Rate = $rating_sum/$total_rating;
}else{
    $Product_Rate = 0;
}
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
                                <div style="font-size: 30px;" class="tw-ml-5 tw-text-white tw-font-bold "><?= $productQuery['name'] ?></div>
                            </div>
                            <div class="col-lg-3">
                                <ul class="d-flex justify-content-lg-end">
                                    <li>
                                        <a style="font-size: 20px" class="font-weight-600 tw-text-white tw-no-underline" href="#">Home</a>
                                    </li>
                                    <li class="tw-flex">
                                        <i style="margin-top: 5px; font-size: 20px" class="fa fa-angle-right tw-text-white ml-2 mr-2" aria-hidden="true"></i>
                                        <div style="font-size: 20px" class="font-weight-600 tw-text-gray-300 tw-no-underline">product</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
            <div class="container tw-py-20 tw-bg-gray-50">
                <div class="row">
                    <div class="col-12 tw-mx-auto tw-mb-5">
                        <div class="row tw-rounded-lg tw-bg-white tw-shadow-lg tw-p-5">
                            <div class="col-9 tw-flex">
                                <img class="tw-rounded-lg tw-shadow-lg tw-mt-3" style="width: 350px; height:250px;" src="<?= 'Admin/product/'.$productQuery['image']?>" alt="">
                                <div class="tw-border-l-2 tw-pl-5 tw-ml-5" style="border-color: #E8E8E8;">
                                    <div style="font-size:30px;" class="tw-text-black tw-font-bold"><?= $productQuery['name'] ?></div>
                                    <div style="font-size:18px;" class="tw-text-gray-400 tw-font-medium">Category : <?= $categoryFetch['name'] ?></div>
                                    <div style="font-size:16px;" class="tw-text-black "><?= $productQuery['description'] ?></div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="tw-border-l-2 tw-pl-5" style="border-color: #E8E8E8;">
                                    <div class="tw-flex tw-mb-3 tw-rounded-lg tw-shadow tw-px-5 tw-pt-3 tw-pb-4">
                                        <i style="font-size: 30px; width:20%;" class="tw-pt-3 tw-text-gray-400 fas fa-star-half-alt tw-text-center"></i>
                                        <div class="tw-ml-3 tw-pt-2" style=" width:80%;">
                                            <span class="tw-text-black tw-font-bold" style="font-size: 20px;">Rating : </span>
                                            <span class="tw-text-black tw-font-semibold" style="font-size: 15px;"><?= number_format($Product_Rate, 1, '.', ' ') ?> <i class="fas fa-star tw-text-yellow-400"></i></span>
                                        </div>
                                    </div>
                                    <div class="tw-flex tw-mb-3 tw-rounded-lg tw-shadow tw-px-5 tw-pt-3 tw-pb-4">
                                        <i style="font-size: 30px; width:20%;" class="tw-pt-3 tw-text-gray-400 fas fa-coins tw-text-center"></i>
                                        <div class="tw-ml-3 tw-pt-2" style=" width:80%;">
                                            <span class="tw-text-black tw-font-bold" style="font-size: 20px;">Total Sold : </span>
                                            <span class="tw-text-black tw-font-semibold" style="font-size: 15px;"><?= $total_product_sold?></span>
                                        </div>
                                    </div>
                                    <div class="tw-flex tw-mb-3 tw-rounded-lg tw-shadow tw-px-5 tw-pt-3 tw-pb-4">
                                        <i style="font-size: 30px; width:20%;" class="tw-pt-3 tw-text-gray-400 fas fa-truck tw-text-center"></i>
                                        <div class="tw-ml-3" style=" width:80%;">
                                            <div class="tw-text-black tw-font-bold" style="font-size: 20px;">Shipping Fee : </div>
                                            <div class="tw-text-black tw-font-semibold" style="font-size: 15px;">RM 5.00</div>
                                        </div>
                                    </div>
                                    <div class="tw-flex tw-mb-3 tw-rounded-lg tw-shadow tw-px-5 tw-pt-3 tw-pb-4">
                                        <i style="font-size: 30px; width:20%;" class="tw-pt-3 tw-text-gray-400 fas fa-store tw-text-center"></i>
                                        <div class="tw-ml-3 tw-pt-2" style=" width:80%;">
                                            <span class="tw-text-black tw-font-bold" style="font-size: 20px;">Store : </span>
                                            <span class="tw-text-black tw-font-semibold" style="font-size: 15px;"><?= $total_store?></span>
                                        </div>
                                    </div>
                                    <div class="tw-flex tw-mb-3 tw-rounded-lg tw-shadow tw-px-5 tw-pt-3 tw-pb-4">
                                        <i style="font-size: 30px; width:20%;" class="tw-pt-3 tw-text-gray-400 far fa-calendar-alt tw-text-center"></i>
                                        <div class="tw-ml-3" style=" width:80%;">
                                            <div class="tw-text-black tw-font-bold" style="font-size: 20px;">Created at</div>
                                            <div class="tw-text-black tw-font-semibold" style="font-size: 15px;"><?= date('d-m-Y', strtotime($productQuery['created_at'])) ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 tw-text-center tw-font-semibold tw-py-5" style="font-size: 25px;">Compared Store Price</div>
                    <div class="col-12 tw-h-1 tw-rounded tw-mx-auto tw-my-5" style="background-color: #E8E8E8;"></div>
                    <div class="col-12 tw-mb-8">
                        <div class="row">
                            <?php 
                                //Lowest Store price
                                $lowest_priceFetch = fetch($productstoreQuery);
                                $lowest_price_id = $lowest_priceFetch['id'];
                                $lowest_price_purchase_historyQuery = query("select * from purchase_history where product_store_id = '$lowest_price_id' ");
                                $total_lowest_sold = mysqli_num_rows($lowest_price_purchase_historyQuery);
                            ?>
                                <div class="col-4 tw-mb-10">
                                    <div class="tw-mx-auto tw-mt-7 tw-shadow-lg tw-rounded-lg">
                                        <div class="tw-w-full tw-py-5 tw-bg-green-300 tw-text-white tw-text-center tw-font-black" style="font-size: 25px; border-top-right-radius:10px; border-top-left-radius:10px;">LOWEST PRICE</div>
                                        <div class="tw-w-full tw-text-center tw-mt-5 tw-pb-5">
                                            <div class="tw-text-black tw-font-bold" style="font-size: 20px;"><?= $lowest_priceFetch['name'] ?></div>
                                            <div class="tw-h-1 tw-rounded tw-mx-20 tw-my-5" style="background-color: #E8E8E8;"></div>
                                            <div class="tw-mb-5" style="font-size: 20px;">RM <?= number_format($lowest_priceFetch['price'], 2, '.', ' ') ?></div>
                                            <div class="tw-h-1 tw-rounded tw-mx-20 tw-my-5" style="background-color: #E8E8E8;"></div>
                                            <div class="tw-mb-5" style="font-size: 17px;"><?= $total_lowest_sold ?> Sold</div>
                                            <div class="tw-mt-10 tw-mb-5">
                                                <a href="User/product/checkout.php?id=<?=$lowest_priceFetch['id']?>" class="tw-bg-green-300 tw-text-white hover:tw-text-green-500 tw-rounded tw-no-underline hover:tw-bg-opacity-0 tw-border-2 tw-border-green-300 tw-px-4 tw-py-2 tw-font-semibold" style="font-size: 16px;">BUY NOW</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                                //ALL Store price
                                $product_storeQuery = query("select * from productstore where deleted_at IS NULL and product_id = '$productid' and id != '$lowest_price_id' ");
                                while($product_store=fetch($product_storeQuery)) { 
                                    $current_store_id = $product_store['id'];
                                    $purchase_historyQuery = query("select * from purchase_history where product_store_id = '$current_store_id' ");
                                    $total_sold = mysqli_num_rows($purchase_historyQuery);
                            ?>
                                <div class="col-4 tw-mb-10">
                                    <div class="tw-mx-auto tw-mt-7 tw-shadow-lg tw-rounded-lg">
                                        <div class="tw-w-full tw-py-5 tw-bg-yellow-300 tw-text-white tw-text-center tw-font-black" style="font-size: 25px; border-top-right-radius:10px; border-top-left-radius:10px;">COMPARED PRICE</div>
                                        <div class="tw-w-full tw-text-center tw-mt-5 tw-pb-5">
                                            <div class="tw-text-black tw-font-bold" style="font-size: 20px;"><?= $product_store['name'] ?></div>
                                            <div class="tw-h-1 tw-rounded tw-mx-20 tw-my-5" style="background-color: #E8E8E8;"></div>
                                            <div class="tw-mb-5" style="font-size: 20px;">RM <?= number_format($product_store['price'], 2, '.', ' ') ?></div>
                                            <div class="tw-h-1 tw-rounded tw-mx-20 tw-my-5" style="background-color: #E8E8E8;"></div>
                                            <div class="tw-mb-5" style="font-size: 17px;"><?= $total_sold?> Sold</div>
                                            <div class="tw-mt-10 tw-mb-5">
                                                <a href="User/product/checkout.php?id=<?=$product_store['id']?>" class="tw-bg-yellow-300 tw-text-white hover:tw-text-yellow-500 tw-rounded tw-no-underline hover:tw-bg-opacity-0 tw-border-2 tw-border-yellow-300 tw-px-4 tw-py-2 tw-font-semibold" style="font-size: 16px;">BUY NOW</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- start::Review -->
                    <div class="col-12 tw-text-center tw-font-semibold tw-py-5" style="font-size: 25px;">Review</div>
                    <div class="col-12 tw-h-1 tw-rounded tw-mx-auto tw-my-5" style="background-color: #E8E8E8;"></div>
                    <?php if($total_feedback == 0){ ?>
                        <div class="col-9 tw-mx-auto">
                            <div class="tw-w-full tw-text-center tw-my-10 tw-font-medium tw-text-gray-400">No review in this product rating.</div>
                        </div>
                    <?php
                        }else{
                        while($feedback=fetch($feedbackQuery)) {
                            // Fetch User
                            $userid = $feedback['user_id'];
                            $userfetch = fetch(query("select * from user where id = '$userid'"));
                            // Fetch Product Store
                            $product_storeid = $feedback['product_store_id'];
                            $product_storefetch = fetch(query("select * from productstore where id = '$product_storeid'"));
                    ?>
                    <div class="col-9 tw-mx-auto">
                        <div class="row tw-border-b-2 tw-pb-5">
                            <div class="col-2">
                                <img class="tw-rounded-full tw-mx-auto" style="width: 100px; height: 100px;" src="<?=($userfetch['image'] == null)? 'https://shacknews-ugc.s3.us-east-2.amazonaws.com/user/9647/article-inline/2021-03/template.jpg?versionId=EPuOpjX7pGmrwxIxaF8BBrMfaK4X7f.S': "User/profile/".$userfetch['image']?>" alt="">
                            </div>
                            <div class="col-10">
                                <div class="tw-flex tw-justify-between">
                                    <div>
                                        <div class="tw-text-gray-700 tw-font-bold" style="font-size: 18px;"><?= $userfetch['username'] ?></div>
                                        <div class="tw-text-gray-400 tw-font-medium tw--mt-1" style="font-size: 14px;">Store : <?= $product_storefetch['name'] ?></div>
                                    </div>
                                    <div>
                                        <div class="tw-text-gray-400 tw-font-medium" style="font-size: 15px;"><?= date('d-m-Y', strtotime($feedback['created_at'])) ?></div>
                                        <div>
                                            <i style="font-size: 15px;" class="<?=($feedback['rate'] >= 1)?'fas':'far'?> fa-star tw-text-yellow-400"></i>
                                            <i style="font-size: 15px;" class="<?=($feedback['rate'] >= 2)?'fas':'far'?> fa-star tw-text-yellow-400 tw--ml-1"></i>
                                            <i style="font-size: 15px;" class="<?=($feedback['rate'] >= 3)?'fas':'far'?> fa-star tw-text-yellow-400 tw--ml-1"></i>
                                            <i style="font-size: 15px;" class="<?=($feedback['rate'] >= 4)?'fas':'far'?> fa-star tw-text-yellow-400 tw--ml-1"></i>
                                            <i style="font-size: 15px;" class="<?=($feedback['rate'] >= 5)?'fas':'far'?> fa-star tw-text-yellow-400 tw--ml-1"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw-mt-2">
                                    <?php if($feedback['comment'] == null){ ?>
                                        No comment in this feedback.
                                    <?php }else{ ?>
                                        <?= $feedback['comment'] ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 tw-rounded tw-mx-auto tw-my-5" style="background-color: #E8E8E8;"></div>
                    <?php }} ?>
                    <div class="col-9 tw-mx-auto">
                        <div class="tw-w-full tw-text-center tw-font-medium tw-text-gray-400" style="font-size: 15px;">REVIEW (<?=$total_feedback?>)</div>
                    </div>
                    <!-- End::Review -->
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