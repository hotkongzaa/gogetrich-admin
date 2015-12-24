<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model/com.gogetrich.dao/DescHeaderDaoImpl.php';
require '../../model/com.gogetrich.service/DescHeaderService.php';
require '../../model/com.gogetrich.model/DescHeaderVO.php';

$descDao = new DescHeaderDaoImpl();
$descHeaderService = new DescHeaderService($descDao);
$descHeaderName = $_GET['descHeaderName'];

$descHeaderVO = new DescHeaderVO();
$descHeaderVO->setDescHeaderID(md5(date("h:i:sa")));
$descHeaderVO->setDescHeaderName($descHeaderName);

echo $descHeaderService->saveDescHeader($descHeaderVO);
