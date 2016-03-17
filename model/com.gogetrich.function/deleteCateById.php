<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../../model-db-connection/config.php';

$cateId = (string) filter_input(INPUT_GET, 'cateId');
$del = "DELETE FROM GTRICH_BLOG_CATEGORY WHERE B_CATE_ID = '" . $cateId . "'";
$res = mysql_query($del);
if ($res) {
    echo 200;
} else {
    echo mysql_error();
}


