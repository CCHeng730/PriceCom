<?php
ob_start();
include_once("../../connection.php");

$readid = $_GET['id'];
$authid = $_GET['auth'];
$checkid = md5($readid).sha1($readid);

if(!isset($_SESSION['aid'])) { //check if logged in
    ?><script>window.location.href="../auth/login.php"</script><?php
}

if($_SESSION['super'] != '1'){ // not is SUPER ADMIN
    ?><script>window.location.href="index.php"</script><?php
}else{
    //query delete record
    $currentDate = date('Y-m-d H:i:s');
    query("update admin set deleted_at = '$currentDate' where id = '$readid'");
}



?>
<script>history.back()</script>
