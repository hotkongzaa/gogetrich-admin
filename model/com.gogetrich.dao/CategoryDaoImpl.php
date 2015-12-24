<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryDaoImpl
 *
 * @author krisada.thiangtham
 */
require '../com.gogetrich.dao/CategoryDao.php';

class CategoryDaoImpl implements CategoryDao {

    public function deleteCourseCategory($courseID) {
        $config_properties = require '../../model-db-connection/GoGetRighconf.properties.php';

        // Create connection
        $mysqli = new mysqli($config_properties['domain'], $config_properties['username'], $config_properties['password'], $config_properties['databasename']);

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        $mysqli->set_charset("utf8");
        // prepare and bind
        $stmt = $mysqli->prepare("DELETE FROM GTRICH_COURSE_CATEGORY WHERE CATE_ID = ?");
        $stmt->bind_param("s", $courseID);
        if ($stmt->execute()) {
            return 200;
        } else {
            return "503 Internal Error:" . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    }

    public function getAllCourseCategory() {
        
    }

    public function getCourseCategoryByID($courseID) {
        $sql = "SELECT * FROM GTRICH_COURSE_CATEGORY WHERE CATE_ID = '" . $courseID . "'";
        $res = mysql_query($sql);
        $row = mysql_fetch_array($res);
        return json_encode($row);
    }

    public function saveCourseCategory(\CategoryVO $obj) {
        $config_properties = require '../../model-db-connection/GoGetRighconf.properties.php';

        // Create connection
        $mysqli = new mysqli($config_properties['domain'], $config_properties['username'], $config_properties['password'], $config_properties['databasename']);

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        $mysqli->set_charset("utf8");
        // prepare and bind
        $stmt = $mysqli->prepare("INSERT INTO GTRICH_COURSE_CATEGORY (CATE_ID,CATE_NAME,CATE_CREATE_DATE_TIME) VALUES (?,?,NOW())");
        $stmt->bind_param("ss", $obj->getCateID(), $obj->getCateName());
        $stmt->execute();

        $stmt->close();
        $mysqli->close();
        return 200;
    }

    public function updateCourseCate(\CategoryVO $obj) {
        $config_properties = require '../../model-db-connection/GoGetRighconf.properties.php';

        // Create connection
        $mysqli = new mysqli($config_properties['domain'], $config_properties['username'], $config_properties['password'], $config_properties['databasename']);

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        $mysqli->set_charset("utf8");
        // prepare and bind
        $stmt = $mysqli->prepare("UPDATE GTRICH_COURSE_CATEGORY SET CATE_NAME=?,CATE_CREATE_DATE_TIME=NOW() WHERE CATE_ID=?");
        $stmt->bind_param("ss", $obj->getCateName(), $obj->getCateID());
        if ($stmt->execute()) {
            return 200;
        } else {
            return "503 Internal Error:" . $stmt->error;
        }

        $stmt->close();
        $mysqli->close();
    }

}
