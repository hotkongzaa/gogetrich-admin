<thead>
    <tr class="ui-widget-header">
    <?php 
   
    $read   = (null==$actions)||!isset($actions['read'])||($actions['read']!==false);
    $update = (null==$actions)|| !isset($actions['update'])||($actions['update']!==false);	  
    $delete = (null==$actions)|| !isset($actions['delete'])||($actions['delete']!==false);
    	
    	foreach($columns as $index=>$col){  
    		//echo column only if it is not set to false
    		if(!isset($titleMap[$col['Field']])||$titleMap[$col['Field']]!==false){
    			//header text
    			echo '<th '.(isset($titleMap[$col['Field']])&&isset($titleMap[$col['Field']]['style'])?(' style="'.$titleMap[$col['Field']]['style'].'" '):'').
    			     	' class="ui-helper-reset ui-widget-header '.
    						((isset($titleMap[$col['Field']]['sort'])&&$titleMap[$col['Field']]['sort']==false)?' nosort':
    							((isset($order[$col['Field']])?($order[$col['Field']]):''))).
    						'" >';
    			
    			//input field name
    			echo '<input type="hidden" name="realName-'.$col['Field'].'" value="'.$col['Field'].'"/>';
    			//echo sort icon only if it is not set to false
    			if((!isset($titleMap[$col['Field']]['sort'])||$titleMap[$col['Field']]['sort']!=false)){
    				echo '<span style="float:right;" class="ui-helper-reset ';
    					if(isset($order[$col['Field']])!=false){
	    						switch (strtolower($order[$col['Field']])){
	    							case 'asc':
	    								echo 'ui-icon  ui-icon-triangle-1-n';
	    								break;
	    							case 'desc':		    								
	    								echo 'ui-icon  ui-icon-triangle-1-s';
	    								break;
	    							default:
	    								echo 'ui-icon  ui-icon-triangle-2-n-s';		    								
	    						}
	    				}else{
    							echo 'ui-icon  ui-icon-triangle-2-n-s';
    					}
    				echo '" ></span>';
    			}
    			echo (isset($titleMap[$col['Field']]['name'])?$titleMap[$col['Field']]['name']:$col['Field']);
    			echo '</th>';    	
    		}
    	}    		
    	if($read||$delete||$update){
    		?>
    			<th class="ui-widget-header nosort">
	                    Action
	            </th>    			
    		<?php 
    		
    	}
    ?>
    </tr>
    
    <!-- ********************************* SEARCHING ***************************************-->
    
    <?php 
    $search = '<tr>';
    $show = false;
    //print_r($titleMap);
    foreach($columns as $index=>$col){  
    		//echo column only if it is not set to false
    		if(!isset($titleMap[$col['Field']])||$titleMap[$col['Field']]!==false){
    			//header text
    			$search .= '<td class="ui-widget-content" >';
    			//echo sort icon only if it is not set to false
    			if((isset($titleMap[$col['Field']]['search'])&&$titleMap[$col['Field']]['search']!=false)){
    					$search .= '<input class="search" type="text" name="'.$col['Field'].'" />';
    					$show = true;
    			}
    			$search .= '</td>';    	
    		}
    } 
    $search .= '</tr>';
    if($show)echo $search;
    ?>
    
    
    
</thead>     