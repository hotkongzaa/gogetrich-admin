<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryService
 *
 * @author krisada.thiangtham
 */
class CategoryService {

    //put your code here
    private $dispatcher;

    public function __construct(CategoryDao $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    public function action($action) {
        $this->dispatcher->dispatch($action);
    }

    public function deleteCourseCategory($courseID) {
        return $this->dispatcher->deleteCourseCategory($courseID);
    }

    public function getAllCourseCategory() {
        return $this->dispatcher->getAllCourseCategory();
    }

    public function getCourseCategoryByID($courseID) {
        return $this->dispatcher->getCourseCategoryByID($courseID);
    }

    public function saveCourseCategory(\CategoryVO $obj) {
        return $this->dispatcher->saveCourseCategory($obj);
    }

    public function updateCourseCate(\CategoryVO $obj) {
        return $this->dispatcher->updateCourseCate($obj);
    }

}
