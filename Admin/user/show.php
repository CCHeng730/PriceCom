<?php
ob_start();
include_once("../../connection.php");

if(!isset($_SESSION['aid'])) { //check if logged in
    ?><script>window.location.href="../auth/login.php"</script><?php
}
$readid = $_GET['id'];
$authid = $_GET['auth'];
$checkid = md5($readid).sha1($readid);

if($checkid != $authid){ //parameter not match with encrypted one
    ?><script>window.location.href="index.php"</script><?php
}

if(!isset($_GET['id'])){ //not getting parameter
    ?><script>window.location.href="index.php"</script><?php
}

$userid = $_GET['id'];
$userfetch = fetch(query("select * from user where id = '$userid'"));

?>
<!DOCTYPE html>
<html>
    <head>
        <base href="../../">
        <meta charset="utf-8" />
        <title>PriceCom | User</title>
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
                        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">User</h5>
                        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?=$userfetch['username']?></h5>
                        <!--end::Page Title-->
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a href="Admin/user/index.php" class="tw-px-5 tw-mx-1 tw-py-3 tw-bg-gray-200 tw-rounded-md tw-text-black hover:tw-text-black tw-font-medium hover:tw-bg-gray-300">
                            Back
                        </a>
                    </div>
                    <!--end::Toolbar-->
                </div>
            </div>
            <!--end::Subheader-->
            
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container">
                        <!--begin::Profile Personal Information-->
                        <div class="d-flex flex-row">
                            <?php include "sidepanel.php" ?>
                            <!--begin::Content-->
                            <div class="flex-row-fluid ml-lg-8">
                                <!--begin::Card-->
                                <div class="card card-custom card-stretch">
                                    <!--begin::Header-->
                                    <div class="card-header py-3">
                                        <div class="card-title align-items-start flex-column">
                                            <h3 class="card-label font-weight-bolder text-dark">Personal Information</h3>
                                            <span class="text-muted font-weight-bold font-size-sm mt-1">User: NAME personal informaiton</span>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Form-->
                                    <form class="form">
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            <div class="row">
                                                <label class="col-xl-3"></label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <h5 class="font-weight-bold mb-6">User Info</h5>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-right">Avatar</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="image-input image-input-outline"
                                                        id="kt_user_add_avatar">
                                                        <img id="imageDefaultImg" class="tw-object-cover tw-rounded-md tw-inset-0 tw-border-solid tw-border-2 tw-border-gray-300" 
                                                                style="width: 140px; height:140px;" alt=""
                                                                src="<?=($userfetch['image'] == null)? 'https://shacknews-ugc.s3.us-east-2.amazonaws.com/user/9647/article-inline/2021-03/template.jpg?versionId=EPuOpjX7pGmrwxIxaF8BBrMfaK4X7f.S': "Admin".$userfetch['image']?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-right">Name</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input value="<?=$userfetch['username']?>" class="form-control form-control-lg form-control-solid" style="background-color: #EFF6FF;" type="text"readonly />
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-right">Gender</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input value="<?=(($userfetch['gender'] ==1))?'Male':'Female'?>" class="form-control form-control-lg form-control-solid" style="background-color: #EFF6FF;" type="text"readonly />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-xl-3"></label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <h5 class="font-weight-bold mt-5 mb-6">Contact Info</h5>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-right">Contact Phone</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" style="background-color: #EFF6FF;">
                                                                <i class="la la-phone"></i>
                                                            </span>
                                                        </div>
                                                        <input value="<?=$userfetch['phone_no']?>" type="text" class="form-control form-control-lg form-control-solid" style="background-color: #EFF6FF;" placeholder="Phone" readonly />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-right">Email Address</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text" style="background-color: #EFF6FF;">
                                                                <i class="la la-at"></i>
                                                            </span>
                                                        </div>
                                                        <input value="<?=$userfetch['email']?>" type="text" class="form-control form-control-lg form-control-solid" style="background-color: #EFF6FF;" placeholder="Email" readonly />
                                                    </div>
                                                    <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                            </div>
                            <!--end::Content-->
                        </div>
                        <!--end::Profile Personal Information-->
                    </div>
                    <!--end::Container-->
                </div>
            </div>
            <!--end::Content-->
        </div>
    </body>
</html>