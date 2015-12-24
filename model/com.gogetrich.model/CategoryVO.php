<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryVO
 *
 * @author krisada.thiangtham
 */
class CategoryVO {

    //put your code here
    private $cateID;
    private $cateName;
    private $cateDate;

    function getCateID() {
        return $this->cateID;
    }

    function getCateName() {
        return $this->cateName;
    }

    function getCateDate() {
        return $this->cateDate;
    }

    function setCateID($cateID) {
        $this->cateID = $cateID;
    }

    function setCateName($cateName) {
        $this->cateName = $cateName;
    }

    function setCateDate($cateDate) {
        $this->cateDate = $cateDate;
    }

}
