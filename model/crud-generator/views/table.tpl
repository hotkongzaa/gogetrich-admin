<script>
<?php 
echo 'URL_ROOT ="'.URL_ROOT.'";'; 
?>
</script>
<div id="crud-container">
	<table id="crud" class="ui-widget">
	    <?php 
	     include 'part_table_header.tpl';
		 include 'part_table_body.tpl';
		 include 'part_table_foot.tpl';
	    ?>
	</table> 
</div>