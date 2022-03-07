<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "priceCom";
$conn= mysqli_connect($host,$user,$password,$db);

mysqli_query($conn, 'SET NAMES utf8' );
Session_Start();
date_default_timezone_set("Asia/Kuala_Lumpur");

function db_connect()
{
    static $conn;

    if(!isset($conn))
    {
        $host = "localhost";
        $user = "root";
        $password = "";
        $db = "priceCom";
        $conn= mysqli_connect($host,$user,$password,$db);
        mysqli_set_charset($conn, "utf8");
        date_default_timezone_set("Asia/Kuala_Lumpur");
        mysqli_query($conn,"SET time_zone='+08:00'");
    }

    if($conn === false)
    {
        echo mysqli_connect_error();
    }
    return $conn;
}

// mysqli_query($conn,$sql);
function query($sql)
{
    $con = db_connect();
    $run = mysqli_query($con,$sql);
    return $run;
}

// mysqli_fetch_assoc($sql);
function fetch($sql)
{
    $con = db_connect();
    $run = mysqli_fetch_assoc($sql);
    return $run;
}

// mysqli_fetch_all($sql);
function fetchall($query_result, $method = MYSQLI_ASSOC){
    $con = db_connect();
    $run = mysqli_fetch_all($query_result, $method);
    return $run;
}

// mysqli_num_rows($sql);
function row($sql)
{
    $con = db_connect();
    $run = mysqli_num_rows($sql);
    return $run;
}

// trim(mysql_real_escape_string($conn,$sql));
function escape($sql)
{
    return(trim($sql));
}

// mysqli_fetch_array($sql);
function fetcharray($query_result, $method = MYSQLI_ASSOC){
    $con = db_connect();
    $run = mysqli_fetch_array($query_result, $method);
    return $run;
}

// mysqli_insert_id($con)
function lastInsertedId(){
    $con = db_connect();
    $lastId = mysqli_insert_id($con);
    return $lastId;
}
?>