<?php

$config_properties = require 'GoGetRighconf.properties.php';
//Try to connect domain with username and password
$con = mysqli_connect($config_properties['domain'], $config_properties['username'], $config_properties['password']);

if (mysqli_connect_errno()) {
    echo $config_properties['connection_error_msg'] . " : " . mysqli_connect_error();
}

//Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS " . $config_properties['databasename'];
if (mysqli_query($con, $sql)) {
    //Create all table when the program start    
    $con_create_tbl = mysqli_connect($config_properties['domain'], $config_properties['username'], $config_properties['password'], $config_properties['databasename']);
    mysqli_set_charset($con_create_tbl, $config_properties['msg_encode']);

    $sqlCreateTokenTbl = "CREATE TABLE IF NOT EXISTS RICH_SECURITY_TOKEN ("
            . "TOKEN VARCHAR(100) NOT NULL,"
            . "USERID VARCHAR(255),"
            . "STATUS VARCHAR(10),"
            . "LOGINDATETIME TIMESTAMP,"
            . "USERNAME VARCHAR(255),"
            . "PRIMARY KEY (TOKEN)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateTokenTbl);

    $sqlCreateCustomerDetail = "CREATE TABLE IF NOT EXISTS GTRICH_AD_USER ("
            . "AD_ID VARCHAR(100) NOT NULL,"
            . "AD_USERNAME VARCHAR(255),"
            . "AD_PASSWORD VARCHAR(255),"
            . "AD_EMAIL VARCHAR(255),"
            . "AD_FIRST_NAME VARCHAR(255),"
            . "AD_LAST_NAME VARCHAR(255),"
            . "AD_PHONE_NUMBER VARCHAR(120),"
            . "AD_CREATED_DATE_TIME TIMESTAMP,"
            . "USER_PREVILLAGE VARCHAR(255),"
            . "PRIMARY KEY (AD_ID)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateCustomerDetail);

    $sqlCreateCateCourseDetail = "CREATE TABLE IF NOT EXISTS GTRICH_COURSE_CATEGORY ("
            . "CATE_ID VARCHAR(100) NOT NULL,"
            . "CATE_NAME VARCHAR(255),"
            . "CATE_CREATE_DATE_TIME TIMESTAMP,"
            . "PRIMARY KEY (CATE_ID)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateCateCourseDetail);

    $sqlCreateCourseHeader = "CREATE TABLE IF NOT EXISTS GTRICH_COURSE_HEADER ("
            . "HEADER_ID VARCHAR(100) NOT NULL,"
            . "HEADER_NAME VARCHAR(255),"
            . "SUB_HEADER_NAME VARCHAR(255),"
            . "HEADER_EVENT_DATE VARCHAR(255),"
            . "HEADER_DETAIL MEDIUMTEXT,"
            . "HEADER_CREATE_DATE_TIME TIMESTAMP,"
            . "HEADER_COURSE_STATUS VARCHAR(20),"
            . "HEADER_COURSE_DURATION VARCHAR(100),"
            . "REF_CATE_ID VARCHAR(100),"
            . "PRIMARY KEY (HEADER_ID)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateCourseHeader);

    $sqlCreateCourseDetail = "CREATE TABLE IF NOT EXISTS GTRICH_COURSE_DETAIL ("
            . "DETAIL_ID VARCHAR(100) NOT NULL,"
            . "DESC_HEADER_ID VARCHAR(100),"
            . "DETAIL_DESCRIPTION MEDIUMTEXT,"
            . "DETAIL_LAT VARCHAR(100),"
            . "DETAIL_LNG VARCHAR(100),"
            . "DETAIL_CREATED_DATE_TIME TIMESTAMP,"
            . "REF_COURSE_HEADER_ID VARCHAR(100),"
            . "DETAIL_ORDER VARCHAR(100),"
            . "PRIMARY KEY (DETAIL_ID)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateCourseDetail);

    $sqlCreateCourseDetailTmp = "CREATE TABLE IF NOT EXISTS GTRICH_COURSE_DETAIL_TMP ("
            . "DETAIL_ID VARCHAR(100) NOT NULL,"
            . "DETAIL_DESCRIPTION MEDIUMTEXT,"
            . "DETAIL_LAT VARCHAR(100),"
            . "DETAIL_LNG VARCHAR(100),"
            . "DETAIL_CREATED_DATE_TIME TIMESTAMP,"
            . "REF_COURSE_HEADER_ID VARCHAR(100),"
            . "DISTRIBUTOR_ID VARCHAR(100),"
            . "DETAIL_ORDER VARCHAR(100),"
            . "PRIMARY KEY (DETAIL_ID)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateCourseDetailTmp);

    $sqlCreateDescHeader = "CREATE TABLE IF NOT EXISTS GTRICH_DESCRIPTION_HEADER ("
            . "DESC_HEADER_ID VARCHAR(100) NOT NULL,"
            . "DESC_HEADER_NAME VARCHAR(255),"
            . "DESC_HEADER_CREATED_DATE_TIME TIMESTAMP,"
            . "PRIMARY KEY (DESC_HEADER_ID)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateDescHeader);

    $sqlCreatePromotion = "CREATE TABLE IF NOT EXISTS GTRICH_COURSE_PROMOTION ("
            . "PRO_ID VARCHAR(100) NOT NULL,"
            . "PRO_NAME VARCHAR(255),"
            . "PRO_CREATED_DATE_TIME TIMESTAMP,"
            . "REF_COURSE_HEADER_ID VARCHAR(200),"
            . "PRIMARY KEY (PRO_ID)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreatePromotion);

    $sqlCreatePromotionTmp = "CREATE TABLE IF NOT EXISTS GTRICH_PROMOTION_TMP ("
            . "PRO_ID VARCHAR(100) NOT NULL,"
            . "PRO_NAME VARCHAR(255),"
            . "PRO_CREATED_DATE_TIME TIMESTAMP,"
            . "DISTRIBUTOR_ID VARCHAR(200),"
            . "PRIMARY KEY (PRO_ID)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreatePromotionTmp);

    $sqlCreateEventTmp = "CREATE TABLE IF NOT EXISTS GTRICH_COURSE_EVENT_DATE_TIME_TMP ("
            . "EVENT_ID VARCHAR(100) NOT NULL,"
            . "START_EVENT_DATE_TIME VARCHAR(255),"
            . "END_EVENT_DATE_TIME VARCHAR(255),"
            . "EVENT_CREATED_DATE_TIME TIMESTAMP,"
            . "EVENT_DISTRIBUTOR_ID VARCHAR(200),"
            . "PRIMARY KEY (EVENT_ID)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateEventTmp);

    $sqlCreateEventTmp = "CREATE TABLE IF NOT EXISTS GTRICH_COURSE_EVENT_DATE_TIME ("
            . "EVENT_ID VARCHAR(100) NOT NULL,"
            . "START_EVENT_DATE_TIME VARCHAR(255),"
            . "END_EVENT_DATE_TIME VARCHAR(255),"
            . "EVENT_CREATED_DATE_TIME TIMESTAMP,"
            . "REF_COURSE_HEADER_ID VARCHAR(200),"
            . "PRIMARY KEY (EVENT_ID)"
            . ")ENGINE=InnoDB DEFAULT CHARSET=utf8;";
    mysqli_query($con_create_tbl, $sqlCreateEventTmp);

    return true;
} else {
    echo "Error creating database: " . mysqli_error($con);
}