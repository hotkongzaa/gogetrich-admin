<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require '../../model-db-connection/config.php';
require './CustomerRegistrationService.php';
$cusId = (string) filter_input(INPUT_GET, 'cusId');

$cusService = new CustomerRegistrationService();
echo $cusService->findCustomerRegistrationDetailByCusId($cusId);
