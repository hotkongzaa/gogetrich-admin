<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';
$headerID = $_GET['headerID'];

$sqlClearAllTempByUserSession = "DELETE FROM GTRICH_COURSE_DETAIL_TMP WHERE DISTRIBUTOR_ID = '" . $_SESSION['userId'] . "'";
$sqlClearAllPromotionTmpByUserSession = "DELETE FROM GTRICH_PROMOTION_TMP WHERE DISTRIBUTOR_ID='" . $_SESSION['userId'] . "'";
if (mysql_query($sqlClearAllTempByUserSession) && mysql_query($sqlClearAllPromotionTmpByUserSession)) {
    //Manage course detail
    $sqlGetDataInsertTotmp = "SELECT * FROM GTRICH_COURSE_DETAIL WHERE REF_COURSE_HEADER_ID = '" . $headerID . "'";
    $res = mysql_query($sqlGetDataInsertTotmp);
    while ($rowToTmp = mysql_fetch_array($res)) {
        $sqlSaveToTmp = "INSERT INTO GTRICH_COURSE_DETAIL_TMP (DETAIL_ID,DETAIL_DESCRIPTION,DETAIL_LAT,DETAIL_LNG,DETAIL_CREATED_DATE_TIME,REF_COURSE_HEADER_ID,DISTRIBUTOR_ID,DETAIL_ORDER) "
                . "VALUES ('" . $rowToTmp['DETAIL_ID'] . "','" . $rowToTmp['DETAIL_DESCRIPTION'] . "','" . $rowToTmp['DETAIL_LAT'] . "','" . $rowToTmp['DETAIL_LNG'] . "','" . $rowToTmp['DETAIL_CREATED_DATE_TIME'] . "','" . $rowToTmp['DESC_HEADER_ID'] . "','" . $_SESSION['userId'] . "','" . $rowToTmp['DETAIL_ORDER'] . "')";
        mysql_query($sqlSaveToTmp);
    }

    //Manage promotion detail
    $sqlGetPromotionToTmp = "SELECT * FROM GTRICH_COURSE_PROMOTION WHERE REF_COURSE_HEADER_ID='" . $headerID . "'";
    $resGetPrmotionToTmp = mysql_query($sqlGetPromotionToTmp);
    while ($rowPromotionToTmp = mysql_fetch_array($resGetPrmotionToTmp)) {
        $sqlSavePromToTmp = "INSERT INTO GTRICH_PROMOTION_TMP (PRO_ID,PRO_NAME,PRO_CREATED_DATE_TIME,DISTRIBUTOR_ID) "
                . "VALUES ('" . $rowPromotionToTmp['PRO_ID'] . "','" . $rowPromotionToTmp['PRO_NAME'] . "','" . $rowPromotionToTmp['PRO_CREATED_DATE_TIME'] . "','" . $_SESSION['userId'] . "')";
        mysql_query($sqlSavePromToTmp);
    }
    echo 200;
} else {
    echo mysql_error();
}


