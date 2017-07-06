<?php

class Files extends CActiveRecord{
    public static function model($className = __CLASS__) {
        parent::model($className);
    }
    public function tableName() {
        return "files";
    }
    public function attributeLabels() {
        return array(
            "FilesID" => "ไฟล์ไอดี",
            "Name" => "ชื่อ",
            "FilesName" => "ชื่อไฟล์"
        );
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

