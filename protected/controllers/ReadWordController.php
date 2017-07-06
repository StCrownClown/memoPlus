<?php

class ReadWordController extends Controller {

    public function actionReadword_index($FilesID) { 
	$this->redirect(array('showWord/showword_index', 'FilesID' => $FilesID));
        $model = $this->loadModel($FilesID);
        $writers = array('Word2007' => 'docx', 'ODText' => 'odt', 'RTF' => 'rtf', 'HTML' => 'html');
        Yii::import('ext.phpword.samples.memoPlusFontStyle', true);

        $name = basename(__FILE__, '.php');
        $source = __DIR__ . "/resources/{$name}.docx";
        $dir = Yii::getPathOfAlias('webroot.myfile');

        $phpWord = \PhpOffice\PhpWord\IOFactory::load($dir . '/' . $model->FilesID . '.docx');

        // Save Files
//        $test = write($phpWord, basename(__FILE__, '.php'), $writers);
        $test = '';

        $remote = Yii::getPathOfAlias('ext.phpword.samples.result').'/ReadWordController.html';
        $local = $dir . '/' . $model->Name . '.html';
        $savehtml = $model->Name . '.html';
		
        if (empty($model->html)) {
            $test .= "สามารถอัพโหลดไฟล์ได้";
            if (copy($remote, $local)) {
                // success
                $test .= "copy success";
                $test .= $savehtml;

                $model->html = $savehtml;
//                $model->update(array('html'));


                if ($model->update(array('html'))) {
                    $test .= "<br/> Save Success";
                    $this->redirect(array('showWord/showword_index', 'FilesID' => $model->FilesID));
                } else
                    $test .= "<br/> Save False";
            } else {
                $test .= "copy error";
                // error
            }
        } else {
            $test .= "Have Value";
            $test .= "เคยอัพโหลดไฟล์ Html นี้แล้วไม่สามารถอัพโหลดได้อีก";
            $this->redirect(array('showWord/showword_index', 'FilesID' => $model->FilesID));
        }

        $this->render('readword_index', array(
            'test' => $test,
        ));
    }

    public function loadModel($id) {
        $model = FilesGen::model()->findByPk($id);
        
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    // Uncomment the following methods and override them if needed
//    public function filters() {
//        // return the filter configuration for this controller, e.g.:
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
//        // return external action classes, e.g.:
//        return array(
//            'action1' => 'path.to.ActionClass',
//            'action2' => array(
//                'class' => 'path.to.AnotherActionClass',
//                'propertyName' => 'propertyValue',
//            ),
//        );
//    }

}
