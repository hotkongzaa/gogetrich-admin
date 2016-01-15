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


$sqlDeleteCourseDetailTmp = "DELETE FROM GTRICH_COURSE_DETAIL_TMP WHERE DISTRIBUTOR_ID='" . $jsonValue['USERID'] . "'";
$sqlDeletePromotionTmp = "DELETE FROM GTRICH_PROMOTION_TMP WHERE DISTRIBUTOR_ID='" . $jsonValue['USERID'] . "'";
$sqlDeleteEventDate = "DELETE FROM GTRICH_COURSE_EVENT_DATE_TIME_TMP WHERE EVENT_DISTRIBUTOR_ID='" . $jsonValue['USERID'] . "'";

if (mysql_query($sqlDeleteCourseDetailTmp) && mysql_query($sqlDeletePromotionTmp) && mysql_query($sqlDeleteEventDate)) {
    echo 200;
} else {
    echo mysql_error();
}