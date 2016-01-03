<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';
$sql = "DELETE FROM GTRICH_COURSE_EVENT_DATE_TIME_TMP WHERE EVENT_ID='" . $_GET['eID'] . "'";
$saveRes = mysql_query($sql);
if ($saveRes) {
    echo 200;
} else {
    echo mysql_error();
}
