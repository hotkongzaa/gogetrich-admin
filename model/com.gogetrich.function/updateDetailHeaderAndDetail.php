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


$courseCategory = $_POST['courseCategory'];
$courseName = $_POST['courseName'];
$courseStatus = $_POST['courseStatus'];
$headaerID = $_POST['headerID'];
$courseAddiDetail = $_POST['courseAddiDetail'];
$subCourseName = $_POST['subCourseName'];
$courseHeaderTime = $_POST['courseHeaderTime'];
$courseDuration = $_POST['courseDuration'];

$sqlUpdateHeader = "UPDATE GTRICH_COURSE_HEADER "
        . "SET REF_CATE_ID = '" . $courseCategory . "', "
        . "HEADER_NAME = '" . $courseName . "', "
        . "SUB_HEADER_NAME = '" . $subCourseName . "', "
        . "HEADER_EVENT_DATE = '', "
        . "HEADER_COURSE_STATUS = '" . $courseStatus . "', "
        . "HEADER_DETAIL = '" . $courseAddiDetail . "', "
        . "HEADER_CREATE_DATE_TIME = '" . $courseHeaderTime . "', "
        . "HEADER_COURSE_DURATION ='" . $courseDuration . "' "
        . "WHERE HEADER_ID = '" . $headaerID . "'";

$saveResHeader = mysql_query($sqlUpdateHeader);

if ($saveResHeader) {
    $delCourseBeforeUpdate = "DELETE FROM GTRICH_COURSE_DETAIL WHERE REF_COURSE_HEADER_ID ='" . $headaerID . "'";
    $delPromotionBeforeUpdate = "DELETE FROM GTRICH_COURSE_PROMOTION WHERE REF_COURSE_HEADER_ID='" . $headaerID . "'";
    $delCourseEventBeforeUpdate = "DELETE FROM GTRICH_COURSE_EVENT_DATE_TIME WHERE REF_COURSE_HEADER_ID='" . $headaerID . "'";
    if (mysql_query($delCourseBeforeUpdate) && mysql_query($delPromotionBeforeUpdate) && mysql_query($delCourseEventBeforeUpdate)) {
        //Manage course detail
        $sqlSelectDetailFromTmp = "SELECT * FROM GTRICH_COURSE_DETAIL_TMP WHERE DISTRIBUTOR_ID = '" . $jsonValue['USERID'] . "'";
        $resFromTmp = mysql_query($sqlSelectDetailFromTmp);
        while ($rowFromTmp = mysql_fetch_array($resFromTmp)) {
            $insertToDetail = "INSERT INTO GTRICH_COURSE_DETAIL (DETAIL_ID,DESC_HEADER_ID,DETAIL_DESCRIPTION,DETAIL_LAT,DETAIL_LNG,DETAIL_CREATED_DATE_TIME,REF_COURSE_HEADER_ID,DETAIL_ORDER) "
                    . "VALUES "
                    . "('" . $rowFromTmp['DETAIL_ID'] . "','" . $rowFromTmp['REF_COURSE_HEADER_ID'] . "','" . $rowFromTmp['DETAIL_DESCRIPTION'] . "','" . $rowFromTmp['DETAIL_LAT'] . "','" . $rowFromTmp['DETAIL_LNG'] . "','" . $rowFromTmp['DETAIL_CREATED_DATE_TIME'] . "','" . $headaerID . "','" . $rowFromTmp['DETAIL_ORDER'] . "')";
            $saveCourseDetail = mysql_query($insertToDetail);
            if ($saveCourseDetail) {
                $delCourseTmp = "DELETE FROM GTRICH_COURSE_DETAIL_TMP WHERE DETAIL_ID = '" . $rowFromTmp['DETAIL_ID'] . "'";
                mysql_query($delCourseTmp);
            }
        }

        //Manage course promotion
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

        echo 200;
    } else {
        echo 'Cannot clear course detail with ' . mysql_error();
    }
} else {
    echo mysql_error();
}