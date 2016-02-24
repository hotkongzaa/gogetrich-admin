<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

$enrollID = (string) filter_input(INPUT_GET, 'enrollId');

$sqlUpdate = "DELETE FROM RICH_CUSTOMER_ENROLL WHERE ENROLL_ID = '" . $enrollID . "'";

if (mysql_query($sqlUpdate)) {
    echo 200;
} else {
    echo mysql_error();
}