<?php
class Chapter3Controller extends Controller
{
    public function actionIndex() {
        $this->render("Index");
    }
    
    public function actionForm() {
        if(!empty($_POST)){
            echo "myinput = ".$_POST["myinput"];
        }
        $this->render("Form");
        
    }
    
    
    public function actionCal() {
        $x =0;
        $y =0;
        $result =0;
            if(!empty($_POST)){
                $x = $_POST["x"];
                $y = $_POST["y"];
                
                $result = $x+$y;
            }
            
        $this->render("Cal",array(
            "x" => $x,
            "y" => $y,
            "result" => $result
        ));
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

