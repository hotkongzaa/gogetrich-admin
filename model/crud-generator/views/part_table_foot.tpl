    <!-------------------------------------------FOOTER ------------------------------------>
    <tfoot>
    	<tr>
    		<?php if($create){?>
    		<td  class="crud-create">
     			<a
				href="<?php echo URL_ROOT.'/crud/dispatcher.php?create';?>"
				class="button-create ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only"
				role="button" title="Create"><span
				class="ui-button-icon-primary ui-icon ui-icon-plusthick"></span><span
				class="ui-button-text">Create</span></a>
				<a
				href="<?php echo URL_ROOT.'/crud/dispatcher.php?ajax_table';?>"
				class="button-refresh ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only"
				role="button" title="Refresh"><span
				class="ui-button-icon-primary ui-icon ui-icon-arrowrefresh-1-w"></span><span
				class="ui-button-text">Refresh</span></a>
    		</td>
    		<?php }?>
    		
    		<td class="crud-pager" colspan="<?php echo (intval($showColumns)-($create?1:0)+intval(($read||$delete||$update)?1:0));?>">
    			<?php 
    			  $total =$total[0]['total'];
		          echo '<span >Total records: '.$total.'</span> ';
		          
		          $allPages = intval($total/$perPage)+(($total%$perPage==0)?0:1);
		          $max=3;
		         
		          if($currentPage>1){
		          		echo '<a class="crud-pager-number" href="#" title="current_page='.($currentPage-1).'">prev</a>';
		          }else{
		          		echo '<span class="disabled">prev</span>';
		          }
		          
		          $count=1;
		          for($i=($currentPage!=1?$currentPage-1:$currentPage);($i<=$allPages)&&($count<=$max);$i++){
			          if($i==$currentPage){
			          	echo '<span class="disabled">'.$i.'</span>';
			          }else{
			          	echo '<a class="crud-pager-number" href="#" title="current_page='.$i.'">'.$i.'</a>';
			          }
			          $count++;
		          }
		          
		          if(($currentPage)<$allPages){
		          		echo '<a class="crud-pager-number" href="#" title="current_page='.($currentPage+1).'">next</a>';
		          }else{
		          		echo '<span class="disabled">next</span>';
		          }
          		?>
    		</td>
    	</tr>
    </tfoot>