<?php
ob_start();
include_once("../../connection.php");

if(!isset($_SESSION['uid'])) { //check if logged in
    ?><script>window.location.href="auth/login.php"</script><?php
}
$currentuser_id = $_SESSION['uid'];

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
            <?php include "../profile/profile_header.php" ?>
            <div class="container tw-my-32">
                <div class="row">
                    <div class="col-3">
                        <div class="tw-mx-2 tw-py-5 tw-px-3 tw-rounded-lg tw-bg-white tw-shadow-lg">
                            <div class="tw-w-4/5 tw-mx-auto tw-my-1">
                                <a href="User/profile/profile.php" class=" tw-no-underline">
                                    <div class="tw-pl-4 tw-font-medium tw-py-2 tw-mb-3 tw-rounded-lg tw-uppercase hover:tw-bg-gray-500 tw-text-gray-400 hover:tw-text-white" style="font-size: 16px">
                                        <i style="width: 10%;" class="fas fa-user"></i> 
                                        <span style="width: 90%;">My Account</span>
                                    </div>
                                </a>
                                <a href="User/profile/purchase_history.php" class="tw-no-underline">
                                    <div class="tw-pl-4 tw-font-medium tw-py-2 tw-mb-3 tw-rounded-lg tw-uppercase tw-bg-black tw-text-white" style="font-size: 16px">
                                        <i style="width: 10%;" class="fas fa-shopping-basket"></i>
                                        <span style="width: 90%;">Purchase History</span>
                                    </div>
                                </a>
                                <a href="User/auth/login.php" class="tw-no-underline">
                                    <div class="tw-pl-4 tw-font-medium tw-py-2 tw-rounded-lg tw-uppercase hover:tw-bg-gray-500 tw-text-gray-400 hover:tw-text-white" style="font-size: 16px">
                                        <i style="width: 10%;" class="fas fa-sign-out-alt"></i> 
                                        <span style="width: 90%;">LogOut</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tw-mx-2 tw-pb-10 tw-px-8 tw-rounded tw-bg-white tw-shadow-lg">
                            <div class="tw-px-10 tw-mb-7 tw-pt-8 tw-pb-5" style="border-bottom: 2px solid #E8E8E8;">
                                <div style="font-size: 25px;" class="tw-font-semibold tw-text-black">My Purchase History</div>
                                <div style="font-size: 15px;" class="tw-text-gray-500 tw-font-normal">View your purchase history list.</div>
                            </div>
                            <table class="tw-w-full">
                                <thead style="border-bottom: 2px solid #E8E8E8;">
                                    <tr>
                                        <th style="width: 15%;" class="tw-py-3"></th>
                                        <th style="width: 25%;" class="tw-py-3">Product Name</th>
                                        <th style="width: 15%;" class="tw-py-3">Store</th>
                                        <th style="width: 15%;" class="tw-py-3">Shipping Fee</th>
                                        <th style="width: 15%;" class="tw-py-3">Total Price</th>
                                        <th style="width: 15%;" class="tw-py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $purchaseQuery = query("select * from purchase_history where user_id = '$currentuser_id'");
                                        while($purchase_history=fetch($purchaseQuery)) {
                                            $purchase_store_id = $purchase_history['product_store_id'];
                                            $current_product_id = $purchase_history['product_id'];
                                            $product_store = fetch(query("select * from productstore where id = '$purchase_store_id'"));
                                            $current_product = fetch(query("select * from product where id = '$current_product_id'"));
                                    ?>
                                    <tr class="tw-border-b-2">
                                        <td class="tw-py-3">
                                            <img style="width: 80px; height:80px;" class="tw-mx-auto tw-rounded tw-object-contain" src="<?= 'Admin/product/'.$current_product['image']?>" alt="">
                                        </td>
                                        <td class="tw-py-3">
                                            <div class="tw-font-medium"><?= $purchase_history['product_name']?></div>
                                        </td>
                                        <td class="tw-py-3">
                                            <div class="tw-font-medium"><?= $product_store['name']?></div>
                                        </td>
                                        <td class="tw-py-3">
                                            <div class="tw-font-medium">RM <?= number_format($purchase_history['shipping_fee'], 2, '.', ' ')?></div>
                                        </td>
                                        <td class="tw-py-3">
                                            <div class="tw-font-medium">RM <?= $purchase_history['total']?></div>
                                        </td>
                                        <td class="tw-py-3">
                                            <a href="User/product/product_detail.php?id=<?= $current_product_id?>" class="tw-font-semibold tw-rounded tw-px-6 tw-py-3 tw-text-white tw-bg-gray-700 hover:tw-text-white tw-bg-gradient-to-b hover:tw-from-black hover:tw-to-gray-500 tw-no-underline">View Product</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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