<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';
require '../../model/com.gogetrich.function/CredentialValidationService.php';
$serviceCheck = new CredentialValidationService();
$jsonObj = $serviceCheck->getTokenDetail($_SESSION['token']);
$jsonValue = json_decode($jsonObj, true);

$descHeaderId = (string) filter_input(INPUT_POST, 'descHeaderId');
$lat = (string) filter_input(INPUT_POST, 'lat');
$lng = (string) filter_input(INPUT_POST, 'lng');
$courseDetail = (string) filter_input(INPUT_POST, 'courseDetail');
$detailOrder = (string) filter_input(INPUT_POST, 'detailOrder');
$isGallery = (string) filter_input(INPUT_POST, 'refGallery'); //true, false
$courseDetailID = md5(date("h:i:sa"));

$sql = "INSERT INTO GTRICH_COURSE_DETAIL_TMP (DETAIL_ID,DETAIL_DESCRIPTION,DETAIL_LAT,DETAIL_LNG,DETAIL_CREATED_DATE_TIME,REF_COURSE_HEADER_ID,DISTRIBUTOR_ID,DETAIL_ORDER,REF_GALLERY_ID) "
        . "VALUES ('" . $courseDetailID . "','" . $courseDetail . "','" . $lat . "','" . $lng . "',NOW(),'" . $descHeaderId . "','" . $jsonValue['USERID'] . "','" . $detailOrder . "','" . $isGallery . "')";

if ($isGallery == "true") {
    $sqlGetImageGallerFromTmp = "SELECT * FROM GTRICH_GALLERY_IMAGES_UPLOAD_TMP WHERE DISTRIBUTOR_ID ='" . $jsonValue['USERID'] . "'";
    $resGetImageGallerFromTmp = mysql_query($sqlGetImageGallerFromTmp);
    while ($rowGetGallerToTmp = mysql_fetch_array($resGetImageGallerFromTmp)) {
        $sqlSaveGallerToGallery = "INSERT INTO GTRICH_GALLERY_IMAGES_UPLOAD (IMAGE_ID,IMAGE_NAME,IMAGE_UPLOAD_DATE_TIME,REF_COURSE_HEADER_ID,REF_COURSE_ID,REF_COURSE_DESCRIPTION_HEADER_ID) "
                . "VALUES ('" . $rowGetGallerToTmp['IMAGE_ID'] . "','" . $rowGetGallerToTmp['IMAGE_NAME'] . "','" . $rowGetGallerToTmp['IMAGE_UPLOAD_DATE_TIME'] . "','','" . $courseDetailID . "','" . $descHeaderId . "')";
        mysql_query($sqlSaveGallerToGallery);
    }
    $sqlDeleteIntmp = "DELETE FROM GTRICH_GALLERY_IMAGES_UPLOAD_TMP WHERE DISTRIBUTOR_ID ='" . $jsonValue['USERID'] . "'";
    mysql_query($sqlDeleteIntmp);
}

if (mysql_query($sql)) {
    echo 200;
} else {
    echo mysql_error();
}