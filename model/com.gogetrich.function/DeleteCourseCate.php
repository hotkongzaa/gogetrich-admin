<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require '../../model/com.gogetrich.dao/CategoryDaoImpl.php';
require '../../model/com.gogetrich.service/CategoryService.php';
require '../../model/com.gogetrich.model/CategoryVO.php';

$cateDao = new CategoryDaoImpl();
$cateService = new CategoryService($cateDao);
$cateID = $_GET['cateID'];

echo $cateService->deleteCourseCategory($cateID);
