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

if ($row['CHE'] > 0) {
    echo 200;
} else {
    echo "Please add course detail before submit course";
}