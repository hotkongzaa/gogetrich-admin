<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

$sql = "SELECT COUNT(*) AS CHE FROM GTRICH_COURSE_DETAIL_TMP WHERE DISTRIBUTOR_ID = '" . $_SESSION['userId'] . "'";
$res = mysql_query($sql);
$row = mysql_fetch_assoc($res);

$sqlCheckSchedule = "SELECT COUNT(*) AS counts FROM GTRICH_COURSE_EVENT_DATE_TIME_TMP WHERE EVENT_DISTRIBUTOR_ID = '" . $_SESSION['userId'] . "'";
$resCheckScehdule = mysql_query($sqlCheckSchedule);
$rowCheckSchedule = mysql_fetch_assoc($resCheckScehdule);
if ($row['CHE'] <= 0) {
    echo 111;
//    echo "Please add course detail before submit course";
} else if ($rowCheckSchedule['counts'] <= 0) {
    echo 100;
//    echo "Please add Course Event Date before submit course";
} else {
    echo 200;
}
