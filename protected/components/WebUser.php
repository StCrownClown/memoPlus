<?php

// this file must be stored in:
// protected/components/WebUser.php

class WebUser extends CWebUser {

// Store model to not repeat query.
    private $_model;

// Return
// access it by Yii::app()->user->username
    function getUsername() {
        $user = $this->loadUser(Yii::app()->user->id);
        return $user->username;
    }

// access it by Yii::app()->user->email

// access it by Yii::app()->user->created
 


// access it by Yii::app()->user->usertype
    function getGroup() {
        $user = $this->loadUser(Yii::app()->user->id);
        $usertype = UserType::model()->findByPk($user->group);
        return $usertype->group;
    }

// This is a function that checks the field 'role'
// in the User model to be equal to 1, that means it's admin
// Yii::app()->user->isGuest
// Yii::app()->user->isAdmin()
// Yii::app()->user->isCustomer()
// Yii::app()->user->isAgent()
// Yii::app()->user->isEmployee()


    function isCustomer() {
        $user = $this->loadUser(Yii::app()->user->id);
        return intval($user->group) >= 1;
    }

    function isAgent() {
        $user = $this->loadUser(Yii::app()->user->id);
        return intval($user->group) >= 2;
    }

    function isUser() {
        $user = $this->loadUser(Yii::app()->user->id);
        return intval($user->group) >= 3;
    }

    function isAdmin() {
        $user = $this->loadUser(Yii::app()->user->id);
        return intval($user->group) >= 4;
    }

// Load user model.
    protected function loadUser($id = null) {
        if ($this->_model === null) {
            if ($id !== null):
                $this->_model = TblUser::model()->findByPk($id);
            else:
                $this->_model->group = 0;
            endif;
        }
        return $this->_model;
    }

}

?>