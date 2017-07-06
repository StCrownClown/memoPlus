<?php
class AccessRulesManager // 2.0
{
	/*
		*: any user, including both anonymous and authenticated users.
		?: anonymous users.
		@: authenticated users.
	*/
	public $controller;
	
	public function checkRules()
	{
        $access = Yii::app()->params['accessRules'];
        if(isset($access[$this->controller])){
            return $access[$this->controller];
        }else{
            return array(
                array('allow',
                    'users'=>array('@'),
                ),

                array('deny'),
            );
        }
	}
}
