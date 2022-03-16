<?php
ob_start();
include_once("../../connection.php");

if(!isset($_SESSION['uid'])) { //check if logged in
    ?><script>window.location.href="auth/login.php"</script><?php
}
$currentuser_id = $_SESSION['uid'];
$purchaseQuery = query("select * from purchase_history where user_id = '$currentuser_id'");
$order_fetchall = fetchall(query("select * from purchase_history where user_id = '$currentuser_id'"));
// Edit Store
foreach($order_fetchall as $order)
{
    $order_id = $order['id'];
    $order_product_id = $order['product_id'];
    $order_store_id = $order['product_store_id'];

    if(isset($_POST["submit_".$order_id])){
        $rating = $_POST['rating'];
        $comment = $_POST['comment'];
        //if all clear
        if (isset($rating)) {
            $currentDate = date('Y-m-d H:i:s');
            if ($comment == "") {
                query("insert into feedback (user_id, product_id, product_store_id, order_id, rate, created_at)
                        values('$currentuser_id','$order_product_id','$order_store_id','$order_id','$rating','$currentDate')");
            }else{
                query("insert into feedback (user_id, product_id, product_store_id, order_id, rate, comment, created_at)
                        values('$currentuser_id','$order_product_id','$order_store_id','$order_id','$rating','$comment','$currentDate')");
            }
            //redirect back
            ?><script>window.location.href = "purchase_history.php"</script><?php
        }
    }
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
                                            <div class="tw-font-medium">RM <?= number_format($purchase_history['total'], 2, '.', ' ') ?></div>
                                        </td>
                                        <td class="tw-py-3">
                                            <div class="tw-mb-2 tw-w-full">
                                                <?php
                                                    $current_order_id = $purchase_history['id'];
                                                    $check_rating = fetch(query("select * from feedback where order_id = '$current_order_id'"));
                                                    if($check_rating == null){
                                                ?>
                                                    <button type="button" class="tw-font-semibold tw-rounded tw-w-full tw-py-3 tw-text-white tw-bg-gray-700 hover:tw-text-white tw-bg-gradient-to-b hover:tw-from-black hover:tw-to-gray-500 tw-no-underline" 
                                                            data-toggle="modal" data-target="#review_<?=$purchase_history['id']?>">
                                                        Rate
                                                    </button>
                                                <?php }else{ ?>
                                                    <div class="tw-font-semibold tw-rounded tw-text-center tw-w-full tw-py-3 tw-text-gray-500 tw-bg-white tw-border-gray-500 tw-border-2">Rated</div>
                                                <?php } ?>
                                            </div>
                                            <a href="User/product/product_detail.php?id=<?= $current_product_id?>" class="tw-no-underline">
                                                <div class="tw-font-semibold tw-rounded tw-text-center tw-w-full tw-py-3 tw-text-white tw-bg-gray-700 hover:tw-text-white tw-bg-gradient-to-b hover:tw-from-black hover:tw-to-gray-500">View Product</div>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- start::Modal -->
                                    <div class="modal fade" id="review_<?=$purchase_history['id']?>" tabindex="-1" role="dialog" aria-labelledby="addStoreTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <div>
                                                        <h5 class="modal-title" id="addStoreTitle">Review</h5>
                                                        <div class="d-block text-muted mt-2 font-size-sm">Write down your comment and rate for this product</div>
                                                    </div>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form method="post" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <div class="tw-w-full tw-flex tw-px-5">
                                                            <div style="width: 20%" class="tw-pb-5">
                                                                <img src="<?= 'Admin/product/'.$current_product['image']?>" style="width: 140px; height:110px;" class="tw-rounded-md tw-object-cover tw-inset-0" alt="">
                                                            </div>
                                                            <div style="width: 80%" class="tw-ml-5">
                                                                <div class="tw-w-full tw-flex" style="height: 70px;">
                                                                    <div style="width: 80%">
                                                                        <div style="font-size: 23px;" class="tw-font-semibold tw-text-black tw-line-clamp-2"><?= $purchase_history['product_name']?></div>
                                                                        <div style="font-size: 16px;" class="tw--mt-1 tw-text-gray-500">Store : <?= $product_store['name']?></div>
                                                                    </div>
                                                                    <div style="width: 20%">
                                                                        <div style="font-size: 18px;" class="tw-font-semibold">RM <?= number_format($purchase_history['total'], 2, '.', ' ')?></div>
                                                                    </div>
                                                                </div>
                                                                <div class="tw-text-right tw-py-4">
                                                                    <input type="text" value="<?= $purchase_history['id'] ?>" id="current_order" hidden>
                                                                    <input type="radio" name="rating" value="1" id="ratingbutton1__<?= $purchase_history['id'] ?>" onclick="setRating(1,<?= $purchase_history['id'] ?>)" hidden/>
                                                                    <label for="ratingbutton1__<?= $purchase_history['id'] ?>">
                                                                        <i style="font-size: 30px;" id="star1_<?= $purchase_history['id'] ?>" class="star tw-text-yellow-500 far fa-star"></i>
                                                                    </label>
                                                                    <input type="radio" name="rating" value="2" id="ratingbutton2__<?= $purchase_history['id'] ?>" onclick="setRating(2,<?= $purchase_history['id'] ?>)" hidden/>
                                                                    <label for="ratingbutton2__<?= $purchase_history['id'] ?>">
                                                                        <i style="font-size: 30px;" id="star2_<?= $purchase_history['id'] ?>" class="star tw-text-yellow-500 far fa-star"></i>
                                                                    </label>
                                                                    <input type="radio" name="rating" value="3" id="ratingbutton3__<?= $purchase_history['id'] ?>" onclick="setRating(3,<?= $purchase_history['id'] ?>)" hidden/>
                                                                    <label for="ratingbutton3__<?= $purchase_history['id'] ?>">
                                                                        <i style="font-size: 30px;" id="star3_<?= $purchase_history['id'] ?>" class="star tw-text-yellow-500 far fa-star"></i>
                                                                    </label>
                                                                    <input type="radio" name="rating" value="4" id="ratingbutton4__<?= $purchase_history['id'] ?>" onclick="setRating(4,<?= $purchase_history['id'] ?>)" hidden/>
                                                                    <label for="ratingbutton4__<?= $purchase_history['id'] ?>">
                                                                        <i style="font-size: 30px;" id="star4_<?= $purchase_history['id'] ?>" class="star tw-text-yellow-500 far fa-star"></i>
                                                                    </label>
                                                                    <input type="radio" name="rating" value="5" id="ratingbutton5__<?= $purchase_history['id'] ?>" onclick="setRating(5,<?= $purchase_history['id'] ?>)" hidden/>
                                                                    <label for="ratingbutton5__<?= $purchase_history['id'] ?>">
                                                                        <i style="font-size: 30px;" id="star5_<?= $purchase_history['id'] ?>" class="star tw-text-yellow-500 far fa-star"></i>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tw-bg-gray-100 tw-px-7 tw-py-5 tw-h-auto">
                                                            <div class="tw-mb-3 tw-w-full tw-text-black tw-font-semibold">Comment</div>
                                                            <div class="tw-w-full tw-mb-5">
                                                                <textarea name="comment" style="min-height: 120px;" placeholder="Enter your comment" type="text" class="tw-border-2 tw-rounded-lg tw-border-solid tw-border-gray-300 tw-w-full tw-px-5 tw-py-2 tw-mx-1"></textarea>
                                                            </div>
                                                            <input type="text" value="<?= $purchase_history['id'] ?>" name="edit_id" hidden>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                                                        <button type="submit" name="submit_<?= $purchase_history['id'] ?>" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Modal-->
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
    <script>
        function setRating(ratingValue, order_id){
            if(ratingValue == 1){
                $("#star1_"+ order_id).removeClass('far');
                $("#star1_"+ order_id).addClass('fas');
                $("#star2_"+ order_id).removeClass('fas');
                $("#star2_"+ order_id).addClass('far');
                $("#star3_"+ order_id).removeClass('fas');
                $("#star3_"+ order_id).addClass('far');
                $("#star4_"+ order_id).removeClass('fas');
                $("#star4_"+ order_id).addClass('far');
                $("#star5_"+ order_id).removeClass('fas');
                $("#star5_"+ order_id).addClass('far');
            }else if(ratingValue == 2){
                $("#star1_"+ order_id).removeClass('far');
                $("#star1_"+ order_id).addClass('fas');
                $("#star2_"+ order_id).removeClass('far');
                $("#star2_"+ order_id).addClass('fas');
                $("#star3_"+ order_id).removeClass('fas');
                $("#star3_"+ order_id).addClass('far');
                $("#star4_"+ order_id).removeClass('fas');
                $("#star4_"+ order_id).addClass('far');
                $("#star5_"+ order_id).removeClass('fas');
                $("#star5_"+ order_id).addClass('far');
            }else if(ratingValue == 3){
                $("#star1_"+ order_id).removeClass('far');
                $("#star1_"+ order_id).addClass('fas');
                $("#star2_"+ order_id).removeClass('far');
                $("#star2_"+ order_id).addClass('fas');
                $("#star3_"+ order_id).removeClass('far');
                $("#star3_"+ order_id).addClass('fas');
                $("#star4_"+ order_id).removeClass('fas');
                $("#star4_"+ order_id).addClass('far');
                $("#star5_"+ order_id).removeClass('fas');
                $("#star5_"+ order_id).addClass('far');
            }else if(ratingValue == 4){
                $("#star1_"+ order_id).removeClass('far');
                $("#star1_"+ order_id).addClass('fas');
                $("#star2_"+ order_id).removeClass('far');
                $("#star2_"+ order_id).addClass('fas');
                $("#star3_"+ order_id).removeClass('far');
                $("#star3_"+ order_id).addClass('fas');
                $("#star4_"+ order_id).removeClass('far');
                $("#star4_"+ order_id).addClass('fas');
                $("#star5_"+ order_id).removeClass('fas');
                $("#star5_"+ order_id).addClass('far');
            }else if(ratingValue == 5){
                $("#star1_"+ order_id).removeClass('far');
                $("#star1_"+ order_id).addClass('fas');
                $("#star2_"+ order_id).removeClass('far');
                $("#star2_"+ order_id).addClass('fas');
                $("#star3_"+ order_id).removeClass('far');
                $("#star3_"+ order_id).addClass('fas');
                $("#star4_"+ order_id).removeClass('far');
                $("#star4_"+ order_id).addClass('fas');
                $("#star5_"+ order_id).removeClass('far');
                $("#star5_"+ order_id).addClass('fas');
            }
        }
    </script>
    <script type="text/javascript" src="assets/user/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/user/js/theme-vendors.min.js"></script>
    <script type="text/javascript" src="assets/user/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>