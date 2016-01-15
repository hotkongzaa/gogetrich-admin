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


$sqlCheckMaxPromotion = "SELECT COUNT(*) AS COUNT_PROMO FROM GTRICH_PROMOTION_TMP WHERE DISTRIBUTOR_ID='" . $jsonValue['USERID'] . "'";
$reSqlCheckMax = mysql_query($sqlCheckMaxPromotion);
$rowCheckMax = mysql_fetch_assoc($reSqlCheckMax);
if ($rowCheckMax['COUNT_PROMO'] >= 5) {
    echo 'Promotion is maximum for this course';
} else {
    $sql = "INSERT INTO GTRICH_PROMOTION_TMP (PRO_ID,PRO_NAME,PRO_CREATED_DATE_TIME,DISTRIBUTOR_ID)"
            . " VALUES"
            . " ('" . md5(date("h:i:sa")) . "','" . $_GET['promotionName'] . "',NOW(),'" . $jsonValue['USERID'] . "')";
    $saveRes = mysql_query($sql);
    if ($saveRes) {
        echo 200;
    } else {
        echo mysql_error();
    }
}


