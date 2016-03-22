<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

session_start();
require '../../model-db-connection/config.php';
require './CredentialValidationService.php';
$serviceCheck = new CredentialValidationService();
$jsonObj = $serviceCheck->getTokenDetail($_SESSION['token']);
$jsonValue = json_decode($jsonObj, true);

$sqlSelectCate = "SELECT * FROM GTRICH_BLOG_IMAGES_UPLOAD WHERE PARTIAL_REG='PARTIAL' AND REF_STAFF_ID ='" . $jsonValue['USERID'] . "' ORDER BY IMAGE_UPLOAD_DATE_TIME DESC";
$res = mysql_query($sqlSelectCate);
echo mysql_num_rows($res);
