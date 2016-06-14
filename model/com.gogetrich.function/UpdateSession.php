<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$config = require '../../model-db-connection/GoGetRighconf.properties.php';
require './CredentialValidationService.php';
$now = time();
$service = new CredentialValidationService();
if ($now > $_SESSION['expire']) {
    $result = $service->invalidToken($_SESSION['token']);
    if ($result == 200) {
        unset($_SESSION['token']);
        echo 409;
    }
} else {
//    var_dump(isset($_SESSION['token']));
    if (isset($_SESSION['token'])) {
        $validToken = $service->checkIsTokenValid($_SESSION['token']);
        if ($validToken == 200) {
            $_SESSION['expire'] = time() + (60 * $config['application_timeout']);
            echo 200;
        } else {
            unset($_SESSION['token']);
            echo 409;
        }
    } else {
        echo 409;
    }
}