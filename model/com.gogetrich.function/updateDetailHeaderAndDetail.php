<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';


$courseCategory = $_POST['courseCategory'];
$courseName = $_POST['courseName'];
$courseEventDate = $_POST['courseEventDate'];
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
        . "HEADER_EVENT_DATE = '" . $courseEventDate . "',"
        . "HEADER_COURSE_STATUS = '" . $courseStatus . "', "
        . "HEADER_DETAIL = '" . $courseAddiDetail . "', "
        . "HEADER_CREATE_DATE_TIME = '" . $courseHeaderTime . "', "
        . "HEADER_COURSE_DURATION ='" . $courseDuration . "' "
        . "WHERE HEADER_ID = '" . $headaerID . "'";

$saveResHeader = mysql_query($sqlUpdateHeader);

if ($saveResHeader) {
    $delCourseBeforeUpdate = "DELETE FROM GTRICH_COURSE_DETAIL WHERE REF_COURSE_HEADER_ID ='" . $headaerID . "'";
    if (mysql_query($delCourseBeforeUpdate)) {
        $sqlSelectDetailFromTmp = "SELECT * FROM GTRICH_COURSE_DETAIL_TMP WHERE DISTRIBUTOR_ID = '" . $_SESSION['userId'] . "'";
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
        echo 200;
    } else {
        echo 'Cannot clear course detail with ' . mysql_error();
    }
} else {
    echo mysql_error();
}