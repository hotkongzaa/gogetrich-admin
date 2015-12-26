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

    $sqlCreateCustomerDetail = "CREATE TABLE IF NOT EXISTS GTRICH_AD_USER ("
            . "AD_ID VARCHAR(100) NOT NULL,"
            . "AD_USERNAME VARCHAR(255),"
            . "AD_PASSWORD VARCHAR(255),"
            . "AD_EMAIL VARCHAR(255),"
            . "AD_FIRST_NAME VARCHAR(255),"
            . "AD_LAST_NAME VARCHAR(255),"
            . "AD_PHONE_NUMBER VARCHAR(120),"
            . "AD_CREATED_DATE_TIME TIMESTAMP,"
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
            . "HEADER_EVENT_DATE VARCHAR(255),"
            . "HEADER_DETAIL MEDIUMTEXT,"
            . "HEADER_CREATE_DATE_TIME TIMESTAMP,"
            . "HEADER_COURSE_STATUS VARCHAR(20),"
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

    return true;
} else {
    echo "Error creating database: " . mysqli_error($con);
}