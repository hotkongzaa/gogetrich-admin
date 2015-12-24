<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VerifySessionTimeOutClass
 *
 * @author krisada.thiangtham
 */
class VerifySessionTimeOutClass {

    public $sessiongExpire;

    public function getSessiongExpire() {
        return session_cache_expire($this->sessiongExpire);
    }

    public function setSessiongExpire($sessiongExpire) {
        $this->sessiongExpire = $sessiongExpire;
    }

}
