<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DescHeaderDao
 *
 * @author krisada.thiangtham
 */
interface DescHeaderDao {

    //put your code here
    public function getAllDescHeader();

    public function saveDescHeader(DescHeaderVO $obj);

    public function getDescHeaderByID($id);

    public function deleteDescHeaderByID($id);

    public function updateDescHeader(DescHeaderVO $obj);
    
    public function getLatestHeader();
}
