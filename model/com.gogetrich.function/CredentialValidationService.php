<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CredentialValidationService
 *
 * @author krisada.thiangtham
 */
class CredentialValidationService {

    public function __construct() {
        
    }

    public function submitToken($username, $userID) {
        $config = require '../../model-db-connection/GoGetRighconf.properties.php';
        $conn = new mysqli($config['domain'], $config['username'], $config['password'], $config['databasename']);

        $tokenID = md5(date("h:i:sa") . $username . $userID);
        $stmt = $conn->prepare("INSERT INTO RICH_SECURITY_TOKEN (TOKEN, USERID,STATUS,LOGINDATETIME,USERNAME) VALUES (?, ?,1, NOW(),?)");
        $stmt->bind_param("sss", $tokenID, $userID, $username);
        if ($stmt->execute()) {
            $_SESSION['token'] = $tokenID;
            $_SESSION['expire'] = time() + (60 * $config['application_timeout']);
            return 200;
        } else {
            return mysql_error();
        }
        $stmt->close();
        $conn->close();
    }

    public function checkIsTokenValid($token) {
        $sqlCheck = "SELECT * FROM RICH_SECURITY_TOKEN WHERE TOKEN='" . $token . "'";
        $res = mysql_query($sqlCheck);
        $row = mysql_fetch_assoc($res);
        if ($row['STATUS'] == 1) {
            return 200;
        } else {
            return 409;
        }
    }

    public function invalidToken($token) {
        $config = require '../../model-db-connection/GoGetRighconf.properties.php';
        $conn = new mysqli($config['domain'], $config['username'], $config['password'], $config['databasename']);

        $stmt = $conn->prepare("UPDATE RICH_SECURITY_TOKEN SET STATUS=0 WHERE TOKEN=?");
        $stmt->bind_param("s", $token);
        if ($stmt->execute()) {
            return 200;
        } else {
            return 503;
        }
        $stmt->close();
        $conn->close();
    }

    public function getTokenDetail($token) {
        $sqlCheck = "SELECT * FROM RICH_SECURITY_TOKEN WHERE TOKEN='" . $token . "'";
        $res = mysql_query($sqlCheck);
        $row = mysql_fetch_assoc($res);
        return json_encode($row);
    }

}
