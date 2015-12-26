<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

$headerID = $_GET['headerID'] ? $_GET['headerID'] : $_POST['headerID'];

$sql = "DELETE FROM GTRICH_DESCRIPTION_HEADER WHERE DESC_HEADER_ID LIKE '" . $headerID . "'";
$res = mysql_query($sql);
if ($res) {
    echo 200;
} else {
    echo mysql_error();
}

