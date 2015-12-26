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
$detailOrder = $_POST['detailOrder'] ? $_POST['detailOrder'] : $_GET['detailOrder'];

$sql = "INSERT INTO GTRICH_COURSE_DETAIL_TMP (DETAIL_ID,DETAIL_DESCRIPTION,DETAIL_LAT,DETAIL_LNG,DETAIL_CREATED_DATE_TIME,REF_COURSE_HEADER_ID,DISTRIBUTOR_ID,DETAIL_ORDER) "
        . "VALUES ('" . md5(date("h:i:sa")) . "','" . $courseDetail . "','" . $lat . "','" . $lng . "',NOW(),'" . $descHeaderId . "','" . $_SESSION['userId'] . "','" . $detailOrder . "')";

if (mysql_query($sql)) {
    echo 200;
} else {
    echo mysql_error();
}