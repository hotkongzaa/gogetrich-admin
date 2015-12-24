<?php

$timeOut = $_GET['timeOut'];
if($timeOut==""){
    $timeOut = time();
}
//$_SESSION['start'] = time();
$_SESSION['expire'] = $timeOut + (60 * 30);
$_SESSION['username'] = $row['username'];
$_SESSION['permission_id'] = $row['permission_id'];

