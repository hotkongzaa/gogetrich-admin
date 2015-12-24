<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerDao
 *
 * @author krisada.thiangtham
 */
interface ADUserCredentialDao {

    //put your code here
    public function saveAdUser(ADUserVO $adUserVO);

    public function editAdUser(ADUserVO $adUserVO);

    public function deleteAdUserByID($cusID);

    public function getAdUserById($cusID);

    public function verfyAdUsernameAndPassword($username, $password);

    public function getAllRegisteredUser($row);
}
