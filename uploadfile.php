<?php
ob_start();
include_once("../../connection.php");

function uploadFile($photo, $filedir = "picture/" )
{
    $status = 0;
    $response = '';

    //photo file upload
    $img_name   = $photo['name'];
    $encode_imgName = rand(1000000,9999999);

    $file_type = '.' . substr($img_name, strrpos($img_name, '.') + 1);
    $target_file = $filedir . basename($photo['name']);

    // Select file type
    $imageFileType = strtolower(pathinfo($img_name, PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("jpg", "jpeg", "png");

    if ($img_name != null) {//file exist
        if (!is_dir($filedir)) { //create dir if not created
            mkdir($filedir);
        }
        if (in_array($imageFileType, $extensions_arr)) { //if in accepted file format
            if ($photo["size"] < 5000000) { //if within max file size
                if (move_uploaded_file($photo['tmp_name'], $filedir . $encode_imgName . $file_type)) { //upload file function success
                    //full file path
                    $filename = $filedir . $encode_imgName . $file_type;
                    $response = $filename;
                    $status = 1;

                } else { //upload file failed
                    $response = "*Unexpected error!";
                }
            } else {  //exceed max file size
                $response = "*This image is too large!";
            }
        } else {
            $response = "*Please upload jpg, jpeg and png only!";
        }
    }

    return array($response,$status);

}