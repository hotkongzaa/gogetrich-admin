<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model-db-connection/config.php';
require '../../model/com.gogetrich.dao/DescHeaderDaoImpl.php';
require '../../model/com.gogetrich.service/DescHeaderService.php';
require '../../model/com.gogetrich.model/DescHeaderVO.php';

$descDao = new DescHeaderDaoImpl();
$descHeaderService = new DescHeaderService($descDao);

echo $descHeaderService->getLatestHeader();
