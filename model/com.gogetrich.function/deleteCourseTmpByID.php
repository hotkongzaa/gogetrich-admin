<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

$tmpCourseID = (string) filter_input(INPUT_GET, 'tmpCourseID');
$sql = "DELETE FROM GTRICH_COURSE_DETAIL_TMP WHERE DETAIL_ID = '" . $tmpCourseID . "'";
$isGall = (boolean) filter_input(INPUT_GET, 'isGall');
if ($isGall == true) {
    $sqlGetImageForDel = "SELECT * FROM GTRICH_GALLERY_IMAGES_UPLOAD WHERE REF_COURSE_ID = '" . $tmpCourseID . "'";
    $resGetImageForDel = mysql_query($sqlGetImageForDel);
    $out_dir = "../../view/assets/uploads/images/";
    while ($row = mysql_fetch_array($resGetImageForDel)) {
        $fileName = $out_dir . $row['IMAGE_NAME'];
        if (file_exists($fileName)) {
            unlink($fileName);
        }
    }

    mysql_query("DELETE FROM GTRICH_GALLERY_IMAGES_UPLOAD WHERE REF_COURSE_ID='" . $tmpCourseID . "'");
}
if (mysql_query($sql)) {
    echo 200;
} else {
    echo mysql_error();
}