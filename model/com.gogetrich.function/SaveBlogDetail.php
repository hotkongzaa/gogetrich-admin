<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require '../../model-db-connection/config.php';
require './CredentialValidationService.php';
$serviceCheck = new CredentialValidationService();
$jsonObj = $serviceCheck->getTokenDetail($_SESSION['token']);
$jsonValue = json_decode($jsonObj, true);

$blogId = uniqid();
$blogCate = (string) filter_input(INPUT_GET, 'blogCate');
$blogTitle = (String) filter_input(INPUT_GET, 'blogTitle');
$blogAllowComment = (string) filter_input(INPUT_GET, 'blogAllogComment');
$blogStatus = (string) filter_input(INPUT_GET, 'blogPublish');
$blogDetail = (string) filter_input(INPUT_POST, 'blogDetail');

$isPublish = false;
if ($blogStatus == "Publish") {
    $isPublish = true;
} else {
    $isPublish = false;
}
$publishDate = $isPublish == true ? "now()" : "NULL";

//Save blogContent 
$sqlSaveBlog = "INSERT INTO GTRICH_BLOG_DETAIL"
        . "(BLOG_ID,BLOG_TITLE,BLOG_DETAIL,ALLOW_COMMENT,BLOG_POST_DATE,BLOG_CATE_ID,BLOG_SPECIAL,BLOG_PUBLISH,BLOG_PUBLISH_DATE) "
        . "VALUES "
        . "('" . $blogId . "','" . $blogTitle . "','" . $blogDetail . "','" . $blogAllowComment . "',now(),'" . $blogCate . "',NULL,'" . $blogStatus . "'," . $publishDate . ")";
$resSaveContent = mysql_query($sqlSaveBlog);
if ($resSaveContent) {
    //Start update blog image in table
    $sqlUpdateBlogImage = "UPDATE GTRICH_BLOG_IMAGES_UPLOAD "
            . "SET REF_BLOG_ID = '" . $blogId . "', PARTIAL_REG='FULL' "
            . "WHERE REF_STAFF_ID ='" . $jsonValue['USERID'] . "' AND PARTIAL_REG='PARTIAL'";
    $resUpdate = mysql_query($sqlUpdateBlogImage);
    if ($resUpdate) {
        echo 200;
    } else {
        echo mysql_error();
    }
} else {
    echo mysql_error();
}