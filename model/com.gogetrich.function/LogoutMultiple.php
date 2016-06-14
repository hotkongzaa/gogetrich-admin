<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

$userId = $_SESSION['userIdForMultilple'];

$sqlUpdate = "UPDATE RICH_SECURITY_TOKEN SET STATUS=0 WHERE USERID='" . $userId . "'";
$res = mysql_query($sqlUpdate);
if ($res) {
    header("Location: ../../view/login");
    unset($_SESSION['userIdForMultilple']);
}