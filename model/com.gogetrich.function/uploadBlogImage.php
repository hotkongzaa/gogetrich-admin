<?php

session_start();
require '../../model-db-connection/config.php';
require '../../model/com.gogetrich.function/CredentialValidationService.php';
$serviceCheck = new CredentialValidationService();
$jsonObj = $serviceCheck->getTokenDetail($_SESSION['token']);
$jsonValue = json_decode($jsonObj, true);
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$imageType = (string) filter_input(INPUT_GET, 'imageType');
$filename = uniqid() . $_FILES["blogImage"]["name"];
if (move_uploaded_file($_FILES["blogImage"]["tmp_name"], "../../view/assets/uploads/images/" . $filename)) {
    echo $filename;
    $sqlInsertToTmp = "INSERT INTO GTRICH_BLOG_IMAGES_UPLOAD (IMAGE_ID,IMAGE_NAME,IMAGE_UPLOAD_DATE_TIME,REF_BLOG_ID,REF_STAFF_ID,PARTIAL_REG,IMAGE_TYPE) "
            . "VALUES ('" . uniqid() . "','" . $filename . "',now(),NULL,'" . $jsonValue['USERID'] . "','PARTIAL','" . $imageType . "')";
    $res = mysql_query($sqlInsertToTmp);
    if ($res) {
        echo 200;
    } else {
        echo $res;
    }
} else {
    echo 505;
}