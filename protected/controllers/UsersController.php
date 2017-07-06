<?php

class UsersController extends Controller {

    public function actionRegister() {
        $model = new TblUser();

        if (isset($_POST['TblUser'])) {
            $model->attributes = $_POST['TblUser'];
            print_r($_POST['TblUser']);

            if ($model->save()) {
                $this->redirect(array('site/login'));
            }
        }
        $this->render('register', array('model' => $model));
    }


//    public function filters() {
//        return array(
//            'inlineFilterName',
//            array(
//                'class' => 'path.to.FilterClass',
//                'propertyName' => 'propertyValue',
//            ),
//        );
//    }
//
//    public function actions() {
//        return array(
//            'action1' => 'path.to.ActionClass',
//            'action2' => array(
//                'class' => 'path.to.AnotherActionClass',
//                'propertyName' => 'propertyValue',
//            ),
//        );
//    }

}
