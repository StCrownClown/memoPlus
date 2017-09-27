<?php
class Chapter2Controller extends Controller{
    
    public function actionHello($name){
        echo "Hello $name";
    }
    
    public function actionAddNumber($x,$y)
    {
        echo $x+$y;
    }
    
    public function actionBindView() {
        $this->render("BindView",array(
            "x"=>10,
            "y"=>15
            ));
    }
    
    public function actionShowImage() {
        $this->render("Showimg");
    }
    
    public function actionParamFromView($x = null) {
        echo "x=$x";
        $this->render("ParamFromView");
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

