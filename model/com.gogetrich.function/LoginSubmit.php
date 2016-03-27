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
require 'CredentialValidationService.php';

$adUserDao = new ADUserCredentialDaoImpl();
$adUserService = new ADUserService($adUserDao);
$result = $adUserService->verfyAdUsernameAndPassword($_POST['username'], $_POST['password']);

if ($result == 401) {
    header("Location: ../../view/loginError?rc=" . md5(401) . "&aRed=true");
    die();
} else {
    $loginRes = explode(":", $result);
    if ($loginRes[0] == 200) {
        $service = new CredentialValidationService();
        if ($service->submitToken($loginRes[2], $loginRes[1]) == 200) {
            header("Location: ../../view/dashboard");
        } else {
            header("Location: ../../view/loginError?rc=" . md5(503) . "&aRed=true");
        }
    } else {
        header("Location: ../../view/loginError?rc=" . md5(503) . "&aRed=true");
        die();
    }
}
