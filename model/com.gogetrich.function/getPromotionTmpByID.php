<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

$proID = $_GET['proID'];

$sql = "SELECT * FROM GTRICH_PROMOTION_TMP WHERE PRO_ID LIKE '" . $proID . "'";
$res = mysql_query($sql);
$row = mysql_fetch_assoc($res);
echo json_encode($row);
