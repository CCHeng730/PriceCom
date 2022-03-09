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
            <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                    <!--begin::Info-->
                    <div class="d-flex align-items-center flex-wrap mr-2">
                        <!--begin::Page Title-->
                        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Category</h5>
                        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
                        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">NAME</h5>
                        <!--end::Page Title-->
                    </div>
                    <!--end::Info-->
                    <!--begin::Toolbar-->
                    <div class="d-flex align-items-center">
                        <a href="Admin/category/index.php" class="tw-px-5 tw-mx-1 tw-py-3 tw-bg-gray-200 tw-rounded-md tw-text-black hover:tw-text-black tw-font-medium hover:tw-bg-gray-300">
                            Back
                        </a>
                        <a href="Admin/category/edit.php" class="tw-px-5 tw-mx-1 tw-py-3 tw-bg-blue-500 tw-rounded-md tw-text-white tw-font-medium hover:tw-text-white hover:tw-bg-blue-600">
                            Edit Category
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
                                <form class="form" id="kt_form">
                                    <div class="tab-content">
                                        <!--begin::Tab-->
                                        <div class="tab-pane show active px-7" id="kt_user_edit_tab_1" role="tabpanel">
                                            <!--begin::Row-->
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
                                                                    style="width: 140px; height:140px;" src="https://shacknews-ugc.s3.us-east-2.amazonaws.com/user/9647/article-inline/2021-03/template.jpg?versionId=EPuOpjX7pGmrwxIxaF8BBrMfaK4X7f.S" alt="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                    <!--begin::Group-->
                                                    <div class="form-group row">
                                                        <label class="col-form-label col-3 text-lg-right text-left">Name</label>
                                                        <div class="col-9">
                                                            <input class="form-control form-control-lg form-control-solid" type="text" style="background-color: #EFF6FF;" value="{{ $category->name }}" placeholder="Name..." readonly />
                                                        </div>
                                                    </div>
                                                    <!--end::Group-->
                                                </div>
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Tab-->
                                    </div>
                                </form>
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