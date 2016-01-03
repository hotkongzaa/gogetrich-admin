<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

$sql = "INSERT INTO GTRICH_COURSE_EVENT_DATE_TIME_TMP (EVENT_ID,START_EVENT_DATE_TIME,END_EVENT_DATE_TIME,EVENT_CREATED_DATE_TIME,EVENT_DISTRIBUTOR_ID)"
        . " VALUES"
        . " ('" . md5(date("h:i:sa")) . "','" . $_GET['startDate'] . "','" . $_GET['endDate'] . "',NOW(),'" . $_SESSION['userId'] . "')";
$saveRes = mysql_query($sql);
if ($saveRes) {
    echo 200;
} else {
    echo mysql_error();
}


