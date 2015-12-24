<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

$refCourseHeaderID = $_GET['headerID'];
$sqlDeleteDetail = "DELETE FROM GTRICH_COURSE_DETAIL WHERE REF_COURSE_HEADER_ID = '" . $refCourseHeaderID . "'";
$resDelDetail = mysql_query($sqlDeleteDetail);
if ($resDelDetail) {
    $sql = "DELETE FROM GTRICH_COURSE_HEADER WHERE HEADER_ID = '" . $refCourseHeaderID . "'";
    if (mysql_query($sql)) {
        echo 200;
    } else {
        echo mysql_error();
    }
} else {
    echo mysql_error();
}
