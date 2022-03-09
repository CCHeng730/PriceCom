<?php
ob_start();
include_once("../../connection.php");

if(!isset($_SESSION['aid'])) { //check if logged in
    ?><script>window.location.href="../auth/login.php"</script><?php
}

$adminid = $_SESSION['aid'];
$adminQuery = query("select * from admin where deleted_at is null and id = '$adminid' ");
$adminfetch = fetch($adminQuery);

if(isset($_POST['submit'])){
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    //gender validation
    if ($password != $confirm_password) {
        $cerror = "*Password not match!";
    }

    //if all clear
    if (!isset($cerror) ) {
        $hashpass = "$1".md5(md5($adminfetch['email'])).sha1(sha1($password));
        query("update admin set password='$hashpass' where id='$adminid'");

        //redirect back
        ?><script>window.location.href="../admin/index.php"</script><?php
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <base href="../../">
    <meta charset="utf-8" />
    <title>PriceCom | Admin</title>
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
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Admin</h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?=$adminfetch['username']?></h5>
                <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">change password</h5>
                <!--end::Page Title-->
            </div>
            <!--end::Info-->
            <!--begin::Toolbar-->
            <div class="d-flex align-items-center">
                <a href="Admin/admin/index.php" class="tw-px-5 tw-mx-1 tw-py-3 tw-bg-gray-200 tw-rounded-md tw-text-black hover:tw-text-black tw-font-medium hover:tw-bg-gray-300">
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
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    <!--begin::Card-->
                    <div class="card card-custom card-stretch">
                        <!--begin::Header-->
                        <div class="card-header py-3">
                            <div class="card-title align-items-start flex-column">
                                <h3 class="card-label font-weight-bolder text-dark">Confidential Information</h3>
                                <span class="text-muted font-weight-bold font-size-sm mt-1">User: <?=$adminfetch['username']?> </span>
                            </div>
                        </div>
                        <!--end::Header-->
                        <!--begin::Form-->
                        <form method="post">
                            <!--begin::Body-->
                            <div class="card-body">

                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Password</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group input-group-lg input-group-solid">
                                            <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-lock"></i>
                                                            </span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="password" placeholder="New Password...." required value="<?= (isset($_POST['password']))?$_POST['password'] : ''?>" />
                                        </div>
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <label class="col-form-label col-3 text-lg-right text-left">Confirm Password</label>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="input-group input-group-lg input-group-solid">
                                            <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-user-lock"></i>
                                                            </span>
                                            </div>
                                            <input type="text" class="form-control form-control-lg form-control-solid" name="confirm_password" placeholder="Confirm Password...." value="<?= (isset($_POST['confirm_password']))?$_POST['confirm_password'] : ''?>"/>
                                        </div>
                                        <span class="error text-danger"><?= (isset($cerror)) ? $cerror : "" ?></span>
                                        <span class="form-text text-muted">We'll never share your information with anyone else.</span>
                                    </div>
                                </div>
                                <!--end::Group-->
                                <!--begin::Group-->
                                <div class="form-group row">
                                    <div class="col text-center">
                                        <button type="submit"
                                                class="btn btn-primary font-weight-bold px-9 py-4 my-3 mx-4"
                                                name="submit">Edit
                                        </button>
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