<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DescHeaderVO
 *
 * @author krisada.thiangtham
 */
class DescHeaderVO {

    //put your code here
    private $descHeaderName;
    private $descHeaderID;
    private $descHeaderCreatedDateTime;

    function getDescHeaderName() {
        return $this->descHeaderName;
    }

    function getDescHeaderID() {
        return $this->descHeaderID;
    }

    function getDescHeaderCreatedDateTime() {
        return $this->descHeaderCreatedDateTime;
    }

    function setDescHeaderName($descHeaderName) {
        $this->descHeaderName = $descHeaderName;
    }

    function setDescHeaderID($descHeaderID) {
        $this->descHeaderID = $descHeaderID;
    }

    function setDescHeaderCreatedDateTime($descHeaderCreatedDateTime) {
        $this->descHeaderCreatedDateTime = $descHeaderCreatedDateTime;
    }

}
