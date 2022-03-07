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
                    <a href="Admin/user/index.php" class="tw-px-5 tw-mx-1 tw-py-3 tw-bg-gray-200 tw-rounded-md tw-text-black hover:tw-text-black tw-font-medium hover:tw-bg-gray-300">
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
                        <div class="d-flex flex-row">
                            <?php include "sidepanel.php" ?>
                            <div class="flex-row-fluid ml-lg-8">
                                <!--begin::Card-->
                                <div class="card card-custom card-stretch">
                                    <!--begin::Header-->
                                    <div class="card-header py-3 tw-justify-between tw-flex">
                                        <div class="card-title align-items-start flex-column">
                                            <h3 class="card-label font-weight-bolder text-dark">Purchase History</h3>
                                            <span class="text-muted font-weight-bold font-size-sm mt-1">User: USERNAME Purcchase History</span>
                                        </div>
                                        <div class="d-flex align-items-center" id="kt_subheader_search">
                                            <span class="text-dark-50 font-weight-bold" id="kt_subheader_total">0 Total</span>
                                            <form class="ml-5">
                                                <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
                                                    <input type="text" class="form-control" id="search" placeholder="Search..." />
                                                    <div class="input-group-append">
                                                    <span class="input-group-text">
                                                        <span class="svg-icon">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/General/Search.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24" />
                                                                    <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                                                    <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                        <!--<i class="flaticon2-search-1 icon-sm"></i>-->
                                                    </span>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Form-->
                                    <form class="form">
                                        <!--begin::Body-->
                                        <div class="col-lg-12">
                                            <div class="tw-p-6">
                                                <table class="table table-checkable dataTable dtr-inline w-100 tw-font-medium" id="datatable">
                                                    <thead>
                                                        <tr class="tw-border-b-2 tw-b-gray-300">
                                                            <th style="width: 20%">Order ID</th>
                                                            <th style="width: 40%">Product</th>
                                                            <th style="width: 20%">Price</th>
                                                            <th style="width: 20%"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr class="tw-bg-white tw-border-gray-300 tw-border-b-2">
                                                            <td>
                                                                OrderID
                                                            </td>
                                                            <td>
                                                                Product Name 01
                                                            </td>
                                                            <td>
                                                                RM 01.00
                                                            </td>
                                                            <td class="tw-text-center">
                                                                <a href="Admin/user/order_detail.php" style="background-color: rgb(54,153,255);" class="tw-text-white tw-px-5 tw-py-2 tw-rounded-md tw-text-lg tw-font-semibold">View</a>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Container-->
                </div>
            </div>
            <!--end::Content-->
        </div>
    </body>
    <script>
        $(document).ready( function () {
            dTable=$('#datatable').DataTable({
                "paging":true,
                "bFilter": true,
                "ordering": true,
                "lengthChange": false
            });
        });
        $('#search').keyup(function() {
            dTable.search($(this).val()).draw();
        })
    </script>
</html>