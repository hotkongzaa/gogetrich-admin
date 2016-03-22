<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

$enrollID = (string) filter_input(INPUT_GET, 'enrollId');
$status = (string) filter_input(INPUT_GET, 'status');

$sqlUpdate = "UPDATE RICH_CUSTOMER_ENROLL "
        . "SET ENROLL_STATUS='" . $status . "' "
        . "WHERE ENROLL_ID = '" . $enrollID . "'";

if (mysql_query($sqlUpdate)) {
    echo 200;
} else {
    echo mysql_error();
}