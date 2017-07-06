<?php

require_once Yii::getPathOfAlias('webroot.protected.extensions') . '/phpoffice/phpword/src/PhpWord/Autoloader.php';

class FilesGenController extends Controller {

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
        $model = new FilesGen;
        
        $dir = Yii::getPathOfAlias('webroot.myfile');
        $Attach = CUploadedFile::getInstance($model, 'FilesName');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FilesGen'])) {

            $model->attributes = $_POST['FilesGen'];

            if ($model->save()) {

                if ($Attach != '') {
                    $model->FilesName = $model->FilesID . '.docx';
//                    $model->save();
                    //$newName1 = $Attach->getName();
                    $Attach->saveAs($dir . DIRECTORY_SEPARATOR . $model->FilesName);

                    Yii::import('ext.phpoffice.phpword.samples.memoPlusFontStyle', true);
                    
                    $phpWord = new \PhpOffice\PhpWord\PhpWord();
                    
                    $fontStyleName = 'rStyle';
                    $phpWord->addFontStyle($fontStyleName, array('bold' => true, 'italic' => true, 'size' => 16, 'allCaps' => true, 'doubleStrikethrough' => true));

                    $paragraphStyleName = 'pStyle';
                    $phpWord->addParagraphStyle($paragraphStyleName, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

                    $rightTabStyleName = 'rightTab';
                    $phpWord->addParagraphStyle($rightTabStyleName, array('tabs' => array(new \PhpOffice\PhpWord\Style\Tab('right', 9090))));

                    $leftTabStyleName = 'centerTab';
                    $phpWord->addParagraphStyle($leftTabStyleName, array('tabs' => array(new \PhpOffice\PhpWord\Style\Tab('center', 4680))));

                    $boldFontStyleName = 'BoldText';
                    $phpWord->addFontStyle($boldFontStyleName, array('bold' => true));

                    $coloredFontStyleName = 'ColoredText';
                    $phpWord->addFontStyle($coloredFontStyleName, array('color' => 'FF8080', 'bgColor' => 'FFFFCC'));
                    
                    $multipleTabsStyleName = 'multipleTab';
                    $phpWord->addParagraphStyle(
                        $multipleTabsStyleName,
                        array(
                            'tabs' => array(
                                new \PhpOffice\PhpWord\Style\Tab('left', 1550),
                                new \PhpOffice\PhpWord\Style\Tab('center', 3200),
                                new \PhpOffice\PhpWord\Style\Tab('right', 5300),
                            )
                        )
                    );

                    $phpWord->addTitleStyle(1, array('bold' => true), array('spaceAfter' => 240));
                    $phpWord->addFontStyle('rStyle', array('bold' => true, 'italic' => true, 'size' => 16, 'allCaps' => true, 'doubleStrikethrough' => true));
                    $phpWord->addParagraphStyle('pStyle', array('align' => 'center', 'spaceAfter' => 100));
                    $phpWord->addTitleStyle(1, array('bold' => true), array('spaceAfter' => 240));
                    $phpWord->setDefaultFontName('Times New Roman');
                    $phpWord->setDefaultFontSize(20);
                    $phpWord->getDocInfo();

                    $phpWord = \PhpOffice\PhpWord\IOFactory::load($dir . '\\' . $model->FilesID . '.docx');
                    $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
                    $objWriter->save($dir . '/' . $model->FilesID . '.html', 'HTML');
                    
                    
                    $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($dir . '\\' . $model->FilesID . '.docx');
                    $search_replace_array = array(
                        'Value'=>'PHP', #inside a MS Word file ${msword_hello} will change to Hello
                        'Select'=>'Hello', #${msword_world} will change to World
                        'Date'=>'World'
                    );
                    $templateProcessor->setValueAdvanced($search_replace_array);
                    $templateProcessor->saveAs($dir . '/' . $model->FilesID . '_new.html');
                    

//                    echo '<pre>' . print_r($objWriter, true) . '</pre>';die;
                        
//                    $html = "myfile/" . $model->FilesID . ".html";
//                    $place_holder = '/<p>|<\/p>|\r|\n/';
//                    $handle_file = fopen($html, "r");
//
//                    $find_pattern = fread($handle_file, filesize($html));
//                    preg_match_all($place_holder, $find_pattern, $matches, PREG_PATTERN_ORDER);
//                    
//                    foreach ($matches as $value) {
//                        $find_pattern = preg_replace($place_holder, "", $find_pattern);
//                    }
//                    
//                    $handle_file = fopen($html,"w+");
//                    fwrite($handle_file,$find_pattern);
//                    
//                    fclose($handle_file);
                    
//                    echo '<pre>' . print_r($find_pattern, true) . '</pre>';die;
                    var_dump($templateProcessor);
                    
                    $handle_html = file_get_contents($dir . '/' . $model->FilesID .'.html');
                    $model->texthtml = $handle_html;
                    $model->save();

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
        
        $dir = Yii::getPathOfAlias('webroot.myfile');

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['FilesGen'])) {
            $dir = "myfile";
            $Attach = CUploadedFile::getInstance($model, 'FilesName');
            if ($Attach != '') {
                $Attach->saveAs($dir . DIRECTORY_SEPARATOR . $model->FilesID . '.docx');

                if ($_POST["FilesGen"]['chkOverwrite'] == '1') {
                    
                } else {
                    Yii::import('ext.phpword.samples.memoPlusFontStyle', true);
                    $phpWord = \PhpOffice\PhpWord\IOFactory::load($dir . '/' . $model->FilesID . '.docx');
                    $phpWord->save($dir . '/' . $model->FilesID . '.html', 'HTML');

                    $model->ConvertTag2Html($model->FilesID);
                }


                if ($model->update(array('FilesName'))) {
                    $flag = TRUE;
                }
            }

            if ($_POST['FilesGen']['Name'] != '') {
                $name = $_POST['FilesGen']['Name'];
                $model->Name = $name;
                if ($model->update(array('Name'))) {
                    if (!empty($model->html)) {
                        //rename("myfile/" . $model->html, "myfile/" . $name . ".html");
                        $model->html = $name . ".html";
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
        
        $dir = Yii::getPathOfAlias('webroot.myfile');
        
        if (Yii::app()->user->role == 'user') {
            return false;
        }

        unlink($dir . '/' . $id . '.html');
        unlink($dir . '/' . $id . '_edit.html');
        unlink($dir . '/' . $id . '.docx');
        $this->loadModel($id)->delete();


        // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
        if (!isset($_GET['ajax']))
            $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $model = new FilesGen('search');
        $model->unsetAttributes();  // clear any default values

        $dataProvider = new CActiveDataProvider('FilesGen');

        if (isset($_GET['FilesGen']))
            $model->attributes = $_GET['FilesGen'];

        $this->render('index', array(
            'model' => $model,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {

        $model = new FilesGen('search');

        $model->unsetAttributes();  // clear any default values
//        $test = new CActiveDataProvider($model, array(
//            "pagination" => array("pageSize" => 3)
//        ));
        if (isset($_GET['FilesGen']))
            $model->attributes = $_GET['FilesGen'];

        $this->render('admin', array(
            'model' => $model//, 'test' => $test
        ));
    }

    public function actionLet() {
        $model = new FilesGen('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['FilesGen']))
            $model->attributes = $_GET['FilesGen'];
        $this->render('let', array(
            'model' => $model
        ));
    }

    public function actionMemo() {
        $model = new FilesGen('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['FilesGen']))
            $model->attributes = $_GET['FilesGen'];
        $this->render('memo', array(
            'model' => $model
        ));
    }

    public function actionLet_eng() {
        $model = new FilesGen('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['FilesGen']))
            $model->attributes = $_GET['FilesGen'];
        $this->render('let_eng', array(
            'model' => $model
        ));
    }

    public function actionMemo_eng() {
        $model = new FilesGen('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['FilesGen']))
            $model->attributes = $_GET['FilesGen'];
        $this->render('memo_eng', array(
            'model' => $model
        ));
    }

    public function actionUser_let() {
        $model = new FilesGen('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['FilesGen']))
            $model->attributes = $_GET['FilesGen'];
        $this->render('user_let', array(
            'model' => $model
        ));
    }

    public function actionUser_memo() {
        $model = new FilesGen('search');
        $model->unsetAttributes();  // clear any default values

        if (isset($_GET['FilesGen']))
            $model->attributes = $_GET['FilesGen'];
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
//        $model = new FilesGen();
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
     * @return FilesGen the loaded model
     * @throws CHttpException
     */
    public function loadModel($id) {
        $model = FilesGen::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param FilesGen $model the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'files--gen-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

}
