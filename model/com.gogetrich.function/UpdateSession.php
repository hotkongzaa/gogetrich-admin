<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$config = require '../../model-db-connection/GoGetRighconf.properties.php';
$_SESSION['expire'] = time() + (60 * $config['application_timeout']);
echo 200;
