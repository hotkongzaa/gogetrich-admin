<?php
error_reporting(E_ALL);
@session_start();
//single controller based MVC structure


include 'boot.php';		

$qs = isset($_SERVER['REDIRECT_QUERY_STRING']) ? $_SERVER['REDIRECT_QUERY_STRING'] : $_SERVER['QUERY_STRING'];

$action = 'table';
$tokens = explode( '&', $qs );
if ( strlen( $tokens[0] ) > 0 ) {
	$action = strtolower( $tokens[0] );
}

include ROOT.'/controllers/grid_controller.php';
$grid = new GridController();
call_user_func(array($grid,$action));
?>