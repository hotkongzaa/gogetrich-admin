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
$tempDetailID = (string) filter_input(INPUT_POST, 'tempDetailID');
$detailOrder = (string) filter_input(INPUT_POST, 'detailOrder');
$dateTimeTem = (string) filter_input(INPUT_POST, 'dateTimeTem');

$refGallery = (boolean) filter_input(INPUT_POST, 'refGallery');

$sqlUpdate = "UPDATE GTRICH_COURSE_DETAIL_TMP "
        . "SET DETAIL_CREATED_DATE_TIME='" . $dateTimeTem . "',DETAIL_ORDER='" . $detailOrder . "',DETAIL_DESCRIPTION = '" . $courseDetail . "',DETAIL_LAT='" . $lat . "',DETAIL_LNG='" . $lng . "',REF_COURSE_HEADER_ID='" . $descHeaderId . "',DISTRIBUTOR_ID='" . $jsonValue['USERID'] . "' "
        . "WHERE DETAIL_ID = '" . $tempDetailID . "'";

if ($refGallery == true) {
    mysql_query("DELETE FROM GTRICH_GALLERY_IMAGES_UPLOAD WHERE REF_COURSE_ID = '" . $tempDetailID . "'");

    $sqlGetFromTmp = "SELECT * FROM GTRICH_GALLERY_IMAGES_UPLOAD_TMP WHERE DISTRIBUTOR_ID = '" . $jsonValue['USERID'] . "'";
    $resGetFromTmp = mysql_query($sqlGetFromTmp);
    while ($rowGetFromTmp = mysql_fetch_array($resGetFromTmp)) {
        $sqlSaveGallerToGallery = "INSERT INTO GTRICH_GALLERY_IMAGES_UPLOAD (IMAGE_ID,IMAGE_NAME,IMAGE_UPLOAD_DATE_TIME,REF_COURSE_HEADER_ID,REF_COURSE_ID) "
                . "VALUES ('" . $rowGetFromTmp['IMAGE_ID'] . "','" . $rowGetFromTmp['IMAGE_NAME'] . "','" . $rowGetFromTmp['IMAGE_UPLOAD_DATE_TIME'] . "','','" . $tempDetailID . "')";
        mysql_query($sqlSaveGallerToGallery);
    }
    $sqlDeleteIntmp = "DELETE FROM GTRICH_GALLERY_IMAGES_UPLOAD_TMP WHERE DISTRIBUTOR_ID ='" . $jsonValue['USERID'] . "'";
    mysql_query($sqlDeleteIntmp);
}

if (mysql_query($sqlUpdate)) {
    echo 200;
} else {
    echo mysql_error();
}