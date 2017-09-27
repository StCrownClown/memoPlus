<?php

class Files_GenController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

	
    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new Files_Gen;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Files_Gen'])) {

            $dir = Yii::getPathOfAlias('webroot.myfile');
            $Attach = CUploadedFile::getInstance($model, 'FilesName');

            $model->attributes = $_POST['Files_Gen'];

            if ($model->save()) {

				if ($Attach != '') {
					$model->FilesName = $model->FilesID.'.docx';
					$model->save();
					//$newName1 = $Attach->getName();
					$Attach->saveAs($dir . DIRECTORY_SEPARATOR . $model->FilesName);

					Yii::import('ext.phpword.samples.Sample_Header', true);
					$phpWord = \PhpOffice\PhpWord\IOFactory::load(Yii::getPathOfAlias('webroot.myfile').'\\' . $model->FilesID.'.docx');
					$phpWord->save(Yii::getPathOfAlias('webroot.myfile').'/' . $model->FilesID . '.html', 'HTML');
					
					$model->ConvertTag2Html($model->FilesID);
				}			

				$this->redirect(array('view', 'id' => $model->FilesID));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $flag = FALSE;
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['Files_Gen'])) {
            $dir = "myfile";
            $Attach = CUploadedFile::getInstance($model, 'FilesName');
            if ($Attach != '') {
				$Attach->saveAs($dir . DIRECTORY_SEPARATOR . $model->FilesID.'.docx');
				
				if ($_POST["Files_Gen"]['chkOverwrite']=='1') {}
				else {
					Yii::import('ext.phpword.samples.Sample_Header', true);
					$phpWord = \PhpOffice\PhpWord\IOFactory::load(Yii::getPathOfAlias('webroot.myfile').'/' . $model->FilesID.'.docx');
					$phpWord->save(Yii::getPathOfAlias('webroot.myfile').'/' . $model->FilesID . '.html', 'HTML');
					
					$model->ConvertTag2Html($model->FilesID);
				}

				
                if ($model->update(array('FilesName'))) {
                    $flag = TRUE;
                }
            }

            if ($_POST['Files_Gen']['Name'] != '') {
                $name = $_POST['Files_Gen']['Name'];
                $model->Name = $name;
                if ($model->update(array('Name'))) {
                    if (!empty($model->html)) {
                        //rename("myfile/" . $model->html, "myfile/" . $name . ".html");
                         $model->html = $name.".html";
                        //$model->html = "";
                        if ($model->update(array('html')))
                            ;
                    }
                    $flag = TRUE;
                }
            }
            if ($flag == TRUE)
                $this->redirect(array('view', 'id' => $model->FilesID));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
		if (Yii::app()->user->role == 'user') {
			return false;
		}
		
        unlink(Yii::getPathOfAlias('webroot.myfile').'/' . $id . '.html');
        unlink(Yii::getPathOfAlias('webroot.myfile').'/' . $id . '_edit.html');
		unlink(Yii::getPathOfAlias('webroot.myfile').'/' . $id . '.docx');
        $this->loadModel($id)->delete();
		

        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new Files_Gen('search');
        $model->unsetAttributes();  // clear any default values

        $dataProvider = new CActiveDataProvider('Files_Gen');

        if (isset($_GET['Files_Gen']))
            $model->attributes = $_GET['Files_Gen'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {

		$model = new Files_Gen('search');

        $model->unsetAttributes();  // clear any default values
//        $test = new CActiveDataProvider($model, array(
//            "pagination" => array("pageSize" => 3)
//        ));
        if (isset($_GET['Files_Gen']))
            $model->attributes = $_GET['Files_Gen'];

        $this->render('admin', array(
            'model' => $model//, 'test' => $test
        ));
    }

    public function actionLet() {
        $model = new Files_Gen('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Files_Gen']))
            $model->attributes = $_GET['Files_Gen'];
        $this->render('let', array(
            'model' => $model
        ));
    }

    public function actionMemo() {
        $model = new Files_Gen('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Files_Gen']))
            $model->attributes = $_GET['Files_Gen'];
        $this->render('memo', array(
            'model' => $model
        ));
    }
    
    public function actionLet_eng() {
    	$model = new Files_Gen('search');
    	$model->unsetAttributes();  // clear any default values
    
    	if (isset($_GET['Files_Gen']))
    		$model->attributes = $_GET['Files_Gen'];
    	$this->render('let_eng', array(
    			'model' => $model
    	));
    }
    
    public function actionMemo_eng() {
    	$model = new Files_Gen('search');
    	$model->unsetAttributes();  // clear any default values
    
    	if (isset($_GET['Files_Gen']))
    		$model->attributes = $_GET['Files_Gen'];
    	$this->render('memo_eng', array(
    			'model' => $model
    	));
    }

    public function actionUser_let() {
        $model = new Files_Gen('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Files_Gen']))
            $model->attributes = $_GET['Files_Gen'];
        $this->render('user_let', array(
            'model' => $model
        ));
    }

    public function actionUser_memo() {
        $model = new Files_Gen('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['Files_Gen']))
            $model->attributes = $_GET['Files_Gen'];
        $this->render('user_memo', array(
            'model' => $model
        ));
    }
    
    public function actionLast_select() {
        
        $model = new Savefile;
		//::model()->findAllByAttributes(array('UserID' => 1));
       //$test = array();
       
        //for($i=0;$i<sizeof($model1);$i++)
        //{
        //   $test[$i]=$model1[$i]->FilesID;
        //}

//        $model = new Files_Gen();
//        $Criteria = new CDbCriteria();
//        $Criteria->addInCondition("FilesID", $test);

        $this->render('last_select', array(
            'model' => $model
        ));
    }
    


    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer $id the ID of the model to be loaded
     * @return Files_Gen the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = Files_Gen::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param Files_Gen $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'files--gen-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
