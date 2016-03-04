<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require '../../model-db-connection/config.php';
require '../../model/com.gogetrich.function/CredentialValidationService.php';
$serviceCheck = new CredentialValidationService();
$jsonObj = $serviceCheck->getTokenDetail($_SESSION['token']);
$jsonValue = json_decode($jsonObj, true);
$detailId = (string) filter_input(INPUT_GET, 'detailId');

mysql_query("DELETE FROM GTRICH_GALLERY_IMAGES_UPLOAD_TMP WHERE DISTRIBUTOR_ID = '" . $jsonValue['USERID'] . "'");

$sqlGet = "SELECT * FROM GTRICH_GALLERY_IMAGES_UPLOAD WHERE REF_COURSE_ID ='" . $detailId . "'";
$resGet = mysql_query($sqlGet);
while ($row = mysql_fetch_array($resGet)) {
    $sqlInToTmp = "INSERT INTO GTRICH_GALLERY_IMAGES_UPLOAD_TMP (IMAGE_ID,IMAGE_NAME,IMAGE_UPLOAD_DATE_TIME,REF_COURSE_HEADER_ID,DISTRIBUTOR_ID) "
            . "VALUES ('" . $row['IMAGE_ID'] . "','" . $row['IMAGE_NAME'] . "','" . $row['IMAGE_UPLOAD_DATE_TIME'] . "','" . $row['REF_COURSE_HEADER_ID'] . "','" . $jsonValue['USERID'] . "')";
    mysql_query($sqlInToTmp);
}