<!-------------------------------------------BODY ------------------------------------>
<tbody>
<?php 
		$create = (null==$actions)|| !isset($actions['create'])||($actions['create']!==false);	
		$read   = (null==$actions)||!isset($actions['read'])||($actions['read']!==false);
	    $delete = (null==$actions)|| !isset($actions['delete'])||($actions['delete']!==false);
	    $update = (null==$actions)|| !isset($actions['update'])||($actions['update']!==false);	   
	    $showColumns = 0;
	    foreach($columns as $index=>$col){
			if(!isset($titleMap[$col['Field']])||$titleMap[$col['Field']]!==false){
				$showColumns++;
			}
		}	   
//data area
foreach($data as $idx=>$dt){
	?>
	<tr>
		<?php
		foreach($columns as $index=>$col){
			if(!isset($titleMap[$col['Field']])||$titleMap[$col['Field']]!==false){
				?>
				<td class="ui-widget-content"><?php echo ($dt[$col['Field']]!=null?$dt[$col['Field']]:'&nbsp;'); ?></td>
			<?php
			}
		}
		?>
		
		<?php 
		if($read||$delete||$update){
			echo '<td class="ui-widget-content crud-actions">';
							if($update){
								echo '<a
										href="'.URL_ROOT.'/crud/dispatcher.php?update&id='.$dt[$pk].'"
										class="button-update ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only"
										role="button" title="Update"><span
										class="ui-button-icon-primary ui-icon ui-icon-pencil"></span><span
										class="ui-button-text">Update</span></a> ';
							}
							
							if($read){
								echo '<a
										href="'.URL_ROOT.'/crud/dispatcher.php?read&id='.$dt[$pk].'"
										class="button-read ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only"
										role="button" title="Read"><span
										class="ui-button-icon-primary ui-icon ui-icon-search"></span><span
										class="ui-button-text">Read</span></a> ';
							}
							
							if($delete){
							echo '<a
										href="'.URL_ROOT.'/crud/dispatcher.php?delete&id='.$dt[$pk].'"
										class="button-delete ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only"
										role="button" title="Delete"><span
										class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span
										class="ui-button-text">Delete</span></a> ';
							}
			echo '</td>';
		}
		?>
	</tr>
	<?php
}
?>
</tbody>
