<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
require '../com.gogetrich.function/CredentialValidationService.php';
$service = new CredentialValidationService();
$result = $service->invalidToken($_SESSION['token']);
if ($result == 200) {
    unset($_SESSION['token']);
    header("Location: ../../view/login");
}