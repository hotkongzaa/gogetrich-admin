<?php
class GridController {
	private $grid;
	private $tableTpl;
	
	public function __construct() {
		include ROOT.'/models/grid.php';
		$this->grid = new Grid();	

		$this->tableTpl=ROOT.'/views/table.tpl';
		$this->deleteTpl=ROOT.'/views/delete.tpl';
		$this->readTpl=ROOT.'/views/read.tpl';
		$this->updateTpl=ROOT.'/views/update.tpl';
		$this->createTpl=ROOT.'/views/create.tpl';
		$this->ajaxTableTpl=ROOT.'/views/ajax_table.tpl';
		$this->ajaxOperationTpl=ROOT.'/views/ajax_operation.tpl';
	}
	
	//this handls ajax sort, search and pagination
	public function ajax_operation(){
		//setting from grid object
		$table    = $_SESSION['crud_table'];
		$titleMap = $_SESSION['crud_title_map'];
		$perPage = $_SESSION['crud_per_page'];
		$actions  = $_SESSION['crud_actions'];
		$pk = $_SESSION['crud_primary_key'];
		$order = (isset($_POST['order'])&&null!=$_POST['order'])?$_POST['order']:null;		
		$condition = (isset($_POST['condition'])&&null!=$_POST['condition'])?$_POST['condition']:null;		
		$currentPage = isset($_GET['current_page'])?intval($_GET['current_page']):1;
		
		//data from model
		$columns = $this->grid->getColumns($table);
		$data = $this->grid->getData($table,$order,$currentPage,$perPage,$condition);
		$total = $this->grid->getTotal($table,$condition);
		
		//render view
		$this->_render(compact('columns','data','total','titleMap','actions','pk',
								'currentPage','perPage','order'),
					   $this->ajaxOperationTpl);
		
	}	
	
	public function ajax_table(){
		//setting from grid object
		$table    = $_SESSION['crud_table'];
		$titleMap = $_SESSION['crud_title_map'];
		$perPage = $_SESSION['crud_per_page'];
		$actions  = $_SESSION['crud_actions'];
		$pk = $_SESSION['crud_primary_key'];
		$order = (isset($_POST['order'])&&null!=$_POST['order'])?$_POST['order']:null;
		$currentPage = isset($_GET['current_page'])?intval($_GET['current_page']):1;
		
		//data from model
		$columns = $this->grid->getColumns($table);
		$data = $this->grid->getData($table,$order,$currentPage,$perPage);
		$total = $this->grid->getTotal($table);
		
		//render view
		$this->_render(compact('columns','data','total','titleMap','actions','pk',
								'currentPage','perPage','order'),
					   $this->ajaxTableTpl);
	}
	
	public function table(){
		//setting from grid object
		$table    = $_SESSION['crud_table'];
		$titleMap = $_SESSION['crud_title_map'];
		$perPage = $_SESSION['crud_per_page'];
		$actions  = $_SESSION['crud_actions'];
		$pk = $_SESSION['crud_primary_key'];
		$order =array($pk=>'desc');
		
		$currentPage = isset($_GET['current_page'])?$_GET['current_page']:1;
		
		
		//data from model
		$columns = $this->grid->getColumns($table);
		$data = $this->grid->getData($table,$order,$currentPage,$perPage);
		$total = $this->grid->getTotal($table);
		
		//render view
		$this->_render(compact('columns','data','total','titleMap','actions','pk',
								'currentPage','perPage','order'),
					   $this->tableTpl);
	}
	
	public function create(){
		//setting from grid object
		$table  = $_SESSION['crud_table'];
		$pk = $_SESSION['crud_primary_key'];
		$titleMap = isset( $_SESSION['crud_title_map'])? $_SESSION['crud_title_map']:null;
		$create = false;
		
		if(!empty($_POST)){
			$create = $this->grid->create($table,$_POST);
		}
		//data from model
		$columns = $this->grid->getColumns($table);
		
		//render view
		$this->_render(compact('columns','titleMap',
								'pk','create'),
					   $this->createTpl);
	}
	
	public function read(){
		//setting from grid object
		$table  = $_SESSION['crud_table'];
		$id = $_GET['id'];
		$pk = $_SESSION['crud_primary_key'];
		$titleMap = isset( $_SESSION['crud_title_map'])? $_SESSION['crud_title_map']:null;
		
		
		//data from model
		$data = $this->grid->getRow($table,array($pk=>$id));
		$columns = $this->grid->getColumns($table);
		
		//render view
		$this->_render(compact('data','titleMap','columns'),$this->readTpl);
	}
	
	public function update(){
		//setting from grid object
		$table  = $_SESSION['crud_table'];
		$id = $_GET['id'];
		$pk = $_SESSION['crud_primary_key'];
		$titleMap = isset( $_SESSION['crud_title_map'])? $_SESSION['crud_title_map']:null;
		$update = false;
		
		if(!empty($_POST)){
			$update = $this->grid->update($table,$pk,$_POST);
		}
		//data from model
		$data = $this->grid->getRow($table,array($pk=>$id));
		$columns = $this->grid->getColumns($table);
		
		//render view
		$this->_render(compact('data','titleMap','id','pk','update','columns'),$this->updateTpl);
	}
	
	public function delete(){
		$table  = $_SESSION['crud_table'];
		$pk = $_SESSION['crud_primary_key'];
		$id = $_GET['id'];
		
		$result=$this->grid->delete($table,$pk,$id);
		$this->_render(compact('result'),$this->deleteTpl);
	}
	
  	/*
  	 * this is a simple template function,
  	 * it renders the template file located at "tpl" folder.
  	 * it is called by renderTable and renderPager with two different template files.
  	 */
  	private function _render($viewData,$tpl){ 
		ob_start();
			extract($viewData);
	    	include($tpl);		
	    echo ob_get_clean();
	}
}