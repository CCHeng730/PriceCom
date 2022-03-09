<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>PriceCom | Admin</title>
        <link href="assets/app.css" rel="stylesheet" type="text/css" />
    </head>
    <body>
        <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
            <!--begin::Profile Card-->
            <div class="card card-custom card-stretch">
                <!--begin::Body-->
                <div class="card-body pt-8">
                    <!--begin::User-->
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                            <div class="symbol-label" style="background-image:url(<?=(isset($adminfetch['image']))?'./Admin/admin/'.$adminfetch['image']:"https://shacknews-ugc.s3.us-east-2.amazonaws.com/user/9647/article-inline/2021-03/template.jpg?versionId=EPuOpjX7pGmrwxIxaF8BBrMfaK4X7f.S" ?>)"></div>
                        </div>
                        <div>
                            <div class="font-weight-bolder font-size-h5 text-dark-75 "><?=(isset($adminfetch['username']))?$adminfetch['username']:''?></div>
                            <div class="text-muted"><?=(($adminfetch['gender'] == 0))?'Male':'Female'?></div>
                            <div class="mt-2">
                                <div class="btn-sm <?=($adminfetch['super'] == 1)? 'btn-warning': 'btn-success'?> font-weight-bold mr-2 py-2 px-3 px-xxl-5 my-1 "><?=(($adminfetch['super'] ==1))?'Super Admin':'Admin'?></div>
                            </div>
                        </div>
                    </div>
                    <!--end::User-->
                    <!--begin::Contact-->
                    <div class="py-9">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Email:</span>
                            <div class="text-muted"><?=(isset($adminfetch['email']))?$adminfetch['email']:''?></div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <span class="font-weight-bold mr-2">Phone:</span>
                            <span class="text-muted"><?=(isset($adminfetch['phone_no']))?$adminfetch['phone_no']:''?></span>
                        </div>
                    </div>
                    <!--end::Contact-->
                    <!--begin::Nav-->
                    <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                        <div class="navi-item mb-2">
                            <a href="Admin/admin/show.php" class="navi-link py-4">
                                <span class="navi-icon mr-2">
                                    <span class="svg-icon fas fa-user" style="font-size: 18px;">
                                    </span>
                                </span>
                                <span class="navi-text font-size-lg">Admin Information</span>
                            </a>
                        </div>
                        <div class="navi-item mb-2">
                            <a href="Admin/admin/edit.php" class="navi-link py-4">
                                <span class="navi-icon mr-2">
                                    <span class="svg-icon fas fa-user-shield" style="font-size: 18px;">
                                    </span>
                                </span>
                                <span class="navi-text font-size-lg">Edit Admin Information</span>
                            </a>
                        </div>
                    </div>
                    <!--end::Nav-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Profile Card-->
        </div>
    </body>
</html>