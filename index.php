<?php

$dbStatus = include("./model-db-connection/DBConnection.inc");
if ($dbStatus == 1) {
    header("Location: view/login");
} else {
    echo "Cannot initial Database";
}
//
die;

