<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
private $_id;
    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {

//Yii::app()->simplesamlphp->requireAuth();
//$this->redirect(array('/filesgen/let'));
//die();
        $username = strtolower($_SESSION['EMPLOYEEID']);
        //$user = TblUser::model()->find(array(
        //    'select'=>"username",
        //    'condition'=>"username=:username",
        //    'params'=>array(':username'=>$username),
        //));

        if (in_array($username, Yii::app()->params['admingroup'])) {
            $role = 'admin';
        }else {
            $role = 'user';
        }
        $this->_id = $_SESSION['EMPLOYEEID'];
        $this->username = $role;
        $this->errorCode = self::ERROR_NONE;
        $this->setState('role', $role);
        
        return $this->errorCode == self::ERROR_NONE;
    }

    public function getId() {
        return $this->_id;
    }

}
