<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerDao
 *
 * @author krisada.thiangtham
 */
require 'ADUserCredentialDao.php';
include '../com.gogetrich.utils/ArrayList.php';
include '../com.gogetrich.model/CustomerVO.php';

class ADUserCredentialDaoImpl implements ADUserCredentialDao {

    public function deleteAdUserByID($cusID) {
        
    }

    public function editAdUser(\ADUserVO $adUserVO) {
        
    }

    public function getAdUserById($cusID) {
        
    }

    public function saveAdUser(\ADUserVO $adUserVO) {
        
    }

    public function verfyAdUsernameAndPassword($username, $password) {
        $config_properties = require '../../model-db-connection/GoGetRighconf.properties.php';

        // Create connection
        $mysqli = new mysqli($config_properties['domain'], $config_properties['username'], $config_properties['password'], $config_properties['databasename']);

        /* check connection */
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }

        // prepare and bind
        if ($stmt = $mysqli->prepare("SELECT AD_ID,AD_USERNAME FROM GTRICH_AD_USER WHERE AD_USERNAME LIKE ? AND AD_PASSWORD LIKE ?")) {
            $stmt->bind_param("ss", $username, md5($password));
            $stmt->execute();

            /* bind result variables */
            $stmt->bind_result($adUserId, $adUsername);
            /* fetch value */

            $stmt->fetch();

            if (!empty($adUserId)) {
                return "200:" . $adUserId . ":" . $adUsername;
            } else {
                return 401;
            }
            $stmt->close();
        }
        $mysqli->close();
    }

    public function getAllRegisteredUser($row) {
        $sqlGetAllRes = "SELECT CUS_ID,CUS_USERNAME,CUS_PASSWORD,CUS_EMAIL,CUS_FIRST_NAME,CUS_LAST_NAME,CUS_GENDER,CUS_CONTACT_ADDRESS,CUS_RECEIPT_ADDRESS,CUS_PHONE_NUMBER,CUS_FACEBOOK_ADDRESS,CREATED_DATE_TIME FROM RICH_CUSTOMER ORDER BY CREATED_DATE_TIME DESC LIMIT " . $row;
        $result = mysql_query($sqlGetAllRes);
        $listUser = new ArrayList();
        while ($row = mysql_fetch_array($result)) {
            $userObj = new CustomerVO();
            $userObj->setCusID($row['CUS_ID']);
            $userObj->setCusUsername($row['CUS_USERNAME']);
            $userObj->setCusPassword($row['CUS_PASSWORD']);
            $userObj->setCusEmail($row['CUS_EMAIL']);
            $userObj->setCusFirstName($row['CUS_FIRST_NAME']);
            $userObj->setCusLastName($row['CUS_LAST_NAME']);
            $userObj->setCusGender($row['CUS_GENDER']);
            $userObj->setCusContactAddr($row['CUS_CONTACT_ADDRESS']);
            $userObj->setCusReceiptAddr($row['CUS_RECEIPT_ADDRESS']);
            $userObj->setPhoneNumber($row['CUS_PHONE_NUMBER']);
            $userObj->setCusFacebookAddr($row['CUS_FACEBOOK_ADDRESS']);
            $userObj->setCusCreatedDateTime($row['CREATED_DATE_TIME']);
            $listUser->Add($userObj);
        }

        return $listUser;
    }

}
