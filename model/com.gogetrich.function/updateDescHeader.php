<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

$headerID = $_GET['headerID'] ? $_GET['headerID'] : $_POST['headerID'];
$descHeaderName = $_GET['descHeaderName'] ? $_GET['descHeaderName'] : $_POST['descHeaderName'];

$sqlUpdate = "UPDATE GTRICH_DESCRIPTION_HEADER SET DESC_HEADER_NAME = '" . $descHeaderName . "' WHERE DESC_HEADER_ID = '" . $headerID . "'";

$res = mysql_query($sqlUpdate);
if ($res) {
    echo 200;
} else {
    echo mysql_error();
}
