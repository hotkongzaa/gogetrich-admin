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
if (mysql_query($sqlClearAllTempByUserSession)) {
    //Manage course detail
    $sqlGetDataInsertTotmp = "SELECT * FROM GTRICH_COURSE_DETAIL WHERE REF_COURSE_HEADER_ID = '" . $headerID . "'";
    $res = mysql_query($sqlGetDataInsertTotmp);
    while ($rowToTmp = mysql_fetch_array($res)) {
        $sqlSaveToTmp = "INSERT INTO GTRICH_COURSE_DETAIL_TMP (DETAIL_ID,DETAIL_DESCRIPTION,DETAIL_LAT,DETAIL_LNG,DETAIL_CREATED_DATE_TIME,REF_COURSE_HEADER_ID,DISTRIBUTOR_ID) "
                . "VALUES ('" . $rowToTmp['DETAIL_ID'] . "','" . $rowToTmp['DETAIL_DESCRIPTION'] . "','" . $rowToTmp['DETAIL_LAT'] . "','" . $rowToTmp['DETAIL_LNG'] . "','" . $rowToTmp['DETAIL_CREATED_DATE_TIME'] . "','" . $rowToTmp['DESC_HEADER_ID'] . "','" . $_SESSION['userId'] . "')";
        mysql_query($sqlSaveToTmp);
    }
    echo 200;
} else {
    echo mysql_error();
}


