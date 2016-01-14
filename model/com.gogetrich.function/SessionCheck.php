<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../com.gogetrich.function/CredentialValidationService.php';
$now = time();
if ($now > $_SESSION['expire']) {
    $service = new CredentialValidationService();
    $result = $service->invalidToken($_SESSION['token']);
    if ($result == 200) {
        unset($_SESSION['token']);
        echo 409;
    }
} else {
    echo 200;
}