<?php

class Chapter5Controller extends Controller
{
    public function actionCGridView() {
            $model = new Files_Gen();
            $files = new CActiveDataProvider($model);
            
            $this->render("CGridView",array(
                "files" => $files
            ));               
    }
    
    function actionForm($FilesID = null){
        $files = new Files_Gen();    
        //save
        if(!empty($_POST)){
            $FilesID = $_POST["Files_Gen"]["FilesID"];
            
                if(!empty($FilesID)){
                    $files = Files_Gen::model()->findByPk($FilesID);

                }
            
                    $files->_attributes = $_POST["Files_Gen"];
            
            if($files->save()){
                $this->redirect(array("CGridView"));
            }
        }
        
        if(!empty($FilesID)and $FilesID!=NULL){
            $files = Files_Gen::model()->findByPK($FilesID);
        }
        $this->render("Form",array(
            "files"=>$files
        ));
    }
    


  
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

