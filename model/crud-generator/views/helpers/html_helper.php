<?php
/**
*@author  The-Di-Lab
*@email    thedilab@gmail.com
*@website http://www.the-di-lab.com
**/
class HtmlHelper {
    /*************** PROPERTY **********/
    
    
	/*************** PUBLIC METHODS **********/
	public function __constructor() {
		;
	}
	
	/*************** PRIVATE METHODS **********/
	public function input($keyValue,$type,$options=null){
		$key= array_keys($keyValue);
		$key=$key[0];		
		$value = array_values($keyValue);
		$value=$value[0];
	
		$type=trim($type);
		
		if(preg_match("/^int.*/", $type)){
			$type='int';
		}else if(preg_match("/^varchar.*/", $type)){
			$type='varchar';
		}else if(preg_match("/^tinyint\(1\).*/", $type)){ 
			$type='tinyint';
		}else if(preg_match("/^text.*/", $type)){
			$type='text';
		}
		
		return $this->_formInput($key,$value,$type,$options);
	}
	
	private function _formInput($name,$value,$type,$options){
		switch (strtolower($type)){
			case 'text':
				return $this->_textarea($name,$value,$options);
				break;
			case 'tinyint': 
				return $this->_checkbox($name,$value,$options);
				break;
			default:
				return $this->_input($name,$value,$options);				
		}
	}
	private function _checkbox($name,$value,$options){
		$extra = $value==1?'checked':'';
		$str  = '<input style="display:none" value=0 type=checkbox name="'.$name.'"'.' checked />';
		$str .= '<input value=1 type=checkbox name="'.$name.'"'.' id="crud-'.$name.'" '.$extra.' '.$options.' />';
		return $str;
	}
	
	private function _textarea($name,$value,$options){
		$str = '<textarea  name="'.$name.'"'.' id="crud-'.$name.'" '. $options.'>';
		$str.=$value.'</textarea>';
		return $str;
	}
	
	private function _input($name,$value,$options){
		return $str = '<input type=text name="'.$name.'"'.' id="crud-'.$name.'" value="'.$value.'"'.
		$options.' />';
	}
}