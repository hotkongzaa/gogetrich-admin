<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerRegistrationService
 *
 * @author krisada.thiangtham
 */
class CustomerRegistrationService {

    //put your code here
    public function __construct() {
        
    }

    public function findCustomerRegistrationDetailByCusId($cusId) {
        $sql = "SELECT * FROM RICH_CUSTOMER WHERE CUS_ID ='" . $cusId . "'";
        $res = mysql_query($sql);
        return $this->returnFunctionAsJson($res);
    }

    public function deleteCustomerDetailByCusId($cusId) {
        $query = "DELETE FROM RICH_CUSTOMER WHERE CUS_ID ='" . $cusId . "'";
        $res = mysql_query($query);
        return $this->returnFunctionAsCode($res);
    }

    public function updateCustomerDetail(Object... $str) {
        $query = "UPDATE RICH_CUSTOMER SET ";
    }

    private function returnFunctionAsJson($arrayQueryResult) {
        if ($arrayQueryResult) {
            $row = mysql_fetch_array($arrayQueryResult);
            return json_encode($row);
        } else {
            return mysql_error();
        }
    }

    private function returnFunctionAsCode($arrayQueryResult) {
        if ($arrayQueryResult) {
            return 200;
        } else {
            return mysql_error();
        }
    }

    public function getStringValueFromReq($msg) {
        return (string) filter_input(INPUT_GET, $msg);
    }

}
