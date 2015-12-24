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
class CustomerVO {

    private $cusID;
    private $cusUsername;
    private $cusPassword;
    private $cusEmail;
    private $cusFirstName;
    private $cusLastName;
    private $cusGender;
    private $cusContactAddr;
    private $cusReceiptAddr;
    private $phoneNumber;
    private $cusFacebookAddr;
    private $cusCreatedDateTime;

    function getCusID() {
        return $this->cusID;
    }

    function getCusUsername() {
        return $this->cusUsername;
    }

    function getCusPassword() {
        return $this->cusPassword;
    }

    function getCusEmail() {
        return $this->cusEmail;
    }

    function getCusFirstName() {
        return $this->cusFirstName;
    }

    function getCusLastName() {
        return $this->cusLastName;
    }

    function getCusGender() {
        return $this->cusGender;
    }

    function getCusContactAddr() {
        return $this->cusContactAddr;
    }

    function getCusReceiptAddr() {
        return $this->cusReceiptAddr;
    }

    function getPhoneNumber() {
        return $this->phoneNumber;
    }

    function getCusFacebookAddr() {
        return $this->cusFacebookAddr;
    }

    function setCusID($cusID) {
        $this->cusID = $cusID;
    }

    function setCusUsername($cusUsername) {
        $this->cusUsername = $cusUsername;
    }

    function setCusPassword($cusPassword) {
        $this->cusPassword = $cusPassword;
    }

    function setCusEmail($cusEmail) {
        $this->cusEmail = $cusEmail;
    }

    function setCusFirstName($cusFirstName) {
        $this->cusFirstName = $cusFirstName;
    }

    function setCusLastName($cusLastName) {
        $this->cusLastName = $cusLastName;
    }

    function setCusGender($cusGender) {
        $this->cusGender = $cusGender;
    }

    function setCusContactAddr($cusContactAddr) {
        $this->cusContactAddr = $cusContactAddr;
    }

    function setCusReceiptAddr($cusReceiptAddr) {
        $this->cusReceiptAddr = $cusReceiptAddr;
    }

    function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    function setCusFacebookAddr($cusFacebookAddr) {
        $this->cusFacebookAddr = $cusFacebookAddr;
    }
    function getCusCreatedDateTime() {
        return $this->cusCreatedDateTime;
    }

    function setCusCreatedDateTime($cusCreatedDateTime) {
        $this->cusCreatedDateTime = $cusCreatedDateTime;
    }


}
