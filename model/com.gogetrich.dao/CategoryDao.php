<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CategoryDao
 *
 * @author krisada.thiangtham
 */
interface CategoryDao {

    //put your code here

    public function getAllCourseCategory();

    public function saveCourseCategory(CategoryVO $obj);

    public function deleteCourseCategory($courseID);

    public function getCourseCategoryByID($courseID);

    public function updateCourseCate(CategoryVO $obj);
}
