<?php
class GridObject {
	/********************* PROPERTY ********************/
	
	
    /********************* CONSTRUCTOR ********************/
	public function __construct(){
		session_start();
		$_SESSION['crud_table'] = null;
		$_SESSION['crud_title_map'] = null;
		$_SESSION['crud_actions'] = null;
		$_SESSION['crud_primary_key']='id';
		$_SESSION['crud_per_page']=10;
	}
	
	
	/********************* PUBLIC METHODS ********************/	
	public function setDbTable($table){
		$_SESSION['crud_table'] = $table;
	}
	
	public function setTitle($map){
		$_SESSION['crud_title_map'] = $map;
	} 
	
	public function setActions($actions){
		$_SESSION['crud_actions'] = $actions;
	}
	
	public function setPrimaryKey($primaryId) {
		$_SESSION['crud_primary_key']=$primaryId;
	}
	
	public function setPerPage($number){
		$_SESSION['crud_per_page']=$number;
	}
	
	public function render() {
		include 'dispatcher.php';
	}
}