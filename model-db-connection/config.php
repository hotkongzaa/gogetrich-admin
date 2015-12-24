<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$config = require 'GoGetRighconf.properties.php';

$objConnect = mysql_connect($config['domain'],$config['username'],$config['password']) or die(mysql_error());
$objDB = mysql_select_db($config['databasename']) or die($config['connection_error_msg']);
mysql_query($config['msg_encode'],$objConnect);
