<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../../model-db-connection/config.php';
require './CustomerRegistrationService.php';

$cusService = new CustomerRegistrationService();
$password = $cusService->getStringValueFromReq('password');
$confirmPassword = $cusService->getStringValueFromReq('confirmPassword');
$email = $cusService->getStringValueFromReq('email');
$firstName = $cusService->getStringValueFromReq('fName');
$lastName = $cusService->getStringValueFromReq('lName');
$gender = $cusService->getStringValueFromReq('gender');
$contactAddress = $cusService->getStringValueFromReq('contactAddress');
$receiptAddress = $cusService->getStringValueFromReq('receiptAddress');
$phone = $cusService->getStringValueFromReq('phone');
$facebookAdr = $cusService->getStringValueFromReq('facebookAdr');
$forceChange = $cusService->getStringValueFromReq('forceChange');
