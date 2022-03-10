<?php
ob_start();
include_once("../../connection.php");
include ("../../uploadfile.php");

//check if logged in
if(!isset($_SESSION['uid'])) {
    ?><script>window.location.href="../auth/login.php"</script><?php
}

if(isset($_POST['submit'])){
    $userFetch = fetch(query("select * from user where id = '$_SESSION[uid]'"));

    $currentpassword = $_POST['Cpassword'];
    $newpassword = $_POST['Npassword'];
    $confirm = $_POST['confirm_password'];

    //current password hashing
    $cHashpass = "$1".md5(md5($userFetch['email'])).sha1(sha1($currentpassword));

    if($cHashpass != $userFetch['password']){
        $perror = "*Current password incorrect!";
    }

    if($newpassword != $confirm){
        $perror = "*Password not match!";
    }

    if(!isset($perror)){
        $nHashpass = "$1".md5(md5($userFetch['email'])).sha1(sha1($newpassword));



        query("update user set password = '$nHashpass' where id='$_SESSION[uid]'");

        ?><script>window.location.href="profile.php"</script><?php
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <base href="../../">
        <meta charset="utf-8" />
        <title>PriceCom</title>
        <link href="assets/app.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="assets/user/css/font-icons.min.css">
        <link rel="stylesheet" type="text/css" href="assets/user/css/theme-vendors.min.css">
        <link rel="stylesheet" type="text/css" href="assets/user/css/style.css" />
        <link rel="stylesheet" type="text/css" href="assets/user/css/responsive.css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    </head>
    <body>
        <div class="tw-bg-gray-50">
            <?php include "../layout/header.php" ?>
            <?php include "../profile/profile_header.php" ?>
            <div class="container tw-my-32">
                <div class="row">
                    <div class="col-3">
                        <div class="tw-mx-2 tw-py-5 tw-px-3 tw-rounded-lg tw-bg-white tw-shadow-lg">
                            <div class="tw-w-4/5 tw-mx-auto tw-my-1">
                                <a href="User/profile/profile.php" class=" tw-no-underline">
                                    <div class="tw-pl-4 tw-font-medium tw-py-2 tw-rounded-lg tw-uppercase tw-bg-black tw-text-white" style="font-size: 16px">
                                        <i style="width: 10%;" class="fas fa-user"></i> 
                                        <span style="width: 90%;">My Account</span>
                                    </div>
                                </a>
                                <div class="collapse in show">
                                    <div class="card-body">
                                        <div class="tw-w-full tw-mb-1" style="margin-left: 10%;">
                                            <a href="User/profile/profile.php" class=" tw-no-underline">
                                                <div class="tw-pl-3 tw-font-medium tw-pb-1 tw-uppercase tw-text-gray-400 hover:tw-text-black" style="font-size: 14px">
                                                    <span>Profile</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="tw-w-full tw-mb-1" style="margin-left: 10%;">
                                            <a href="User/profile/edit_profile.php" class=" tw-no-underline">
                                                <div class="tw-pl-3 tw-font-medium tw-pb-1 tw-uppercase tw-text-gray-400 hover:tw-text-black" style="font-size: 14px">
                                                    <span>Edit Profile</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="tw-w-full tw-mb-1" style="margin-left: 10%;">
                                            <a href="#" class=" tw-no-underline">
                                                <div class="tw-pl-3 tw-font-medium tw-pb-1 tw-uppercase tw-text-black" style="font-size: 14px">
                                                    <span>Change Password</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="User/profile/purchase_history.php" class="tw-no-underline">
                                    <div class="tw-pl-4 tw-font-medium tw-py-2 tw-mb-3 tw-rounded-lg tw-uppercase hover:tw-bg-gray-500 tw-text-gray-400 hover:tw-text-white" style="font-size: 16px">
                                        <i style="width: 10%;" class="fas fa-shopping-basket"></i>
                                        <span style="width: 90%;">Purchase History</span>
                                    </div>
                                </a>
                                <a href="User/auth/logout.php" class="tw-no-underline">
                                    <div class="tw-pl-4 tw-font-medium tw-py-2 tw-rounded-lg tw-uppercase hover:tw-bg-gray-500 tw-text-gray-400 hover:tw-text-white" style="font-size: 16px">
                                        <i style="width: 10%;" class="fas fa-sign-out-alt"></i> 
                                        <span style="width: 90%;">LogOut</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-9">
                        <div class="tw-mx-2 tw-pb-10 tw-px-8 tw-rounded tw-bg-white tw-shadow-lg">
                            <div class="tw-px-10 tw-mb-7 tw-pt-8 tw-pb-5" style="border-bottom: 2px solid #E8E8E8;">
                                <div style="font-size: 25px;" class="tw-font-semibold tw-text-black">My Password</div>
                                <div style="font-size: 15px;" class="tw-text-gray-500 tw-font-normal">To keep your account safe, do not share your password with others.</div>
                            </div>
                            <div class="row">
                                <form method="post">
                                <div class="col-1"></div>
                                <div class="col-8">
                                    <div class="d-flex tw-mb-7">
                                        <div style="width: 35%; font-size: 16px;" class="tw-font-medium tw-py-3 tw-text-right tw-text-gray-400">Current Password :</div>
                                        <div style="width: 65%;" class="tw-flex">
                                            <input class="tw-rounded-lg tw-mx-5" style="border: 2px solid #E8E8E8;" type="password" placeholder="Current Password" name="Cpassword">
                                        </div>
                                    </div>
                                    <div class="d-flex tw-mb-7">
                                        <div style="width: 35%; font-size: 16px;" class="tw-font-medium tw-py-3 tw-text-right tw-text-gray-400">New Password :</div>
                                        <div style="width: 65%;" class="tw-flex">
                                            <input class="tw-rounded-lg tw-mx-5" style="border: 2px solid #E8E8E8;" type="password" placeholder="New Password" name="Npassword">
                                        </div>
                                    </div>
                                    <div class="d-flex tw-mb-7">
                                        <div style="width: 35%; font-size: 16px;" class="tw-font-medium tw-py-3 tw-text-right tw-text-gray-400">Confirm New Password :</div>
                                        <div style="width: 65%;" class="tw-flex">
                                            <input class="tw-rounded-lg tw-mx-5" style="border: 2px solid #E8E8E8;" type="password" placeholder="Confirm New Password" name="confirm_password">
                                        </div>
                                    </div>
                                    <button type="submit"  class="tw-font-semibold tw-rounded tw-px-6 tw-py-3 tw-text-white tw-bg-gray-700 hover:tw-text-white tw-bg-gradient-to-b hover:tw-from-black hover:tw-to-gray-500 tw-no-underline" style="margin-left:28%;" name="submit">Change Password</button>
                                </div>
                                <div class="col-3"></div>
                                </form>
                                <span class="error text-danger text-center"><?= (isset($perror)) ? $perror : "" ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "../layout/footer.php" ?>
    </body>
    <script type="text/javascript" src="assets/user/js/theme-vendors.min.js"></script>
    <script type="text/javascript" src="assets/user/js/jquery.min.js"></script>
    <script type="text/javascript" src="assets/user/js/main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>