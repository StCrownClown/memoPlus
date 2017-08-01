<?php

class SiteController extends Controller {

    public function actions() {
        
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        Yii::app()->user->role = 'admin';
        var_dump(Yii::app()->user->role);
//        Yii::app()->user->id = $_SESSION['EMPLOYEEID'];
//        Yii::app()->user->name = $_SESSION['GIVENNAMEENGLISH'];
//        Yii::app()->user->surname = $_SESSION['FAMILYNAMEENGLISH'];
//        $model = new LoginForm;
//        $model->setlogin();
        $this->redirect(array('/FilesGen/let'));
//        renders the view file 'protected/views/site/index.php'
//        using the default layout 'protected/views/layouts/main.php'
//        $this->render('index');
//        $arr = Yii::app()->simplesamlphp->getAttributes();

        $name = $arr['GIVENNAMETHAI'][0] . ' ' . $arr['FAMILYNAMETHAI'][0];
//        $model = new LoginForm;
        $model->username = $arr['EMPLOYEEID'][0];
        $model->password = $arr['EMPLOYEEID'][0];
        Yii::app()->session['empName'] = $name;

//        if ($model->validate() && $model->login()){
//            if(Yii::app()->user->role == 'user'){
//                $this->redirect(array('/FilesGen/user_let'));
//            }else if(Yii::app()->user->role == 'admin'){
//                $this->redirect(array('/FilesGen/admin'));
//            }
//
//        }
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the contact page
     */
    public function actionContact() {
        $model = new ContactForm;
        
        if (isset($_POST['ContactForm'])) {
            $model->attributes = $_POST['ContactForm'];
            if ($model->validate()) {
                $name = '=?UTF-8?B?' . base64_encode($model->name) . '?=';
                $subject = '=?UTF-8?B?' . base64_encode($model->subject) . '?=';
                $headers = "From: $name <{$model->email}>\r\n" .
                        "Reply-To: {$model->email}\r\n" .
                        "MIME-Version: 1.0\r\n" .
                        "Content-Type: text/plain; charset=UTF-8";

                mail(Yii::app()->params['adminEmail'], $subject, $model->body, $headers);
                Yii::app()->user->setFlash('contact', 'Thank you for contacting us. We will respond to you as soon as possible.');
                $this->refresh();
            }
        }
        $this->render('contact', array('model' => $model));
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        if (!isset($_SESSION['EMPLOYEEID'])) {
            // Define SESSION for local devolopment. Change environment in \protected\config\main.php
            if (YII_ENV == 'dev') {
                $_SESSION['EMPLOYEEID'] = '901180';
                $_SESSION['GIVENNAMEENGLISH'] = 'Firstname';
                $_SESSION['FAMILYNAMEENGLISH'] = 'Lastname';
                $_SESSION['CENTERSHORTNAMETHAI'] = 'ศูนย์';
                $_SESSION['DIVISIONNAMETHAI'] = 'ฝ่าย';
                $_SESSION['DEPARTMENTNAMETHAI'] = 'งาน';
            } else {
                header('Location: https://app.biotec.or.th:444/memoplus/sso.php');
            }
            return;
        }

        // Get User Info From SSO and Insert into TblUser Table
        $UserID = $_SESSION['EMPLOYEEID'];
        $fullname = $_SESSION['GIVENNAMEENGLISH'] . ' ' . $_SESSION['FAMILYNAMEENGLISH'];
        $CENTERSHORTNAMETHAI = $_SESSION['CENTERSHORTNAMETHAI'];
        $DIVISIONNAMETHAI = $_SESSION['DIVISIONNAMETHAI'];
        $DEPARTMENTNAMETHAI = $_SESSION['DEPARTMENTNAMETHAI'];

        $modelTblUser = new TblUser;
        $FindUserID = $modelTblUser->findByAttributes(array('UserID' => $UserID));
        
        if ($FindUserID == null || empty($FindUserID)) {
            $modelTblUser->UserID = $UserID;
            $modelTblUser->fullname = $fullname;
            $modelTblUser->Center = $CENTERSHORTNAMETHAI;
            $modelTblUser->Division = $DIVISIONNAMETHAI;
            $modelTblUser->Department = $DEPARTMENTNAMETHAI;
            $modelTblUser->insert();
        } 
        else {
            $modelTblUser = $modelTblUser->findByAttributes(array('UserID' => $UserID));
            $modelTblUser->fullname = $fullname;
            $modelTblUser->Center = $CENTERSHORTNAMETHAI;
            $modelTblUser->Division = $DIVISIONNAMETHAI;
            $modelTblUser->Department = $DEPARTMENTNAMETHAI;
            $modelTblUser->update();
        }

        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login()) {
                if (Yii::app()->user->role == 'admin') {
                    $this->redirect(array('/FilesGen/let'));
                }
            }
//            $this->redirect(Yii::app()->user->returnUrl);
        }

        // display the login form
//        if (isset($_GET['u'])) {
//        	$this->render('login', array('model' => $model));
//        	return true;
//        }
        $model->username = $_SESSION['EMPLOYEEID'];
        $model->password = $_SESSION['EMPLOYEEID'];
        $model->login();
//        Yii::app()->user->role = 'user';
        $this->redirect(array('/FilesGen/let'));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        Yii::app()->session->destroy();

//        Yii::app()->request->redirect('https://i.nstda.or.th/c/portal/logout');
//        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
//        $this->redirect(array('site/logout2'));
    }

}
