<?php
ob_start();
include_once("../../connection.php");
include ("../../uploadfile.php");

//check if logged in
if(!isset($_SESSION['uid'])) {
    ?><script>window.location.href="../auth/login.php"</script><?php
}

if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $phone_no = $_POST['phone_no'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];


    $emailUnique = row(query("select * from user where email = '$email' and id != '$_SESSION[uid]'"));
    $phoneUnique = row(query("select * from user where phone_no = '$phone_no' and id != '$_SESSION[uid]'"));

    //username validation
    if ($username == "") {
        $uerror = "*This field is required";
    }
    //phone no validation
    if ($phone_no == "") {
        $perror = "*This field is required";
    } elseif ($phoneUnique > 0) {
        $perror = "*This phone number has already been taken!";
    }
    //email validation
    if ($email == "") {
        $eerror = "*This field is required";
    } elseif ($emailUnique > 0) {
        $eerror = "*This email address has already been taken!";
    }
    //gender validation
    if ($gender == null) {
        $gerror = "*This field is required";
    }

    //if all clear
    if (!isset($uerror) && !isset($eerror) && !isset($confirmError) && !isset($gerror)) {
        if ($_FILES['photo']['name'] != '') {
            $imageResponse = uploadFile($_FILES['photo']);
        }

        if ($imageResponse != null) { //upload file
            if ($imageResponse[1] != 0) { //success upload file
                //update record
                query("update user set username='$username', phone_no='$phone_no', email='$email',gender='$gender',image='$imageResponse[0]'
                                where id='$_SESSION[uid]'");

                //redirect back
                ?><script>window.location.href = "profile.php"</script><?php
            } else {
                //return error message
                $ierror = $imageResponse[0];
            }
        }else{
            //update record without image
            query("update user set username='$username', phone_no='$phone_no', email='$email',gender='$gender'
                                where id='$_SESSION[uid]'");

            //redirect back
            ?><script>window.location.href = "profile.php"</script><?php
        }
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
                                                <div class="tw-pl-3 tw-font-medium tw-pb-1 tw-uppercase tw-text-black" style="font-size: 14px">
                                                    <span>Edit Profile</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="tw-w-full tw-mb-1" style="margin-left: 10%;">
                                            <a href="User/profile/change_password.php" class=" tw-no-underline">
                                                <div class="tw-pl-3 tw-font-medium tw-pb-1 tw-uppercase tw-text-gray-400 hover:tw-text-black" style="font-size: 14px">
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
                                <div style="font-size: 25px;" class="tw-font-semibold tw-text-black">Edit Profile Information</div>
                                <div style="font-size: 15px;" class="tw-text-gray-500 tw-font-normal">Manage your personal data and secure your account.</div>
                            </div>
                            <form method="post" enctype="multipart/form-data">

                            <div class="row">
                                <div class="col-4">
                                    <div class="tw-h-full tw-py-24" style="border-right: 2px solid #E8E8E8;">
                                        <img src="<?=(isset($Headeruser['image']))?'./User/profile/'.$Headeruser['image']:'assets/image/default-profile.png'?>" class="tw-rounded-lg tw-mx-auto" style="width:150px; height:150px;" alt="">
                                        <div class="tw-mt-2 tw-text-center">Profile Image</div>
                                        <input type="file" name="photo" class="tw-rounded-lg border-0 tw-mx-5">
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="d-flex tw-mb-7">
                                        <div style="width: 25%; font-size: 16px;" class="tw-font-medium tw-py-3 tw-text-right tw-text-gray-400">Name :</div>
                                        <div style="width: 75%;" class="tw-flex">
                                            <input class="tw-rounded-lg tw-mx-5" style="border: 2px solid #E8E8E8;" type="text" name="username" value="<?= (isset($_POST['username']))?$_POST['username'] :$Headeruser['username']?>" required>
                                        </div>
                                    </div>
                                    <span class="error text-danger text-right"><?= (isset($uerror)) ? $uerror : "" ?></span>

                                    <div class="d-flex tw-mb-7">
                                        <div style="width: 25%; font-size: 16px;" class="tw-font-medium tw-py-3 tw-text-right tw-text-gray-400">Phone Number :</div>
                                        <div style="width: 75%;" class="tw-flex">
                                            <input class="tw-rounded-lg tw-mx-5" style="border: 2px solid #E8E8E8;" type="number" name="phone_no" value="<?= (isset($_POST['phone_no']))?$_POST['phone_no'] :$Headeruser['phone_no']?>" required>
                                        </div>
                                    </div>
                                    <span class="error text-danger text-right"><?= (isset($perror)) ? $perror : "" ?></span>

                                    <div class="d-flex tw-mb-7">
                                        <div style="width: 25%; font-size: 16px;" class="tw-font-medium tw-py-3 tw-text-right tw-text-gray-400">Email :</div>
                                        <div style="width: 75%;" class="tw-flex">
                                            <input class="tw-rounded-lg tw-mx-5" style="border: 2px solid #E8E8E8;" type="email" name="email" value="<?= (isset($_POST['email']))?$_POST['email'] :$Headeruser['email']?>" required>
                                        </div>
                                    </div>
                                    <span class="error text-danger text-right"><?= (isset($eerror)) ? $eerror : "" ?></span>

                                    <div class="d-flex tw-mb-7">
                                        <div style="width: 25%; font-size: 16px;" class="tw-font-medium tw-py-3 tw-text-right tw-text-gray-400">Gender :</div>
                                        <div style="width: 75%;" class="tw-flex">
                                            <select name="gender" class="tw-rounded-lg tw-mx-5" style="border: 2px solid #E8E8E8;">
                                                <option value="null"> -- Choose Your Gender -- </option>
                                                <option value="0" <?= ($_POST['gender']?? null == 0)?'selected': (($Headeruser['gender'] == 0)?'selected':'')?> >Male</option>
                                                <option value="1" <?= ($_POST['gender']?? null == 0)?'selected': (($Headeruser['gender'] == 0)?'selected':'')?> >Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <span class="error text-danger text-right"><?= (isset($gerror)) ? $gerror : "" ?></span>

                                    <div>
                                        <button type="submit"  class="tw-font-semibold tw-rounded tw-px-6 tw-py-3 tw-text-white tw-bg-gray-700 hover:tw-text-white tw-bg-gradient-to-b hover:tw-from-black hover:tw-to-gray-500 tw-no-underline" style="margin-left:28%;" name="submit">Edit Profile</button>
                                        <a href="User/profile/profile.php" class="tw-ml-3 tw-font-medium tw-rounded-lg tw-px-6 tw-py-3 tw-text-white tw-bg-gray-400 hover:tw-bg-gray-300 hover:tw-text-black tw-no-underline">Back</a>
                                    </div>
                                </div>
                            </div>
                            </form>
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