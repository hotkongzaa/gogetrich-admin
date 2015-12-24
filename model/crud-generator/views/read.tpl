<?php include 'header.tpl';?>

<table class="ui-widget crud-sub-table">
<?php 
//print_r($data);
$data = $data[0];
foreach ($data as $key=>$value){
	if(!isset($titleMap[$key])||$titleMap[$key]!==false){
		echo '<tr>';
			echo '<td>'.(isset($titleMap[$key]['name'])?$titleMap[$key]['name']:$key).'</td>';
			echo '<td>';
			echo $htmlHelper->input(array($key=>$value),$types[$key]);
			echo '</td>';
		echo '</tr>';
	}
}

?>
</table>

<?php include 'footer.tpl';?>