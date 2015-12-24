<?php include 'header.tpl'?>

<script>
 $(document).ready(function(){  
		<?php  
		if($update){
		?>
		window.parent.location.reload();
		<?php 
		}?>
 });
</script>

<?php  
if(!$update){
?>
	<form action="<?php echo 'dispatcher.php?update&id='.$id; ?>" method="POST">
	<table class="ui-widget crud-sub-table">
	<?php 
	$data = $data[0];
	foreach ($data as $key=>$value){
		if($key!=$pk){
			if(!isset($titleMap[$key])||$titleMap[$key]!==false){
				echo '<tr>';
				echo '<td>'.(isset($titleMap[$key]['name'])?$titleMap[$key]['name']:$key).'</td>';
				echo '<td>';
				echo $htmlHelper->input(array($key=>$value),$types[$key]);
				echo '</td>';
				echo '</tr>';
			}
		}else{
		
			echo '<input type="hidden" name="'.$key.'"  value="'.$value.'"/>';
		}	
	}
	?>
	<tr>
	<td colspan="2">
		<input type="submit" value="Update" class="ui-button ui-widget ui-state-default ui-corner-all"  ole="button" aria-disabled="false"/>
	</td>
	</tr>
	</table>
	</form>
<?php 
}else{
	echo 'Reloading';
}?>

<?php include 'footer.tpl'?>