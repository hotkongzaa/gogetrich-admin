<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';
$descHeaderId = $_POST['descHeaderId'];
$lat = $_POST['lat'];
$lng = $_POST['lng'];
$courseDetail = $_POST['courseDetail'];
$tempDetailID = $_POST['tempDetailID'];

$sqlUpdate = "UPDATE GTRICH_COURSE_DETAIL_TMP "
        . "SET DETAIL_DESCRIPTION = '" . $courseDetail . "',DETAIL_LAT='" . $lat . "',DETAIL_LNG='" . $lng . "',REF_COURSE_HEADER_ID='" . $descHeaderId . "',DISTRIBUTOR_ID='" . $_SESSION['userId'] . "' "
        . "WHERE DETAIL_ID = '" . $tempDetailID . "'";

if (mysql_query($sqlUpdate)) {
    echo 200;
} else {
    echo mysql_error();
}