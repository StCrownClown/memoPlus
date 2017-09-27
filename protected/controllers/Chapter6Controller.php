<?php

class Chapter6Controller extends Controller

{
    function actionCPageSize()
    {
    $model = new Files();
    
    $files = new CActiveDataProvider($model,array(
        "pagination" => array(
            "pageSize"=>8
            )
    ));
    //render
    $this->render("CPageSize",array(
        "files"=>$files
        ));
    }
    
    function actionCSort(){
    $model = new Files();
    
    $criteria = new CDbCriteria();
    $criteria->order = "FilesID DESC";
    
    $files = new CActiveDataProvider($model,array(
        "criteria" => $criteria
    ));
    //render
    $this->render("CSort",array(
        "files"=>$files
        )); 
    }
}
/*         "pagination" => array(
            "pageSize"=>8
            ),
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

