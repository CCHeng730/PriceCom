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
                        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Create Admin</h5>
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a href="Admin/admin/index.php" class="tw-px-5 tw-mx-1 tw-py-3 tw-bg-gray-200 tw-rounded-md tw-text-black hover:tw-text-black tw-font-medium hover:tw-bg-gray-300">
                            Back
                        </a>
                        <div style="cursor: pointer; color: white;" class="tw-px-5 tw-mx-1 tw-py-3 tw-bg-blue-500 tw-rounded-md tw-text-white tw-font-medium hover:tw-text-white hover:tw-bg-blue-600">
                            Create Admin
                        </div>
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
                                        <div class="row">
                                            <div class="col-xl-2"></div>
                                            <div class="col-xl-7 my-2">
                                                <div>
                                                    <!--begin::Row-->
                                                    <div class="row">
                                                        <label class="col-3"></label>
                                                        <div class="col-9">
                                                            <h6 class="text-dark font-weight-bold mb-10">Create New Admin : </h6>
                                                        </div>
                                                    </div>
                                                    <!--end::Row-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-3 text-lg-right text-left">Avatar</label>
                                                        <div class="col-9">
                                                            <div>
                                                                <div class="image-input image-input-outline" id="kt_user_add_avatar">
                                                                    <img id="imageDefaultImg" class="tw-object-cover tw-rounded-md tw-inset-0 tw-border-solid tw-border-2 tw-border-gray-300" 
                                                                            style="width: 140px; height:140px;" src="https://shacknews-ugc.s3.us-east-2.amazonaws.com/user/9647/article-inline/2021-03/template.jpg?versionId=EPuOpjX7pGmrwxIxaF8BBrMfaK4X7f.S" alt="">
                                                                    <img id="imageResult1" class="tw-object-cover tw-rounded-md tw-inset-0 tw-border-solid tw-border-2 tw-border-gray-300" src=""
                                                                        style="display:none; width: 140px; height:140px;"
                                                                        value="{{ old('image') }}"> 
                                                                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change avatar">
                                                                        <i class="fa fa-pen icon-sm text-muted"></i>
                                                                        <input type="file" name="image" onchange="readURL(this,1);" accept=".png, .jpg, .jpeg" />
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-3 text-lg-right text-left">Name</label>
                                                        <div class="col-9">
                                                            <input class="form-control form-control-lg form-control-solid" type="text" name="name" placeholder="Name...." />
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-3 text-lg-right text-left">Email Address</label>
                                                        <div class="col-9">
                                                            <div class="input-group input-group-lg input-group-solid">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-at"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="email" class="form-control form-control-lg form-control-solid" name="email" placeholder="Email...." />
                                                            </div>
                                                            <span class="form-text text-muted">We'll never share your email with anyone else.</span>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-3 text-lg-right text-left">Gender</label>
                                                        <div class="col-9">
                                                            <select name="gender" class="form-control form-control-lg form-control-solid">
                                                                <option value="null"> -- Choose Your Gender -- </option>
                                                                <option value="0">Male</option>
                                                                <option value="1">Female</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-3 text-lg-right text-left">Contact Phone</label>
                                                        <div class="col-9">
                                                            <div class="input-group input-group-lg input-group-solid">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text">
                                                                        <i class="la la-phone"></i>
                                                                    </span>
                                                                </div>
                                                                <input type="text" class="form-control form-control-lg form-control-solid" name="contact_number" placeholder="Phone...." />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-3 text-lg-right text-left">Password</label>
                                                        <div class="col-9">
                                                            <input class="form-control form-control-lg form-control-solid" type="password" name="password" placeholder="Password...." />
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-3 text-lg-right text-left">Confirm Password</label>
                                                        <div class="col-9">
                                                            <input class="form-control form-control-lg form-control-solid" type="password" name="confirm_password" placeholder="Confirm Password...." />
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                </div>
                                            </div>
                                        </div>
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
    </body>
</html>