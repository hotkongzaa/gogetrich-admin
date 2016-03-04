<?php

session_start();
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

mysql_query("DELETE FROM GTRICH_GALLERY_IMAGES_UPLOAD_TMP WHERE DISTRIBUTOR_ID = '" . $jsonValue['USERID'] . "'");

$courseTmpID = (string) filter_input(INPUT_GET, 'courseTmpID');
$sql = "SELECT * FROM GTRICH_COURSE_DETAIL_TMP WHERE DETAIL_ID LIKE '" . $courseTmpID . "'";
$res = mysql_query($sql);
$row = mysql_fetch_assoc($res);
echo json_encode($row);
