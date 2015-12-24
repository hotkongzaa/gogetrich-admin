$(document).ready(function() {
	createUI();
	function createUI(){		
		//JQUERY UI table
		$("#crud tbody tr").hover(function() {
			$(this).children("td").addClass("ui-state-hover");
		}, function() {
			$(this).children("td").removeClass("ui-state-hover");
		});
		//Pager number
		$('#crud tfoot tr td.crud-pager a.crud-pager-number').button();
		$('#crud tfoot tr td.crud-pager span.disabled').button({
			disabled:true
		});		
	}
	
	//Refresh button
		$('a.button-refresh').live('click',function(e) {
			
			$.ajax({
				  url: $(this).attr('href'),
				  dataType: 'html',
				  type:'POST',
				  beforeSend : function(){					
				 		showOverLayer();		  
				  },
				  error: function(){
					    alert('Error whild loading data, please refresh and try again');
				  },
				  success: function(dt) {
					  $('#crud').find('thead,tbody,tfoot').remove();						
					  $('#crud').append(dt).fadeIn(function(){
					  	  hideOverLayer();
						  createUI();
					  }); 
				  }
			});
			
			return false;
	   });
		
	//Delete button
	   $('a.button-delete').live('click',function(e) {
		   if(confirm('Are you sure to delete it?')){			  
			   var thisA=this;			   
			   $.ajax({
					  url: $(this).attr('href'),
					  dataType: 'html',
					  type:'GET',
					  beforeSend : function(){					
					 		showOverLayer();		  
					  },
					  error: function(){
						    alert('Error whild loading data, please refresh and try again');
					  },
					  success: function(dt) {
						  if(true==dt){
							  $(thisA).parent('td').parent('tr').remove();
						  }
						  hideOverLayer();
					  }
				});
			   return false;
		   }			   
		   
		   return false;
	   });
	//Model iframe
		 $('a.button-update,a.button-read,a.button-create').live('click',function(e) {
	            e.preventDefault();
	            var $this = $(this);
	            var horizontalPadding = 30;
	            var verticalPadding = 30;
	            var frameWidth = 500;
	            var frameHeight = 200;
	            $('<iframe id="model" frameborder="0"  src="' + this.href + '" />').dialog({
	                title: ($this.attr('title')) ? $this.attr('title') : 'External Site',
	                autoOpen: true,
	                width: frameWidth,
	                height: frameHeight,
	                modal: true,
	                resizable: true,
	                autoResize: true,
	                overlay: {
	                    opacity: 0.5,
	                    background: "black"
	                }
	            }).width(frameWidth - horizontalPadding).height(frameHeight - verticalPadding);            
	      });	
	//Table sorting and pagination and searching
		    var orderBy={};
		    var overlayer = null;
		    var searchInterval=1000;
		    var singleSort = true;
		    
			createOverLayer();			
			
			//bind searching to searc fields
			var isSeaching = null;
			$('.search').live('keyup',function(){
				  if(isSeaching==null){
					  isSeaching = setTimeout(function() {
							var conditions= getSearchConditions();			
							loadData(null,{condition:conditions});
							isSeaching=null;
					   }, searchInterval);
				  }
				  
			});
			
			//bind sorting to table th
			$('#crud thead tr th:not([class~="nosort"])').live('click',function(){			
				var nameOfField =$(this).find('input').eq(0).val();				
				//get order para		
				//only one column sort
				if(singleSort){
					orderBy={};
				}				
				var name =nameOfField;		
				var val = ($(this).hasClass('asc'))?'desc':'asc';
				eval("orderBy."+name+"='"+val+"'");
				//conditons
				var conditions= getSearchConditions();		
				loadData(null,{order:orderBy,condition:conditions});
				//change sorting value AND //change sorting icon
				if(singleSort){
					$('#crud thead tr th:not([class~="nosort"])').find('span').addClass('ui-icon-triangle-2-n-s');
				}
				if(val=='asc'){
					$(this).removeClass('desc').addClass('asc');
					$(this).find('span').removeClass('ui-icon-triangle-1-s ui-icon-triangle-2-n-s').addClass('ui-icon-triangle-1-n');					
				}else{
					$(this).removeClass('asc').addClass('desc');
					$(this).find('span').eq(0).removeClass('ui-icon-triangle-1-n ui-icon-triangle-2-n-s').addClass('ui-icon-triangle-1-s');
				}
			});
			
			//bind paging to pager
			$('#crud tfoot tr td.crud-pager a').live('click',function(){	
				var conditions= getSearchConditions();
				loadData($(this).attr('title'),{order:orderBy,condition:conditions});
				return false;
			});			
						
			//load table data
			function loadData(postUrlData,data){
				var postUrl=URL_ROOT+'/crud/dispatcher.php?ajax_operation';
				if(null!=postUrlData){
					postUrl = postUrl+'&'+postUrlData;
				}
				
				$.ajax({
					  url: postUrl,
					  dataType: 'html',
					  type:'POST',
					  data: data,
					  beforeSend : function(){					
					 		showOverLayer();		  
					  },
					  error: function(){
						    alert('Error whild loading data, please refresh and try again');
					  },
					  success: function(dt) {
						  $('#crud').find('tbody,tfoot').remove();						
						  $('#crud').append(dt).fadeIn(function(){
						  	  hideOverLayer();
							  createUI();
						  }); 
					  }
				});
			}	
			
			//function get Search conditions
			function getSearchConditions(){
				var searchFields= $('.search');
				var conditions={};
				$.each(searchFields,function(index,value){
					if($(value).val()!=''){							
						var name = $(value).attr('name');
						var val =  $(value).val();
						val = escapeQuotes(val);
						eval("conditions."+name+"='"+val+"'");
					}			
				});	
				return conditions;
			}
			
			
			//create an overlayer,but don't display it
			function createOverLayer(){
				overlayer =document.createElement('div');
				$(overlayer).css({
			      position:'absolute', 
			      opacity: 0.5,
			      top: '0',
			      left: '0',
			      id:'overlayer',
			      zIndex:9999,
			      display:'none'
			    });				 
				$(overlayer).addClass('ui-widget-overlay')
			    loader = document.createElement('img');
			    $(loader).attr('src',URL_ROOT+'/crud/webroot/img/loader.gif').css({
			    	position:'absolute',
			    	top: '50%',
			    	zIndex:9999
			    });			    
			    $(overlayer).append(loader);	    
			    $('#crud').parent().append(overlayer);
			}			
			//display an overlayer
			function showOverLayer(){
				if($('#crud').height()!=0){
					$(overlayer).css({
						height: $('#crud').height(),
						width: $('#crud').width(),
						display: 'block'
					});
					$(loader).css({
						width:'32px',
						height:'32px',
						left: ($('#crud').width()-$(loader).width())/2,
						dislay: 'block'
					  }	
					)
				}				
			}			
			//hide the overlayer
			function hideOverLayer(){
				$(overlayer).fadeOut();
			}
			
			function escapeQuotes(string){
				return string.replace('"', "&quot;")&&string.replace("'", "&#39;");
			}
});