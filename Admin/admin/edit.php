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

$adminid = $_GET['id'];
$adminQuery = query("select * from admin where deleted_at is null and id = '$adminid' ");
$adminfetch = fetch($adminQuery);

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];

    $emailUnique = row(query("select * from admin where email = '$email' and id != '$adminid'"));
    $phoneUnique = row(query("select * from admin where phone_no = '$phone_no' and id != '$adminid'"));

    //username validation
    if ($username == "") {
        $uerror = "*This field is required";
    }
    //phone no validation
    if ($phone_no == "") {
        $perror = "*This field is required";
    } elseif ($phoneUnique > 0) {
        $perror = "*This phone number has already been taken!";
    }
    //email validation
    if ($email == "") {
        $eerror = "*This field is required";
    } elseif ($emailUnique > 0) {
        $eerror = "*This email address has already been taken!";
    }
    //gender validation
    if ($gender == null) {
        $gerror = "*This field is required";
    }

    //if all clear
    if (!isset($uerror) && !isset($eerror) && !isset($confirmError) && !isset($gerror)) {
        $currentDate = date('Y-m-d H:i:s');

        if (isset($_FILES['photo']['name'])) {
            $imageResponse = uploadFile($_FILES['photo']);
        }

        if ($imageResponse != null) { //upload file
            if ($imageResponse[1] != 0) { //success upload file
                //update record
                query("update admin set username='$username', phone_no='$phone_no', email='$email',gender='$gender',image='$imageResponse[0]'
                            where id='$readid'");

                //redirect back
                ?><script>window.location.href = "index.php"</script><?php
            } else {
                //return error message
                $ierror = $imageResponse[0];
            }
        } else {
            //update record without image
            query("update admin set username='$username', phone_no='$phone_no', email='$email',gender='$gender'
                            where id='$readid'");

            //redirect back
            ?><script>window.location.href = "index.php"</script><?php
        }
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
                        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Edit</h5>
                        <!--end::Page Title-->
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a href="Admin/admin/index.php" class="tw-px-5 tw-mx-1 tw-py-3 tw-bg-gray-200 tw-rounded-md tw-text-black hover:tw-text-black tw-font-medium hover:tw-bg-gray-300">
                            Back
                        </a>
<!--                        <div style="cursor: pointer; color: white;" class="tw-px-5 tw-mx-1 tw-py-3 tw-bg-blue-500 tw-rounded-md tw-text-white tw-font-medium hover:tw-text-white hover:tw-bg-blue-600">-->
<!--                            Save Change-->
<!--                        </div>-->
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
                                            <span class="text-muted font-weight-bold font-size-sm mt-1">User: <?=$adminfetch['username']?> personal informaiton</span>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Form-->
                                    <form method="post">
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            <div class="row">
                                                <label class="col-xl-3"></label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <h5 class="font-weight-bold mb-6">Admin Info</h5>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-xl-3 col-lg-3 col-form-label text-right">Avatar</label>
                                                <div class="cold-lg-9 col-xl-6">
                                                    <div>
                                                        <div class="image-input image-input-outline"
                                                            id="kt_user_add_avatar">   
                                                            <img id="imageDefaultImg" class="tw-object-cover tw-rounded-md tw-inset-0 tw-border-solid tw-border-2 tw-border-gray-300" 
                                                                    style="width: 140px; height:140px;" src="<?=(isset($adminfetch['image']))?'./Admin/admin/'.$adminfetch['image']:"https://shacknews-ugc.s3.us-east-2.amazonaws.com/user/9647/article-inline/2021-03/template.jpg?versionId=EPuOpjX7pGmrwxIxaF8BBrMfaK4X7f.S" ?>" alt="">
                                                            <img id="imageResult1" class="tw-object-cover tw-rounded-md tw-inset-0 tw-border-solid tw-border-2 tw-border-gray-300" src=""
                                                                style="display:none; width: 140px; height:140px;"
                                                                value="{{ old('image') }}"> 
                                                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                                <i class="fa fa-pen icon-sm text-muted"></i>
                                                                <input type="file" name="image" value="<?=$adminfetch['image']?>" onchange="readURL(this,1);" accept=".png, .jpg, .jpeg" />
                                                            </label>
                                                            <span class="error text-danger"><?= (isset($ierror)) ? $ierror : "" ?></span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">Name</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <input class="form-control form-control-lg form-control-solid" type="text" name="username" placeholder="Name...." value="<?= (isset($_POST['username']))?$_POST['username'] : $adminfetch['username']?>" />
                                                    <span class="error text-danger"><?= (isset($uerror)) ? $uerror : "" ?></span>
                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">Gender</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <select name="gender" class="form-control form-control-lg form-control-solid">
                                                        <option value="null" selected disabled> -- Choose Your Gender -- </option>
                                                        <option value="0" <?= ($_POST['gender'] == 0) ?'selected': (($adminfetch['gender'] == 0)?"selected":"")?> >Male</option>
                                                        <option value="1" <?= ($_POST['gender'] == 1) ?'selected': (($adminfetch['gender'] == 1)?"selected":"")?> >Female</option>
                                                    </select>
                                                    <span class="error text-danger"><?= (isset($gerror)) ? $gerror : "" ?></span>

                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <div class="row">
                                                <label class="col-xl-3"></label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <h5 class="font-weight-bold mt-5 mb-6">Contact Info</h5>
                                                </div>
                                            </div>
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">Contact Phone</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-phone"></i>
                                                            </span>
                                                        </div>
                                                        <input type="number" class="form-control form-control-lg form-control-solid" name="phone_no" placeholder="Phone...." required value="<?= (isset($_POST['phone_no']))?$_POST['phone_no'] : $adminfetch['phone_no']?>" />
                                                    </div>
                                                    <span class="error text-danger"><?= (isset($perror)) ? $perror : "" ?></span>

                                                </div>
                                            </div>
                                            <!--end::Group-->
                                            <!--begin::Group-->
                                            <div class="form-group row">
                                                <label class="col-form-label col-3 text-lg-right text-left">Email Address</label>
                                                <div class="col-lg-9 col-xl-6">
                                                    <div class="input-group input-group-lg input-group-solid">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="la la-at"></i>
                                                            </span>
                                                        </div>
                                                        <input type="email" class="form-control form-control-lg form-control-solid" name="email" placeholder="Email...." value="<?= (isset($_POST['email']))?$_POST['email'] : $adminfetch['email']?>"/>
                                                    </div>
                                                    <span class="error text-danger"><?= (isset($eerror)) ? $eerror : "" ?></span>
                                                    <span class="form-text text-muted">We'll never share your email with anyone else.</span>
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