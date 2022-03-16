<header>
    <?php $Headeruser = fetch(query("select * from user where id = '$_SESSION[uid]'"))?>

    <!-- start navigation -->
    <nav class="navbar top-space navbar-expand-lg navbar-light bg-white header-light fixed-top header-reverse-scroll">
        <div class="container-lg nav-header-container">
            <div class="col-2 mr-auto pl-lg-0">
                <a class="navbar-brand" href="User/index.php">
                    <div style="font-size:35px; text-shadow: #FC0 1px 0 10px;" class="tw-font-bold tw-italic tw-text-black">PriceCom</div>
                </a>
            </div>
            <div class="col-6 mr-auto pl-lg-0">
                <div class="tw-flex tw-my-3 tw-py-2 tw-px-2 tw-rounded-full tw-h-16 tw-bg-gray-200 tw-border-gray-700">
                    <input class="tw-h-12 tw-rounded-full tw-w-full tw-px-5" type="text" name="searchData" placeholder="Search product in PriceCom...">
                    <button class="tw-ml-2 tw-bg-white hover:tw-bg-gray-600 tw-rounded-full tw-w-14 tw-px-1 tw-text-black hover:tw-text-white">
                        <i style="font-size: 25px" class="tw-py-2 fas fa-search"></i>
                    </button>
                </div>
            </div>
            <div class="col-2 menu-order px-lg-0">
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav alt-font">
                        <li class="nav-item dropdown megamenu">
                            <a href="User/index.php" class="nav-link">Home</a>
                        </li>
                        <li class="nav-item dropdown simple-dropdown">
                            <a href="User/profile/profile.php" class="nav-link">Profile</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="dropdown">
                <button class="dropdown-toggle tw-mt-2 tw-pt-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="tw-flex">
                        <img style="height: 50px; width: 75px;" src="<?=(isset($Headeruser['imagwe']))?'./User/profile/'.$Headeruser['image']:'assets/image/profile.png'?>" alt="">
                        <div class="tw-text-left tw--ml-2 tw-pt-1">
                            <div style="font-size: 16px;" class="tw-text-black tw-font-semibold"><?=strtoupper($Headeruser['username'])?></div>
                            <div style="font-size: 14px;" class="tw-text-gray-400 tw-font-semibold tw--mt-1">ID : <?=$Headeruser['id']?></div>
                        </div>
                        <div><i style="font-size: 25px;" class="fas fa-angle-down tw-mt-4 tw-ml-3"></i></div>
                    </div>
                </button>
                <ul class="dropdown-menu tw-px-5" style="width: 15rem; height:7.5rem;" aria-labelledby="dropdownMenuButton1">
                    <li class="tw-px-2 tw-w-full">
                        <a href="User/profile/profile.php" class="tw-no-underline tw-w-full">
                            <div class="tw-px-3 tw-py-3 hover:tw-bg-gray-200 tw-rounded tw-w-full">
                                <span class="tw-font-semibold tw-text-black tw-mr-2" style="font-size: 16px;"><i class="fas fa-user"></i></span>
                                <span class="tw-font-semibold tw-text-black" style="font-size: 16px;">Profile</span>
                            </div>
                        </a>
                    </li>
                    <li class="tw-px-2 tw-w-full">
                        <a href="User/auth/logout.php"  class="tw-no-underline tw-w-full">
                            <div class="tw-px-3 tw-py-3 hover:tw-bg-gray-200 tw-rounded tw-w-full">
                                <span class="tw-font-semibold tw-text-black tw-mr-2" style="font-size: 16px;"><i class="fas fa-sign-out-alt"></i></span>
                                <span class="tw-font-semibold tw-text-black" style="font-size: 16px;">Log Out</span>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navigation -->
</header>