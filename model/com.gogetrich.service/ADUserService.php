<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerService
 *
 * @author krisada.thiangtham
 */
class ADUserService {

    //put your code here
    //put your code here
    private $dispatcher;

    public function __construct(ADUserCredentialDao $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function action($action) {
        $this->dispatcher->dispatch($action);
    }

    public function deleteAdUserByID($cusID) {
        return $this->dispatcher->deleteAdUserByID($cusID);
    }

    public function editAdUser(\ADUserVO $adUserVO) {
        return $this->dispatcher->editAdUser($adUserVO);
    }

    public function getAdUserById($cusID) {
        return $this->dispatcher->getAdUserById($cusID);
    }

    public function saveAdUser(\ADUserVO $adUserVO) {
        return $this->dispatcher->saveAdUser($adUserVO);
    }

    public function verfyAdUsernameAndPassword($username, $password) {
        return $this->dispatcher->verfyAdUsernameAndPassword($username, $password);
    }

    public function getAllRegisteredUser($row) {
        return $this->dispatcher->getAllRegisteredUser($row);
    }

}
