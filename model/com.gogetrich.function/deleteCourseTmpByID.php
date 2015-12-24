<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

$sql = "DELETE FROM GTRICH_COURSE_DETAIL_TMP WHERE DETAIL_ID = '" . $_GET['tmpCourseID'] . "'";

if (mysql_query($sql)) {
    echo 200;
} else {
    echo mysql_error();
}