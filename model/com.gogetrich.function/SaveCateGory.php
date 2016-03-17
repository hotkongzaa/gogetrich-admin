<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../../model-db-connection/config.php';

$type = (string) filter_input(INPUT_GET, 'type');
$cateName = (string) filter_input(INPUT_GET, 'cateName');
$cateId = (string) filter_input(INPUT_GET, 'cateId');
$careateDateTime = (string) filter_input(INPUT_GET, 'careateDateTime');
$saveBlogCate = (string) filter_input(INPUT_GET, 'saveBlogCate');

if ($type == "create") {
    $sqlSave = "INSERT INTO GTRICH_BLOG_CATEGORY(B_CATE_ID,B_CATE_NAME,B_CREATED_DATE) VALUES ('" . uniqid() . "','" . $cateName . "',now())";
    $saveRes = mysql_query($sqlSave);
    if ($saveRes) {
        echo 200;
    } else {
        echo mysql_error();
    }
} else {
    $update = "UPDATE GTRICH_BLOG_CATEGORY "
            . "SET B_CATE_NAME='" . $cateName . "',B_CREATED_DATE='" . $careateDateTime . "'"
            . "WHERE B_CATE_ID = '" . $cateId . "'";
    $updateRes = mysql_query($update);
    if ($updateRes) {
        echo 200;
    } else {
        echo mysql_error();
    }
}


