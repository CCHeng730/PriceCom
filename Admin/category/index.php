<?php
ob_start();
include_once("../../connection.php");

if(!isset($_SESSION['aid'])) { //check if logged in
    ?><script>window.location.href="../auth/login.php"</script><?php
}

$categoryQuery = query("select * from category where deleted_at IS NULL");
$total_category = mysqli_num_rows($categoryQuery);

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
        <div class="subheader py-2 subheader-solid" id="kt_subheader">
            <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                <!--begin::Details-->
                <div class="d-flex align-items-center flex-wrap mr-2">
                    <!--begin::Title-->
                    <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">Category</h5>
                    <!--end::Title-->
                    <!--begin::Separator-->
                    <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-5 bg-gray-200"></div>
                    <!--end::Separator-->
                    <div class="d-flex align-items-center" id="kt_subheader_search">
                        <span class="text-dark-50 font-weight-bold" id="kt_subheader_total"><?php echo $total_category?> Total</span>
                        <form class="ml-5">
                            <div class="input-group input-group-sm input-group-solid" style="max-width: 175px">
                                <input type="text" class="form-control datatable-input" id="category_search" placeholder="Search..." />
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
                <div class="btn-group ml-2">
                    <a href="Admin/category/create.php" type="button" class="btn btn-primary font-weight-bold btn-sm px-3 font-size-base">
                        New Category
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
                <div class="container-fluid">
                    <!--begin::Card-->
                    <div class="card card-custom">
                        <!--begin::Body-->
                        <div class="card-body">
                            <form class="form">
                                <!--begin::Body-->
                                <div class="col-lg-12">
                                    <div class="tw-px-6 tw-py-3">
                                        <table class="table table-checkable dataTable dtr-inline w-100 tw-font-medium" id="datatable">
                                            <thead>
                                                <tr class="tw-border-b-2 tw-b-gray-300">
                                                    <th style="width: 13%">CategoryID</th>
                                                    <th style="width: 30%">Name</th>
                                                    <th style="width: 20%">image</th>
                                                    <th style="width: 12%">Status</th>
                                                    <th style="width: 25%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                while($category=fetch($categoryQuery)) {
                                            ?>
                                                <tr class="tw-bg-white tw-border-gray-300 tw-border-b-2">
                                                    <td><?=$category['id']?></td>
                                                    <td><?=$category['name']?></td>
                                                    <td><?=$category['image']?></td>
                                                    <td class="tw-text-center">
                                                        <span class="<?=($category['status'] == 1)? 'tw-bg-red-300': 'tw-bg-green-400'?> tw-text-center tw-rounded-md tw-text-white tw-px-4 tw-py-1">
                                                            <?=($category['status'] == 1)? 'Terminate': 'Active'?>
                                                        </span>
                                                    </td>
                                                    <td class="tw-text-center">
                                                        <a href="Admin/category/show.php?id=<?=$category['id']?>&auth=<?=md5($category['id']).sha1($category['id'])?>" style="background-color: rgb(54,153,255);" class="tw-text-white tw-px-5 tw-py-2 tw-rounded-md tw-text-lg tw-font-semibold">View</a>
                                                        <a href="Admin/category/edit.php?id=<?=$category['id']?>&auth=<?=md5($category['id']).sha1($category['id'])?>" class="tw-text-white tw-bg-yellow-400 tw-px-5 tw-py-2 tw-rounded-md tw-text-lg tw-font-semibold">Edit</a>
                                                        <a onclick="triggerSweet(<?=$category['id']?>,'<?=md5($category['id']).sha1($category['id'])?>')" class="tw-text-white tw-bg-red-400 tw-px-5 tw-py-2 tw-rounded-md tw-text-lg tw-font-semibold text-white" onclick="return confirm('Are you sure to delete this record?')">Delete</a>

                                                    </td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </form>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
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
        $('#category_search').keyup(function() {
            dTable.search($(this).val()).draw();
        })

        function triggerSweet(catid,authid) {
            Swal.fire({
                title: 'Delete this category?',
                text: "All products related to the category will be removed too!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    Swal.fire(
                        'Deleted!',
                        'Records has been deleted.',
                        'success'
                    ).then( function(){
                        window.location.href = "Admin/category/delete.php?id="+catid+"&auth="+authid
                    })

                    // result.dismiss can be 'cancel', 'overlay',
                    // 'close', and 'timer'
                } else if (result.dismiss === 'cancel') {
                    Swal.fire(
                        'Cancelled',
                        'Records are safe :)',
                        'error'
                    )
                }
            });
        }
    </script>
</html>