<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model/com.gogetrich.dao/ADUserCredentialDaoImpl.php';
require '../../model/com.gogetrich.service/ADUserService.php';
require '../../model/com.gogetrich.model/ADUserVO.php';

$adUserDao = new ADUserCredentialDaoImpl();
$adUserService = new ADUserService($adUserDao);
$result = $adUserService->verfyAdUsernameAndPassword($_POST['username'], $_POST['password']);


if ($result == 503) {
    header("Location: ../../view/loginError?rc=" . md5(401) . "&aRed=true");
    die();
} else {
    if (explode(":", $result)[0] == 200) {
        $config = require '../../model-db-connection/GoGetRighconf.properties.php';
        $_SESSION['expire'] = time() + (60 * $config['application_timeout']);
        $_SESSION['userId'] = explode(":", $result)[1];
        $_SESSION['username'] = explode(":", $result)[2];

        header("Location: ../../view/dashboard");
    } else {
        
    }
}
