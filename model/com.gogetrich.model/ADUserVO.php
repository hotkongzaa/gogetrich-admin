<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BillingVO
 *
 * @author krisada.thiangtham
 */
class ADUserVO {

    private $adId;
    private $adUsername;
    private $adPassword;
    private $adEmail;
    private $adFirstName;
    private $adLastName;
    private $adPhoneNumber;
    private $adCreatedDateTime;

    function getAdId() {
        return $this->adId;
    }

    function getAdUsername() {
        return $this->adUsername;
    }

    function getAdPassword() {
        return $this->adPassword;
    }

    function getAdEmail() {
        return $this->adEmail;
    }

    function getAdFirstName() {
        return $this->adFirstName;
    }

    function getAdLastName() {
        return $this->adLastName;
    }

    function getAdPhoneNumber() {
        return $this->adPhoneNumber;
    }

    function getAdCreatedDateTime() {
        return $this->adCreatedDateTime;
    }

    function setAdId($adId) {
        $this->adId = $adId;
    }

    function setAdUsername($adUsername) {
        $this->adUsername = $adUsername;
    }

    function setAdPassword($adPassword) {
        $this->adPassword = $adPassword;
    }

    function setAdEmail($adEmail) {
        $this->adEmail = $adEmail;
    }

    function setAdFirstName($adFirstName) {
        $this->adFirstName = $adFirstName;
    }

    function setAdLastName($adLastName) {
        $this->adLastName = $adLastName;
    }

    function setAdPhoneNumber($adPhoneNumber) {
        $this->adPhoneNumber = $adPhoneNumber;
    }

    function setAdCreatedDateTime($adCreatedDateTime) {
        $this->adCreatedDateTime = $adCreatedDateTime;
    }

}
