<?php include 'header.tpl'; ?>
<script>
 $(document).ready(function(){  
		<?php  
		if($create){
		?>
			window.parent.location.reload();
		<?php 
		}?>
 });
</script>

<?php  
if(!$create){ 
?>
<form action="<?php echo 'dispatcher.php?create'; ?>" method="POST">
<table class="ui-widget crud-sub-table">
<?php 

foreach ($columns as $column){
	if($column['Field']!=$pk){
		if(!isset($titleMap[$column['Field']])||$titleMap[$column['Field']]!==false){
			echo '<tr>';
			echo '<td>'.(isset($titleMap[$column['Field']]['name'])?$titleMap[$column['Field']]['name']:$column['Field']).'</td>';
			echo '<td>';
			echo $htmlHelper->input(array($column['Field']=>null),$types[$column['Field']]);
			echo '</td>';
			echo '</tr>';
		}
	}
}
?>
<tr>
<td colspan="2">
	<input type="submit" value="Create" class="ui-button ui-widget ui-state-default ui-corner-all"/>
</td>
</tr>
</table>
</form>

<?php 
}else{
	echo 'Reloading';
}?>

<?php include 'footer.tpl'?>