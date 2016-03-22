<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require '../../model-db-connection/config.php';
require '../../model/com.gogetrich.function/CredentialValidationService.php';
$serviceCheck = new CredentialValidationService();
$jsonObj = $serviceCheck->getTokenDetail($_SESSION['token']);
$jsonValue = json_decode($jsonObj, true);

$imageId = (string) filter_input(INPUT_GET, 'imageId');
$imageName = (string) filter_input(INPUT_GET, 'imageName');

$imagePath = "../../view/assets/uploads/images/" . $imageName;

//Delete image from directory
if (file_exists($imagePath)) {
    unlink($imagePath);
}
//Delete record from database
mysql_query("DELETE FROM GTRICH_BLOG_IMAGES_UPLOAD WHERE IMAGE_ID='" . $imageId . "' AND REF_STAFF_ID = '" . $jsonValue['USERID'] . "'");

