<?php
ob_start();
include_once("../../connection.php");

if(!isset($_SESSION['uid'])) { //check if logged in
    ?><script>alert('Please login to place order!');window.location.href="../auth/login.php"</script><?php
}
$currentuser_id = $_SESSION['uid'];

$product_store_id = $_GET['id'];
$product_storeQuery = fetch(query("select * from productstore where deleted_at IS NULL and id = '$product_store_id' "));
$product_id = $product_storeQuery['product_id'];
$productQuery = fetch(query("select * from product where deleted_at IS NULL and id = '$product_id' "));
$product_name = $productQuery['name'];
$product_price = $product_storeQuery['price'];
$product_category = $productQuery['category_id'];
$categoryFetch = fetch(query("select * from category where deleted_at IS NULL and id = '$product_category' "));
if (isset($_POST['submit'])) {
    $checkout_total = $_POST['total'];
    $currentDate = date('Y-m-d H:i:s');

    query("insert into purchase_history (user_id, product_id, product_store_id, product_name, product_price, shipping_fee, total, created_at)
            values('$currentuser_id','$product_id','$product_store_id','$product_name','$product_price','5.00','$checkout_total','$currentDate')");

    ?><script>window.location.href = "order_complete.php"</script><?php
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
                                <div style="font-size: 30px;" class="tw-ml-5 tw-text-white tw-font-bold ">CheckOut</div>
                            </div>
                            <div class="col-lg-3">
                                <ul class="d-flex justify-content-lg-end">
                                    <li>
                                        <a style="font-size: 20px" class="font-weight-600 tw-text-white tw-no-underline" href="#">Home</a>
                                    </li>
                                    <li class="tw-flex">
                                        <i style="margin-top: 5px; font-size: 20px" class="fa fa-angle-right tw-text-white ml-2 mr-2" aria-hidden="true"></i>
                                        <div style="font-size: 20px" class="font-weight-600 tw-text-gray-300 tw-no-underline">checkout</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
            <div class="container tw-mt-20 tw-bg-gray-50">
                <div class="row">
                    <div class="col-7">
                        <div class="tw-mt-7 tw-shadow-lg tw-rounded-lg tw-p-8">
                            <div class="tw-border-b-2 tw-py-3 tw-px-5 tw-text-black tw-font-semibold" style="font-size: 22px;"><?= $product_storeQuery['name'] ?></div>
                            <div class="tw-flex">
                                <div style="width: 25%;">
                                    <img class="tw-rounded-lg tw-mx-auto tw-shadow-lg tw-mt-3" style="width: 150px; height:120px;" src="<?= 'Admin/product/'.$productQuery['image']?>" alt="">
                                </div>
                                <div  style="width: 45%;">
                                    <div style="font-size:22px;" class="tw-font-semibold tw-pt-5"><?= $product_name?></div>
                                    <div style="font-size:18px;" class="tw-text-gray-400">Category : <?= $categoryFetch['name']?></div>
                                </div>
                                <div style="width: 30%; font-size:20px;" class="tw-font-semibold tw-text-right tw-pt-5">RM <?= number_format($product_price, 2, '.', ' ') ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 tw-mb-32">
                        <div class="tw-mt-7 tw-shadow-lg tw-rounded-lg tw-p-8">
                            <form method="post" enctype="multipart/form-data">
                                <div class="tw-border-b-2 tw-py-3 tw-px-5 tw-text-black tw-font-semibold" style="font-size: 22px;">Summary</div>
                                <div class="tw-px-5 tw-py-3 tw-rounded tw-bg-gray-200 tw-mt-5">
                                    <table class="tw-w-full">
                                        <tr class="tw-border-b-2 tw-border-black ">
                                            <th style="width: 50%; font-size: 18px;" class="tw-pb-3">Title</th>
                                            <th style="width: 50%; font-size: 18px;" class="tw-pb-3">Price (RM)</th>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 17px;" class="tw-pt-3"><?= $product_name?></td>
                                            <td style="font-size: 17px;" class="tw-pt-3"><?= number_format($product_price, 2, '.', ' ') ?></td>
                                        </tr>
                                        <tr>
                                            <td style="font-size: 17px;" class="tw-py-3">Shipping Fee</td>
                                            <td style="font-size: 17px;" class="tw-py-3">5.00</td>
                                        </tr>
                                        <?php 
                                            $total = $product_price+5.00;
                                        ?>
                                        <tr class="tw-border-t-2 tw-border-b-2 tw-border-black tw-font-medium">
                                            <td style="font-size: 17px;" class="tw-py-3">Total</td>
                                            <td style="font-size: 17px;" class="tw-py-3"><?= number_format($total, 2, '.', ' ') ?></td>
                                        </tr>
                                        <input type="text" name="total" value="<?=$total?>" hidden>
                                    </table>
                                </div>
                                <div class="tw-border-t-2 tw-pt-5 tw-mt-5 tw-pl-5">
                                    <button type="submit" name="submit" style="font-size: 18px;" class="tw-mt-5 tw-font-semibold tw-px-3 tw-py-2 tw-rounded-lg tw-border-2 tw-border-black tw-bg-black hover:tw-bg-white tw-text-white hover:tw-text-black tw-no-underline">Place Order</button>
                                </div>
                            </form>
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