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
$courseHeaderId = (string) filter_input(INPUT_GET, 'cHeaderId');
$filename = uniqid() . $_FILES["productImage"]["name"];
if (move_uploaded_file($_FILES["productImage"]["tmp_name"], "../../view/assets/uploads/images/" . $filename)) {
    echo $filename;
    $sqlInsertToTmp = "INSERT INTO GTRICH_GALLERY_IMAGES_UPLOAD_TMP (IMAGE_ID,IMAGE_NAME,IMAGE_UPLOAD_DATE_TIME,REF_COURSE_HEADER_ID,DISTRIBUTOR_ID) "
            . "VALUES ('" . uniqid() . "','" . $filename . "',now(),'" . $courseHeaderId . "','" . $jsonValue['USERID'] . "')";
    $res = mysql_query($sqlInsertToTmp);
    if ($res) {
        echo 200;
    } else {
        echo $res;
    }
} else {
    echo 505;
}