<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ArrayList
 *
 * @author krisada.thiangtham
 */
class ArrayList {

    private $list = array();
    public function __construct() {
        
    }
    public function Add($obj) {
        array_push($this->list, $obj);
    }

    public function Remove($key) {
        if (array_key_exists($key, $this->list)) {
            unset($this->list[$key]);
        }
    }

    public function Size() {
        return count($this->list);
    }

    public function IsEmpty() {
        return empty($this->list);
    }

    public function GetObj($key) {
        if (array_key_exists($key, $this->list)) {
            return $this->list[$key];
        } else {
            return NULL;
        }
    }

    public function GetKey($obj) {
        $arrKeys = array_keys($this->list, $obj);

        if (empty($arrKeys)) {
            return -1;
        } else {
            return $arrKeys[0];
        }
    }

}
