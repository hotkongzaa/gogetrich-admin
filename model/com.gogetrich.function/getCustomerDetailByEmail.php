<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../../model-db-connection/config.php';

$cusEmail = (string) filter_input(INPUT_POST, 'email');

$sql = "SELECT * FROM RICH_CUSTOMER WHERE CUS_EMAIL = '" . $cusEmail . "'";
$res = mysql_query($sql);
if ($res) {
    if (mysql_num_rows($res) == 1) {
        $data = mysql_fetch_assoc($res);
        echo json_encode($data);
    } else {
        echo 505;
    }
} else {
    echo mysql_error();
}