<?php
ob_start();
include_once("../../connection.php");
include ("../../uploadfile.php");

if(!isset($_SESSION['aid'])) { //check if logged in
    ?><script>window.location.href="../auth/login.php"</script><?php
}
$categoryid = $_GET['id'];
$categoryfetch = fetch(query("select * from category where id = '$categoryid'"));

if(isset($_POST['submit'])){
    $cname = $_POST['cname'];

    $nameUnique = row(query("select * from category where name = '$cname' and id != '$categoryid'"));

    //category name validation
    if ($cname == "") {
        $nerror = "*This field is required";
    } elseif ($nameUnique > 0) {
        $nerror = "*This phone number has already been taken!";
    }

    //if all clear
    if (!isset($uerror) && !isset($eerror) && !isset($confirmError) && !isset($gerror)) {
        $currentDate = date('Y-m-d H:i:s');

        if ($_FILES['photo']['name'] != '') {
            $imageResponse = uploadFile($_FILES['photo']);
        }else{
            $imageResponse = null;
        }

        if ($imageResponse != null) { //upload file
            if ($imageResponse[1] != 0) { //success upload file
                //update record
                query("update category set name='$cname',image='$imageResponse[0]'
                            where id='$categoryid'");

                //redirect back
                ?><script>window.location.href = "show.php?id=<?=$categoryid?>"</script><?php
            } else {
                //return error message
                $ierror = $imageResponse[0];
            }
        } else {
            //update record without image
            query("update category set name='$cname' where id='$categoryid'");

            //redirect back
            ?><script>window.location.href = "show.php?id=<?=$categoryid?>"</script><?php
        }
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <base href="../../">
        <meta charset="utf-8" />
        <title>PriceCom | Category</title>
        <link href="assets/app.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <?php include "../layout/app.php" ?>
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <div>
                <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                    <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                        <!--begin::Info-->
                        <div class="d-flex align-items-center flex-wrap mr-2">
                            <!--begin::Page Title-->
                            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Category</h5>
                            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5"><?=$categoryfetch['name']?></h5>
                            <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Edit</h5>
                            <!--end::Page Title-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Toolbar-->
                        <div class="d-flex align-items-center">
                            <a href="Admin/category/show.php?id=<?=$categoryid?>" class="tw-px-5 tw-mx-1 tw-py-3 tw-bg-gray-200 tw-rounded-md tw-text-black hover:tw-text-black tw-font-medium hover:tw-bg-gray-300">
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
                            <!--begin::Card-->
                            <div class="card card-custom">
                                <!--begin::Card body-->
                                <div class="card-body px-0">
                                    <div class="tab-content">
                                        <!--begin::Tab-->
                                        <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
                                            <!--begin::Row-->
                                            <form method="post"  enctype="multipart/form-data">
                                                <div class="row">
                                                    <div class="col-xl-2"></div>
                                                    <div class="col-xl-7 my-2">
                                                        <!--begin::Row-->
                                                        <div class="row">
                                                            <label class="col-3"></label>
                                                            <div class="col-9">
                                                                <h6 class="text-dark font-weight-bold mb-10">Category Info : </h6>
                                                            </div>
                                                        </div>
                                                        <!--end::Row-->
                                                        <!--begin::Group-->
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-3 text-lg-right text-left">Image</label>
                                                            <div class="col-9">
                                                                <div class="image-input image-input-outline" id="kt_user_add_avatar">
                                                                    <img id="imageDefaultImg" class="tw-object-cover tw-rounded-md tw-inset-0 tw-border-solid tw-border-2 tw-border-gray-300" 
                                                                        style="width: 140px; height:140px;" src="<?=(isset($categoryfetch['image']))?'Admin/category/'.$categoryfetch['image']:"https://shacknews-ugc.s3.us-east-2.amazonaws.com/user/9647/article-inline/2021-03/template.jpg?versionId=EPuOpjX7pGmrwxIxaF8BBrMfaK4X7f.S" ?>" alt="">
                                                                    <img id="imageResult1" class="tw-object-cover tw-rounded-md tw-inset-0 tw-border-solid tw-border-2 tw-border-gray-300" src=""
                                                                        style="display:none; width: 140px; height:140px;"
                                                                        value="{{ old('image') }}"> 
                                                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                                        <input type="file" name="photo" onchange="readURL(this,1);" accept=".png, .jpg, .jpeg" />
                                                                    </label>
                                                                    <span class="error text-danger"><?= (isset($ierror)) ? $ierror : "" ?></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!--end::Group-->
                                                        <!--begin::Group-->
                                                        <div class="form-group row">
                                                            <label class="col-form-label col-3 text-lg-right text-left">Name</label>
                                                            <div class="col-9">
                                                                <input class="form-control form-control-lg form-control-solid" type="text" name="cname" value="<?= (isset($_POST['cname']))?$_POST['cname'] : $categoryfetch['name']?>" placeholder="Name..." />
                                                                <span class="error text-danger"><?= (isset($nerror)) ? $nerror : "" ?></span>
                                                            </div>
                                                        </div>
                                                        <!--end::Group-->
                                                        <!--begin::Submit Button-->
                                                        <div class="row">
                                                            <label class="col-3"></label>
                                                            <button type="submit" class="btn btn-primary font-weight-bold px-9 py-2 mx-4"
                                                                    name="submit">Edit
                                                            </button>
                                                        </div>
                                                        <!--end::Submit Button-->
                                                    </div>
                                                </div>
                                            </form>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Tab-->
                                    </div>
                                </div>
                                <!--begin::Card body-->
                            </div>
                            <!--end::Card-->
                        </div>
                        <!--end::Container-->
                    </div>
                </div>
                <!--end::Content-->
            </div>
        </div>
    </body>
</html>