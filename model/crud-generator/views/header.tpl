<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<link type="text/css" rel="stylesheet"
	href="webroot/css/jquery-ui-1.8.7.custom.css" />

<script type="text/javascript" 
	src="webroot/js/jquery-1.4.4.min.js"></script>

<script type="text/javascript"
	src="webroot/js/jquery-ui-1.8.7.custom.min.js"></script>

<link type="text/css" rel="stylesheet"
	 href="webroot/css/crud.css" />

</head>
<body>
<?php 
include 'helpers/html_helper.php'; 
$htmlHelper = new HtmlHelper();
$types=array();
foreach($columns as $column){	
	$types[$column['Field']]=$column['Type'];
}
?>