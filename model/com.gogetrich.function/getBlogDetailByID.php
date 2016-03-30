<?php

session_start();
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$bid = (string) filter_input(INPUT_GET, 'bid');
require '../../model-db-connection/config.php';
$sqlGetBlogDetail = "SELECT * FROM GTRICH_BLOG_DETAIL WHERE BLOG_ID LIKE '" . $bid . "'";
$resGetBlogDetail = mysql_query($sqlGetBlogDetail);
if (mysql_num_rows($resGetBlogDetail) >= 1) {
    $rowBlgoDetail = mysql_fetch_assoc($resGetBlogDetail);
    echo '101||' . json_encode($rowBlgoDetail);
} else {
    echo '401||';
}

