<?php
ob_start();
include_once("../../connection.php");

if(!isset($_SESSION['aid'])) { //check if logged in
    ?><script>window.location.href="../auth/login.php"</script><?php
}
$productid = $_GET['id'];
$productfetch = fetch(query("select * from product where deleted_at is null and id = '$productid'"));
$productstorefetch = query("select * from productstore where deleted_at is null and product_id = '$productid'");
$store_fetchall = fetchall(query("select * from productstore where product_id = '$productid'"));
$total_productstore = mysqli_num_rows($productstorefetch);
$purchasehistoryQuery = query("select * from purchase_history where product_id = '$productid'");
$total_sales = fetch(query("select sum(product_price) as total from purchase_history where product_id = '$productid'"));
$total_sold = mysqli_num_rows($purchasehistoryQuery);
// Review
$feedbackQuery = query("select * from feedback where product_id = '$productid'");
$total_feedback = mysqli_num_rows($feedbackQuery);

// Create Store
if (isset($_POST['submit'])) {
    $sname = $_POST['sname'];
    $price = $_POST['price'];
    
    $StoreNameUnique = row(query("select * from productstore where name = '$sname' and product_id = 'productid' "));

    if ($sname == "") {
        $serror = "*This field is required";
    }elseif ($StoreNameUnique > 0) {
        $serror = "*This store has already been taken!";
    }
    if ($price == "") {
        $perror = "*This field is required";
    }

    //if all clear
    if (!isset($serror) && !isset($perror)) {
        $currentDate = date('Y-m-d H:i:s');

        query("insert into productstore (name,price,product_id,created_at)
                values('$sname','$price','$productid','$currentDate')");

        //redirect back
        ?><script>window.location.href = "show.php?id=<?=$productid?>"</script><?php
    }
}
// Edit Store
foreach($store_fetchall as $p_store)
{
    $storeid = $p_store['id'];

    if(isset($_POST["editsubmit_".$storeid])){
        $edit_sname = $_POST['edit_sname'];
        $edit_price = $_POST['edit_price'];
        $EditStoreNameUnique = row(query("select * from productstore where name = '$edit_sname' and id != '$storeid' and product_id = 'productid' "));

        if ($edit_sname == "") {
            $es_error = "*This field is required";
        }elseif ($EditStoreNameUnique > 0) {
            $es_error = "*This store name has already been taken!";
        }
        if ($edit_price == "") {
            $ep_error = "*This field is required";
        }
        
        $price = doubleval(trim($edit_price, "RM"));
        //if all clear
        if (!isset($es_error) && !isset($ep_error)) {

            //update record without image
            query("update productstore set name='$edit_sname', price='$price' where id='$storeid'");

            //redirect back
            ?><script>window.location.href = "show.php?id=<?=$productid?>"</script><?php
        }

    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <base href="../../">
        <meta charset="utf-8" />
        <title>PriceCom | Product</title>
        <link href="assets/app.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php include "../layout/app.php" ?>
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-2">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Product</h5>
                        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?= $productfetch['name'] ?></h5>
                        <!--end::Page Title-->
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a href="Admin/product/index.php" class="tw-px-5 tw-mx-1 tw-py-3 tw-bg-gray-200 tw-rounded-md tw-text-black hover:tw-text-black tw-font-medium hover:tw-bg-gray-300">
                            Back
                        </a>
                        <a href="Admin/product/edit.php?id=<?=$productid?>" style="cursor: pointer; color: white;" class="tw-px-5 tw-mx-1 tw-py-3 tw-bg-blue-500 tw-rounded-md tw-text-white tw-font-medium hover:tw-text-white hover:tw-bg-blue-600">
                            Edit Product
                        </a>
                    </div>
                    <!--end::Toolbar-->
                </div>
            </div>
            <!--end::Subheader-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <div class="d-flex flex-column-fluid">
                    <div class="container-fluid">
                        <!--begin::Card-->
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                                <div class="d-flex tw-w-full">
                                    <!--begin: Pic-->
                                    <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                                        <img class="tw-object-contain tw-rounded-xl tw-inset-0 tw-border-4 tw-border-solid tw-border-gray-500 tw-border-opacity-0 tw-border-opacity-60" style="width: 200px; height:150px;" 
                                            src="<?=($productfetch['image'] == null)? 'https://shacknews-ugc.s3.us-east-2.amazonaws.com/user/9647/article-inline/2021-03/template.jpg?versionId=EPuOpjX7pGmrwxIxaF8BBrMfaK4X7f.S': "Admin/product/".$productfetch['image']?>"/>
                                    </div>
                                    <!--end: Pic-->
                                    <!--begin: Info-->
                                    <div class="row tw-w-full">
                                        <!--begin: Content-->
                                        <div class="col-9">
                                            <div style="font-size: 25px" class="d-flex text-dark font-weight-bold mr-3"><?= $productfetch['name'] ?></div>
                                            <div class="tw-line-clamp-5 font-weight-bold text-dark-50"><?= $productfetch['description'] ?></div>
                                        </div>
                                        <!--end: Content-->
                                    </div>
                                    <!--end: Info-->
                                </div>
                                <div class="separator separator-solid my-7"></div>
                                <!--begin: Items-->
                                <div class="d-flex tw-justify-between flex-wrap">
                                    <div class="d-flex">
                                        <!--begin: Item-->
                                        <div class="d-flex my-1 tw-mr-20">
                                            <span class="mr-4">
                                                <i style="font-size: 25px" class="tw-text-gray-300 fas fa-coins"></i>
                                            </span>
                                            <div class="d-flex flex-column text-dark-75">
                                                <span class="font-weight-bolder font-size-sm">Total Sales</span>
                                                <span class="font-weight-bolder font-size-h5">RM <?=($total_sales['total'] == null)? '00.00': $total_sales['total']?></span>
                                            </div>
                                        </div>
                                        <!--end: Item-->
                                        <!--begin: Item-->
                                        <div class="d-flex my-1 tw-mr-20">
                                            <span class="mr-4">
                                                <i class="fas fa-clipboard-check icon-2x tw-text-gray-300"></i>
                                            </span>
                                            <div class="d-flex flex-column text-dark-75">
                                                <span class="font-weight-bolder font-size-sm">Sold</span>
                                                <span class="font-weight-bolder font-size-h5"><?= $total_sold?></span>
                                            </div>
                                        </div>
                                        <!--end: Item-->
                                        <!--begin: Item-->
                                        <div class="d-flex my-1 tw-mr-20">
                                            <span class="mr-4">
                                                <i class="fas fa-store icon-2x tw-text-gray-300"></i>
                                            </span>
                                            <div class="d-flex flex-column text-dark-75">
                                                <span class="font-weight-bolder font-size-sm">Total Store</span>
                                                <span class="font-weight-bolder font-size-h5"><?= $total_productstore?></span>
                                            </div>
                                        </div>
                                        <!--end: Item-->
                                    </div>
                                    <!--begin: Item-->
                                    <div class="d-flex my-1">
                                        <div class="d-flex tw-justify-end py-2">
                                            <div class="font-weight-bold tw-py-2 tw-mr-4">Created at :</div>
                                            <span class="tw-py-2 btn-text text-uppercase font-weight-bold"><?= $productfetch['created_at'] ?></span>
                                        </div>
                                    </div>
                                    <!--end: Item-->
                                </div>
                                <!--begin: Items-->
                            </div>
                        </div>
                        <!--end::Card-->
                        <!--begin::Row-->
                        <div class="row">
                            <div class="col-lg-8">
                                <!--begin::Advance Table Widget 3-->
                                <div class="card card-custom card-stretch gutter-b">
                                    <!--begin::Header-->
                                    <div class="card-header border-0 py-5">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label font-weight-bolder text-dark">Store</span>
                                            <span class="d-block text-muted mt-2 font-size-sm">Product store list</span>
                                        </h3>
                                        <button type="button" class="btn btn-primary font-weight-bold btn-sm px-3 tw-my-3 font-size-base" data-toggle="modal" data-target="#addStore">Add Store</button>
                                        <!-- start::Modal -->
                                        <div class="modal fade" id="addStore" tabindex="-1" role="dialog" aria-labelledby="addStoreTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <div>
                                                            <h5 class="modal-title" id="addStoreTitle">Add Store</h5>
                                                            <div class="d-block text-muted mt-2 font-size-sm">Add a store with price for this product</div>
                                                        </div>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <form method="post" enctype="multipart/form-data">
                                                        <div class="modal-body">
                                                            <div class="form-group row">
                                                                <label class="col-form-label col-3 tw-mb-2 text-lg-right text-left">Store Name</label>
                                                                <div class="col-9 tw-mb-5">
                                                                    <input class="form-control form-control-lg form-control-solid" type="text" name="sname" placeholder="Name" />
                                                                    <span class="error text-danger"><?= (isset($serror)) ? $serror : "" ?></span>
                                                                </div>
                                                                <label class="col-form-label col-3 tw-mb-2 text-lg-right text-left">Price</label>
                                                                <div class="col-9 tw-mb-2">
                                                                    <input class="form-control form-control-lg form-control-solid" type="text" name="price" placeholder="price" />
                                                                    <span class="error text-danger"><?= (isset($perror)) ? $perror : "" ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                                                            <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Modal-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="tw-px-10 tw-mb-5">
                                        <div class="tw-px-10 tw-bg-gray-100 tw-rounded-lg tw-py-2 tw-mb-5">
                                            <?php 
                                                if($total_productstore == 0){
                                            ?>
                                                <div class="row tw-rounded-lg tw-border-2 tw-border-solid tw-border-gray-300 tw-border-opacity-0 hover:tw-border-opacity-100">
                                                    <div class="tw-w-full tw-py-5 tw-text-center tw-line-clamp-1">No product Store.</div>
                                                </div>
                                            <?php
                                                }else{
                                                while($productstore=fetch($productstorefetch)) { ?>
                                                <div class="row tw-rounded-lg tw-border-2 tw-border-solid tw-border-gray-300 tw-border-opacity-0 hover:tw-border-opacity-100">
                                                    <div class="tw-py-3 col-4 tw-flex">
                                                        <div style="width: 95%" class="tw-line-clamp-1"><?= $productstore['name'] ?></div>
                                                        <div style="width: 5%" class="tw-text-black tw-font-semibold">:</div>
                                                    </div>
                                                    <div class="tw-py-3 col-6">
                                                        <div class="tw-line-clamp-2">RM <?= number_format($productstore['price'], 2, '.', ' ') ?></div>
                                                    </div>
                                                    <div class="tw-py-1 col-2">
                                                        <button type="button" class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" data-toggle="modal" data-target="#addStore_<?=$productstore['id']?>">
                                                            <i class="fas fa-edit" title="Edit Store"></i>
                                                        </button>
                                                        <a href="Admin/product/delete_store.php?id=<?=$productstore['id']?>&auth=<?=md5($productstore['id']).sha1($productstore['id'])?>" 
                                                            class="btn btn-clean btn-hover-light-primary btn-sm btn-icon" onclick="return confirm('Are you sure to delete this store?')">
                                                            <i class="fas fa-trash-alt" title="Delete Store"></i>
                                                        </a>
                                                    </div>
                                                    <!-- start::Modal -->
                                                    <div class="modal fade" id="addStore_<?=$productstore['id']?>" tabindex="-1" role="dialog" aria-labelledby="addStoreTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <div>
                                                                        <h5 class="modal-title" id="addStoreTitle">Edit Store</h5>
                                                                        <div class="d-block text-muted mt-2 font-size-sm">Manage the store for this product</div>
                                                                    </div>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <form method="post" enctype="multipart/form-data">
                                                                    <div class="modal-body">
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label col-3 tw-mb-2 text-lg-right text-left">Store Name</label>
                                                                            <div class="col-9 tw-mb-5">
                                                                                <input class="form-control form-control-lg form-control-solid" value="<?= $productstore['name'] ?>" type="text" name="edit_sname" placeholder="Name" />
                                                                                <span class="error text-danger"><?= (isset($es_error)) ? $es_error : "" ?></span>
                                                                            </div>
                                                                            <label class="col-form-label col-3 tw-mb-2 text-lg-right text-left">Price</label>
                                                                            <div class="col-9 tw-mb-2">
                                                                                <input class="form-control form-control-lg form-control-solid" value="RM <?= $productstore['price'] ?>" type="text" name="edit_price" placeholder="Name" />
                                                                                <span class="error text-danger"><?= (isset($ep_error)) ? $ep_error : "" ?></span>
                                                                            </div>
                                                                            <input type="text" value="<?= $productstore['id'] ?>" name="edit_id" hidden>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                                                                        <button type="submit" name="editsubmit_<?= $productstore['id'] ?>" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Modal-->
                                                </div>
                                            <?php }} ?>
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Advance Table Widget 3-->
                            </div>
                            <div class="col-lg-4">
                                <!--begin::Charts Widget 3-->
                                <div class="card card-custom card-stretch gutter-b">
                                    <!--begin::Header-->
                                    <div class="card-header h-auto">
                                        <div class="card-title pt-5 tw-pb-3">
                                            <h3 class="card-label">
                                                <span class="d-block text-dark font-weight-bolder">Shipping Fee</span>
                                                <span class="d-block text-muted mt-2 font-size-sm">Shipping details of this product</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <div style="height: 2px;" class="tw-bg-gray-400 tw-mx-auto tw-mb-1 tw-w-5/6"></div>
                                    <div style="height: 2px;" class="tw-bg-gray-400 tw-mx-auto tw-w-5/6"></div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="tw-px-10 tw-mb-5">
                                        <div class="tw-px-5 tw-pt-5 tw-h-full">
                                            <div class="row tw-mb-5">
                                                <div class="col-6 tw-flex">
                                                    <div style="width: 20%" class="tw-text-black tw-font-semibold">
                                                        <i class="fas fa-truck"></i>
                                                    </div>
                                                    <div style="width: 77%">Shipping In</div>
                                                    <div style="width: 3%" class="tw-text-black tw-font-semibold">:</div>
                                                </div>
                                                <div class="col-6 tw-line-clamp-2">Malaysia</div>
                                            </div>
                                            <div class="row tw-mb-5">
                                                <div class="col-6 tw-flex">
                                                    <div style="width: 20%" class="tw-text-black tw-font-semibold"></div>
                                                    <div style="width: 77%">Shipping Fee</div>
                                                    <div style="width: 3%" class="tw-text-black tw-font-semibold">:</div>
                                                </div>
                                                <div class="col-6">RM 5.50</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Charts Widget 3-->
                            </div>
                        </div>
                        <!--end::Row-->
                        <!--start::Row-->
                        <div class="row">
                            <div class="col-12">
                            <div class="card card-custom card-stretch gutter-b">
                                <!--begin::Header-->
                                <div class="card-header h-auto border-0">
                                    <div class="card-title py-5">
                                        <h3 class="card-label">
                                            <span class="d-block text-dark font-weight-bolder">Review & Comment</span>
                                            <span class="d-block text-muted mt-2 font-size-sm">View the product's comment by rating</span>
                                        </h3>
                                    </div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body">
                                    <div class="tw-w-full">
                                        <?php if($total_feedback == 0){ ?>
                                            <div class="tw-w-full tw-text-center">No review in this product rating.</div>
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
                                            <div class="tw-mb-5 tw-bg-blue-50 tw-rounded-lg tw-flex tw-w-full">
                                                <div style="width: 8%" class="tw-pt-5">
                                                    <img src="<?=($userfetch['image'] == null)? 'https://shacknews-ugc.s3.us-east-2.amazonaws.com/user/9647/article-inline/2021-03/template.jpg?versionId=EPuOpjX7pGmrwxIxaF8BBrMfaK4X7f.S': "User/profile/".$userfetch['image']?>" style="width: 50px; height:50px;" class="tw-object-cover tw-mx-auto tw-inset-0 tw-rounded-lg" alt="">
                                                </div>
                                                <div style="width: 90%;" class="tw-py-4">
                                                    <div class="tw-flex tw-justify-between tw-mb-2">
                                                        <div>
                                                            <div style="font-size: 17px" class="tw-font-semibold tw-mr-3"><?= $userfetch['username'] ?></div>
                                                            <div class="tw-line-clamp-1">Store : <?= $product_storefetch['name'] ?></div>
                                                        </div>
                                                        <div class="tw-flex">
                                                            <div class="tw-mr-3">
                                                                <i style="font-size: 13px;" class="<?=($feedback['rate'] >= 1)?'fas':'far'?> fa-star tw-text-yellow-400"></i>
                                                                <i style="font-size: 13px;" class="<?=($feedback['rate'] >= 2)?'fas':'far'?> fa-star tw-text-yellow-400 tw--ml-1"></i>
                                                                <i style="font-size: 13px;" class="<?=($feedback['rate'] >= 3)?'fas':'far'?> fa-star tw-text-yellow-400 tw--ml-1"></i>
                                                                <i style="font-size: 13px;" class="<?=($feedback['rate'] >= 4)?'fas':'far'?> fa-star tw-text-yellow-400 tw--ml-1"></i>
                                                                <i style="font-size: 13px;" class="<?=($feedback['rate'] >= 5)?'fas':'far'?> fa-star tw-text-yellow-400 tw--ml-1"></i>
                                                            </div>
                                                            <div><?= date('d-m-Y', strtotime($feedback['created_at'])) ?></div>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <?php if($feedback['comment'] == null){ ?>
                                                            No comment in this feedback.
                                                        <?php }else{ ?>
                                                            <?= $feedback['comment'] ?>
                                                        <?php } ?>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php }} ?>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Entry-->
            </div>
            <!--end::Content-->
        </div>
    </body>
    <script>
        function create_confirmation()
        {
            $("#create_form").submit();
        }
    </script>
</html>