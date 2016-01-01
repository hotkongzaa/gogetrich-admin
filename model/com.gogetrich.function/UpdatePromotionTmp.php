<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

$sql = "UPDATE GTRICH_PROMOTION_TMP "
        . "SET PRO_NAME = '" . $_GET['proName'] . "',"
        . "PRO_CREATED_DATE_TIME='" . $_GET['proDate'] . "' "
        . "WHERE PRO_ID = '" . $_GET['proID'] . "'";

$saveRes = mysql_query($sql);
if ($saveRes) {
    echo 200;
} else {
    echo mysql_error();
}



