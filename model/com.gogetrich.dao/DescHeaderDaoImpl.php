<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DescHeaderDaoImpl
 *
 * @author krisada.thiangtham
 */
require 'DescHeaderDao.php';

class DescHeaderDaoImpl implements DescHeaderDao {

    public function deleteDescHeaderByID($id) {
        
    }

    public function getAllDescHeader() {
        
    }

    public function getDescHeaderByID($id) {
        
    }

    public function saveDescHeader(\DescHeaderVO $obj) {
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
        $stmt = $mysqli->prepare("INSERT INTO GTRICH_DESCRIPTION_HEADER (DESC_HEADER_ID,DESC_HEADER_NAME,DESC_HEADER_CREATED_DATE_TIME) VALUES (?,?,NOW())");
        $stmt->bind_param("ss", $obj->getDescHeaderID(), $obj->getDescHeaderName());
        $stmt->execute();

        $stmt->close();
        $mysqli->close();
        return 200;
    }

    public function updateDescHeader(\DescHeaderVO $obj) {
        
    }

    public function getLatestHeader() {
        $sql = "SELECT * " .
                "FROM GTRICH_DESCRIPTION_HEADER " .
                "WHERE DESC_HEADER_CREATED_DATE_TIME IN (SELECT MAX(DESC_HEADER_CREATED_DATE_TIME) FROM GTRICH_DESCRIPTION_HEADER)";
        $res = mysql_query($sql);
        $row = mysql_fetch_array($res);
        return json_encode($row);
    }

//put your code here
}
