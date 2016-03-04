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

$imageId = (string) filter_input(INPUT_GET, 'imgId');
$imgName = (string) filter_input(INPUT_GET, 'imgName');

$out_dir = "../../view/assets/uploads/images/";

$sqlDeleteImage = "DELETE FROM GTRICH_GALLERY_IMAGES_UPLOAD_TMP WHERE IMAGE_ID = '" . $imageId . "' AND DISTRIBUTOR_ID = '" . $jsonValue['USERID'] . "'";
$res = mysql_query($sqlDeleteImage);
if ($res) {
    $fileName = $out_dir . $imgName;
    if (file_exists($fileName)) {
        unlink($fileName);
    }
} else {
    echo $res;
}
