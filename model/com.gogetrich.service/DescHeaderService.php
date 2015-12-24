<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DescHeaderService
 *
 * @author krisada.thiangtham
 */
class DescHeaderService {

    //put your code here
    //put your code here
    private $dispatcher;

    public function __construct(DescHeaderDao $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function action($action) {
        $this->dispatcher->dispatch($action);
    }

    public function deleteDescHeaderByID($id) {
        return $this->dispatcher->deleteDescHeaderByID($id);
    }

    public function getAllDescHeader() {
        return $this->dispatcher->getAllDescHeader();
    }

    public function getDescHeaderByID($id) {
        return $this->dispatcher->getDescHeaderByID($id);
    }

    public function saveDescHeader(\DescHeaderVO $obj) {
        return $this->dispatcher->saveDescHeader($obj);
    }

    public function updateDescHeader(\DescHeaderVO $obj) {
        return $this->dispatcher->updateDescHeader($obj);
    }

    public function getLatestHeader() {
        return $this->dispatcher->getLatestHeader();
    }

}
