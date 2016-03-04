<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';

require '../../model/com.gogetrich.function/CredentialValidationService.php';
$serviceCheck = new CredentialValidationService();
$jsonObj = $serviceCheck->getTokenDetail($_SESSION['token']);
$jsonValue = json_decode($jsonObj, true);

$courseCategory = (string) filter_input(INPUT_POST, 'courseCategory');
$courseName = (string) filter_input(INPUT_POST, 'courseName');
$courseStatus = (string) filter_input(INPUT_POST, 'courseStatus');
$headaerID = md5(date("h:i:sa"));
$courseAddiDetail = (string) filter_input(INPUT_POST, 'courseAddiDetail');
$subCourseName = (string) filter_input(INPUT_POST, 'subCourseName');
$courseDuration = (string) filter_input(INPUT_POST, 'courseDuration');
$availableSeat = (string) filter_input(INPUT_POST, 'availableSeat');

$sqlSaveHeader = "INSERT INTO GTRICH_COURSE_HEADER (HEADER_ID,HEADER_NAME,SUB_HEADER_NAME,HEADER_EVENT_DATE,HEADER_DETAIL,HEADER_CREATE_DATE_TIME,HEADER_COURSE_STATUS,HEADER_COURSE_DURATION,REF_CATE_ID,AVAILABLE_SEATS,BOOKING_SEATS) "
        . "VALUES "
        . "('" . $headaerID . "','" . $courseName . "','" . $subCourseName . "','','" . $courseAddiDetail . "',NOW(),'" . $courseStatus . "','" . $courseDuration . "','" . $courseCategory . "','" . $availableSeat . "','0')";
$saveResHeader = mysql_query($sqlSaveHeader);

if ($saveResHeader) {
    $sqlSelectDetailFromTmp = "SELECT * FROM GTRICH_COURSE_DETAIL_TMP WHERE DISTRIBUTOR_ID = '" . $jsonValue['USERID'] . "'";
    $resFromTmp = mysql_query($sqlSelectDetailFromTmp);
    while ($rowFromTmp = mysql_fetch_array($resFromTmp)) {
        $insertToDetail = "INSERT INTO GTRICH_COURSE_DETAIL (DETAIL_ID,DESC_HEADER_ID,DETAIL_DESCRIPTION,DETAIL_LAT,DETAIL_LNG,DETAIL_CREATED_DATE_TIME,REF_COURSE_HEADER_ID,DETAIL_ORDER,REF_GALLERY_ID) "
                . "VALUES "
                . "('" . $rowFromTmp['DETAIL_ID'] . "','" . $rowFromTmp['REF_COURSE_HEADER_ID'] . "','" . $rowFromTmp['DETAIL_DESCRIPTION'] . "','" . $rowFromTmp['DETAIL_LAT'] . "','" . $rowFromTmp['DETAIL_LNG'] . "','" . $rowFromTmp['DETAIL_CREATED_DATE_TIME'] . "','" . $headaerID . "','" . $rowFromTmp['DETAIL_ORDER'] . "','" . $rowFromTmp['REF_GALLERY_ID'] . "')";

        $saveCourseDetail = mysql_query($insertToDetail);
        if ($saveCourseDetail) {
            $delCourseTmp = "DELETE FROM GTRICH_COURSE_DETAIL_TMP WHERE DETAIL_ID = '" . $rowFromTmp['DETAIL_ID'] . "'";
            mysql_query($delCourseTmp);
        }
    }

    $sqlSelectPromotionTmp = "SELECT * FROM GTRICH_PROMOTION_TMP WHERE DISTRIBUTOR_ID = '" . $jsonValue['USERID'] . "'";
    $resPromotionTmp = mysql_query($sqlSelectPromotionTmp);
    while ($rowPromotionTmp = mysql_fetch_array($resPromotionTmp)) {
        $insertIntoPromotion = "INSERT INTO GTRICH_COURSE_PROMOTION (PRO_ID,PRO_NAME,PRO_CREATED_DATE_TIME,REF_COURSE_HEADER_ID)"
                . " VALUES "
                . "('" . $rowPromotionTmp['PRO_ID'] . "','" . $rowPromotionTmp['PRO_NAME'] . "','" . $rowPromotionTmp['PRO_CREATED_DATE_TIME'] . "','" . $headaerID . "')";
        $savePromotion = mysql_query($insertIntoPromotion);
        if ($savePromotion) {
            $delPromotionTmp = "DELETE FROM GTRICH_PROMOTION_TMP WHERE PRO_ID = '" . $rowPromotionTmp['PRO_ID'] . "'";
            mysql_query($delPromotionTmp);
        }
    }

    //Manage course Envent date time
    $sqlSelectEventDateTmp = "SELECT * FROM GTRICH_COURSE_EVENT_DATE_TIME_TMP WHERE EVENT_DISTRIBUTOR_ID = '" . $jsonValue['USERID'] . "'";
    $resEventDateTmp = mysql_query($sqlSelectEventDateTmp);
    while ($rowEventDateTmp = mysql_fetch_array($resEventDateTmp)) {

        $inserIntoCourseEvent = "INSERT INTO GTRICH_COURSE_EVENT_DATE_TIME (EVENT_ID,START_EVENT_DATE_TIME,END_EVENT_DATE_TIME,EVENT_CREATED_DATE_TIME,REF_COURSE_HEADER_ID)"
                . " VALUES "
                . "('" . $rowEventDateTmp['EVENT_ID'] . "','" . $rowEventDateTmp['START_EVENT_DATE_TIME'] . "','" . $rowEventDateTmp['END_EVENT_DATE_TIME'] . "','" . $rowEventDateTmp['EVENT_CREATED_DATE_TIME'] . "','" . $headaerID . "')";

        $saveEventDate = mysql_query($inserIntoCourseEvent);
        if ($saveEventDate) {
            $delEventDateTmp = "DELETE FROM GTRICH_COURSE_EVENT_DATE_TIME_TMP WHERE EVENT_ID = '" . $rowEventDateTmp['EVENT_ID'] . "'";
            mysql_query($delEventDateTmp);
        }
    }

    // Update gallery image upload 
    $sql = "UPDATE GTRICH_GALLERY_IMAGES_UPLOAD SET REF_COURSE_HEADER_ID ='" . $headaerID . "' WHERE REF_COURSE_HEADER_ID = ''";
    mysql_query($sql);
    echo 200;
} else {
    echo mysql_error();
}