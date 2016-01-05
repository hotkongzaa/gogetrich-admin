<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

$sql = "SELECT * FROM GTRICH_COURSE_EVENT_DATE_TIME_TMP WHERE EVENT_ID LIKE '" . $_GET['eID'] . "'";
$res = mysql_query($sql);
$row = mysql_fetch_assoc($res);
echo json_encode($row);
