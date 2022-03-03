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
                        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">USERNAME</h5>
                        <!--end::Page Title-->
                    </div>
                    <!--end::Info-->
                </div>
                <!--begin::Toolbar-->
                <div class="d-flex align-items-start tw-pr-5">
                    <a href="Admin/user/order.php" class="tw-px-5 tw-mx-1 tw-py-3 tw-bg-gray-200 tw-rounded-md tw-text-black hover:tw-text-black tw-font-medium hover:tw-bg-gray-300">
                        Back
                    </a>
                </div>
                <!--end::Toolbar-->
            </div>
            <!--end::Subheader-->
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                <div class="d-flex flex-column-fluid">
                    <!--begin::Container-->
                    <div class="container">
                        <div class="row">
                            <!--begin::Card-->
                            <div class="col-lg-7" style="min-height: 30rem;">
                                <div class="card card-custom card-stretch tw-px-10 tw-py-3 gutter-b">
                                    <div class="card-body">
                                        <table class="tw-w-full" style="min-height: 20rem;">
                                            <tr>
                                                <td style="width: 35%; vertical-align: top;">
                                                <!--begin: Pic-->
                                                    <div class="flex-shrink-0 mt-lg-0 mt-3">
                                                        <img alt="" class="tw-object-cover tw-inset-0 tw-rounded-lg tw-w-full" style="height:150px;" src="https://shacknews-ugc.s3.us-east-2.amazonaws.com/user/9647/article-inline/2021-03/template.jpg?versionId=EPuOpjX7pGmrwxIxaF8BBrMfaK4X7f.S" />
                                                    </div>
                                                    <!--end: Pic-->
                                                </td>
                                                <td style="width: 65%; vertical-align: top;" class="tw-pl-5">
                                                    <div style="font-size: 20px" class="d-flex text-dark font-weight-bold">input_name</div>
                                                    <div class="tw-line-clamp-5 font-weight-bold text-dark-50">Description.</div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="separator separator-solid my-7"></div>
                                        <!--begin: Items-->
                                        <div class="d-flex tw-justify-between flex-wrap">
                                            <div class="d-flex">
                                                <!--begin: Item-->
                                                <div class="d-flex my-1 tw-mr-10">
                                                    <span class="mr-4">
                                                        <i style="font-size: 25px" class="tw-text-gray-300 fas fa-coins"></i>
                                                    </span>
                                                    <div class="d-flex flex-column text-dark-75">
                                                        <span class="font-weight-bolder font-size-sm">Total Price</span>
                                                        <span class="font-weight-bolder font-size-h5">RM 00.00</span>
                                                    </div>
                                                </div>
                                                <!--end: Item-->
                                                <!--begin: Item-->
                                                <div class="d-flex my-1">
                                                    <span class="mr-4">
                                                        <i style="font-size: 25px" class="tw-text-gray-300 fas fa-store"></i>
                                                    </span>
                                                    <div class="d-flex flex-column text-dark-75">
                                                        <span class="font-weight-bolder font-size-sm">Store</span>
                                                        <span class="font-weight-bolder font-size-h5">Store name</span>
                                                    </div>
                                                </div>
                                                <!--end: Item-->
                                            </div>
                                            <!--begin: Item-->
                                            <div class="d-flex my-1">
                                                <div class="d-flex tw-justify-end py-2">
                                                    <div class="font-weight-bold tw-py-2 tw-mr-4">Purchased at :</div>
                                                    <span class="tw-py-2 btn-text text-uppercase font-weight-bold">00/00/0000</span>
                                                </div>
                                            </div>
                                            <!--end: Item-->
                                        </div>
                                        <!--begin: Items-->
                                    </div>
                                </div>
                            </div>
                            <!--end::Card-->
                            <!--begin::Card-->
                            <div class="col-lg-5">
                                <!--begin::Charts Widget 3-->
                                <div class="card card-custom card-stretch tw-px-10 tw-py-3 gutter-b">
                                    <!--begin::Header-->
                                    <div class="h-auto">
                                        <div class="card-title pt-5 pb-2 tw-border-gray-300 tw-border-b-2 tw-border-solid">
                                            <h3 class="card-label">
                                                <span class="d-block text-dark font-weight-bolder">Summary</span>
                                                <span class="d-block text-muted mt-2 font-size-sm">View Grand Total of this order</span>
                                            </h3>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="tw-bg-gray-100 tw-rounded-lg tw-p-4 tw-mb-4">
                                        <div class="tw-px-6">
                                            <div class="row tw-border-b-2 tw-py-2 tw-mb-2 tw-border-solid tw-border-gray-500">
                                                <div class="col-6 tw-font-medium" style="font-size: 15px;">Product</div>
                                                <div class="col-6 tw-font-medium" style="font-size: 15px;">Price (RM)</div>
                                            </div>
                                            <div class="row tw-py-3">
                                                <div class="col-6 tw-py-2">
                                                    <div class="tw-font-medium" style="font-size: 15px;">input_name</div>
                                                </div>
                                                <div class="col-6 tw-py-2 tw-font-medium" style="font-size: 15px;">RM 00.00</div>
                                            </div>
                                            <div class="row tw-border-t-2 tw-py-2 tw-border-solid tw-border-gray-300">
                                                <div class="col-6">
                                                    <div class="tw-font-medium" style="font-size: 15px;">Shipping Fee</div>
                                                </div>
                                                <div class="col-6 tw-font-medium" style="font-size: 15px;">RM 5.00</div>
                                            </div>
                                            <div class="row tw-border-b-2 tw-border-t-2 tw-py-2 tw-mb-2 tw-border-solid tw-border-gray-500">
                                                <div class="col-6">
                                                    <div class="tw-font-medium" style="font-size: 15px;">Total Amount</div>
                                                </div>
                                                <div class="col-6 tw-font-medium" style="font-size: 15px;">RM 00.00</div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--end::Charts Widget 3-->
                            </div>
                            <!--end::Card-->
                        </div>
                    </div>
                    <!--end::Container-->
                </div>
            </div>
            <!--end::Content-->
        </div>
    </body>
</html>