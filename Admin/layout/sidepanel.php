<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
    <!--begin::Brand-->
    <div class="brand tw-w-full d-flex" id="kt_brand">
        <!--begin::Logo-->
        <a href="Admin/admin/index.php">
            <!-- <img src="" style="width: 100px; height:50px;" alt=""> -->
            <div class="tw-font-semibold tw-text-white tw-text-2xl">PriceCom</div>
        </a>
        <!--end::Logo-->
    </div>
    <!--end::Brand-->
    
    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1" data-menu-dropdown-timeout="500">
            <!--begin::Menu Nav-->
            <ul class="menu-nav" style="padding-top: 0px;">
                <!-- User::start -->
                <li class="menu-section">
                    <h4 class="menu-text">User Management</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <li class="tw-w-full" aria-haspopup="true" data-menu-toggle="hover">
                    <div class="tw-pr-6 tw-py-1">
                      <a href="Admin/admin/index.php">
                        <?php if (getcwd() == "C:\laragon\www\PriceCom\Admin\admin") { ?>
                          <div class="tw-pl-6 tw-py-3 tw-rounded tw-font-semibold tw-bg-white tw-bg-opacity-50 tw-text-black">
                        <?php } else { ?>
                          <div class="tw-pl-6 tw-py-3 tw-rounded tw-font-semibold hover:tw-bg-white hover:tw-bg-opacity-50 hover:tw-text-black">
                        <?php } ?>
                          <span style="font-size: 16px" class="far fa-user tw-mx-4 tw-opacity-40"></span>
                          Admin
                        </div>
                      </a>
                    </div>
                </li>
                <li class="tw-w-full" aria-haspopup="true" data-menu-toggle="hover">
                    <div class="tw-pr-6 tw-py-1">
                      <a href="Admin/user/index.php">
                        <?php if (getcwd() == "C:\laragon\www\PriceCom\Admin\user") { ?>
                          <div class="tw-pl-6 tw-py-3 tw-rounded tw-font-semibold tw-bg-white tw-bg-opacity-50 tw-text-black">
                        <?php } else { ?>
                          <div class="tw-pl-6 tw-py-3 tw-rounded tw-font-semibold hover:tw-bg-white hover:tw-bg-opacity-50 hover:tw-text-black">
                        <?php } ?>
                          <span style="font-size: 16px" class="fas fa-user tw-mx-4 tw-opacity-40"></span>
                          User
                        </div>
                      </a>
                    </div>
                </li>
                <!-- User::start -->

                <!-- Product::start -->
                <li class="menu-section">
                    <h4 class="menu-text">Category Management</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <li class="tw-w-full" aria-haspopup="true" data-menu-toggle="hover">
                    <div class="tw-pr-6 tw-py-1">
                      <a href="Admin/category/index.php">
                        <?php if (getcwd() == "C:\laragon\www\PriceCom\Admin\category") { ?>
                          <div class="tw-pl-6 tw-py-3 tw-rounded tw-font-semibold tw-bg-white tw-bg-opacity-50 tw-text-black">
                        <?php } else { ?>
                          <div class="tw-pl-6 tw-py-3 tw-rounded tw-font-semibold hover:tw-bg-white hover:tw-bg-opacity-50 hover:tw-text-black">
                        <?php } ?>
                          <span style="font-size: 16px" class="fa-shapes fas tw-mx-4 tw-opacity-40"></span>
                          Category
                        </div>
                      </a>
                    </div>
                </li>
                <!-- Product::end -->

                <!-- Product::start -->
                <li class="menu-section">
                    <h4 class="menu-text">Product Management</h4>
                    <i class="menu-icon ki ki-bold-more-hor icon-md"></i>
                </li>
                <li class="tw-w-full" aria-haspopup="true" data-menu-toggle="hover">
                    <div class="tw-pr-6 tw-py-1">
                      <a href="Admin/product/index.php">
                        <?php if (getcwd() == "C:\laragon\www\PriceCom\Admin\product") { ?>
                          <div class="tw-pl-6 tw-py-3 tw-rounded tw-font-semibold tw-bg-white tw-bg-opacity-50 tw-text-black">
                        <?php } else { ?>
                          <div class="tw-pl-6 tw-py-3 tw-rounded tw-font-semibold hover:tw-bg-white hover:tw-bg-opacity-50 hover:tw-text-black">
                        <?php } ?>
                          <span style="font-size: 16px" class="fas fa-dolly-flatbed tw-mx-4 tw-opacity-40"></span>
                          Product
                        </div>
                      </a>
                    </div>
                </li>
                <!-- Product::start -->
            </ul>
            <!--end::Menu Nav-->
        </div>
        <!--end::Menu Container-->
    </div>
    <!--end::Aside Menu-->
</div>