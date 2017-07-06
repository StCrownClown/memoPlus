<?php

class ShowWordController extends Controller {

    public function actionShowword_index($FilesID, $IDSave) {
        $model = $this->loadModel($FilesID);
        $countlist = 1;

        if (!isset($_POST['name_txt'])) {
            if ($IDSave != '0') {
                $modelsave = new Savefile;
                $modelsave = $modelsave->findByAttributes(array('ID' => $IDSave));
                $_POST = unserialize($modelsave->Savetext);
            }

            $ans = '';
            $model2 = '';
            $this->render('showword_index', array(
                'IDSave' => $IDSave, 'model' => $model, 'savepost' => $_POST
            ));
        } 
        else {
//            header('Content-type: application/json');
//            $name = $_POST['name_txt'];
//            $encode = CJSON::encode($name);

            $this->redirect(array('template/template', 'FilesID' => $FilesID, 'encode' => $encode));
        }
    }

    // Edit_html controller
    public function actionEdit_html($FilesID) {
        $model = $this->loadModel($FilesID);
        
        if (empty($_POST['name'])) {
            
        } else {
            // Save edit file.
            $content = "<!DOCTYPE html>" . PHP_EOL;
            $content .= "<html>" . PHP_EOL;
            $content .= "<head>" . PHP_EOL;
            $content .= "</head>" . PHP_EOL;
            $content .= "<body>" . PHP_EOL;
            $content .= $_POST['name'];
            $content .= "</body>" . PHP_EOL;
            $content .= "</html>" . PHP_EOL;
            $handle = fopen("myfile/" . $model->FilesID . '.html', "w");
            fwrite($handle, $content);
            fclose($handle);

            $model->ConvertTag2Html($FilesID);
            $this->redirect(array('showword_index', 'FilesID' => $FilesID, "IDSave" => 0));
        }

        $html = file_get_contents("myfile/" . $model->FilesID . '.html');
        $this->render('edit_html', array(
            'html' => $html,));
    }

    public function actionSave_html() {
        echo $_POST["textJson"];
        echo $_POST["FileID"];
        $model = $this->loadSaveModel();
        echo "<br>";

        $model->FilesID = $_POST["FileID"];
        $model->Name = $_POST["savename"];
        $model->UserID = Yii::app()->user->id;
        $model->Savetext = $_POST["textJson"];
        if ($model->save()) {
            echo "OK";
        } else
            echo "error";
    }

    public function actionLoad_html() {
        $model = Savefiles::model()->findByPk($_POST['FileID']);
        $str = (json_decode($model->Savetext));
//        $str = $model->Savetext;
//        header('Content-Type: application/json');
        for ($i = 0; $i < sizeof($str); $i++) {
            echo $str[$i] . ",";
        }
    }

    public function actionSave_html2() {
        echo $_POST["textJson"];
        echo $_POST["FileID"];
        echo "," . Yii::app()->user->id;
        $model = $this->loadSaveFileModel();
        echo "<br>";

        $model->FilesID = $_POST["FileID"];
        $model->UserID = Yii::app()->user->id;
        $model->Savetext = $_POST["textJson"];

        try {
            if ($model->save()) {
                echo "OK";
            } else
                echo "error";
        } catch (Exception $exc) {
            $model = Savefile::model()->findByPk(array('FilesID' => $_POST["FileID"], 'UserID' => Yii::app()->user->id));
//            $model = Savefile::model()->findByPk($id);
            if ($model === null) {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
            $model->Savetext = $_POST["textJson"];
            $model->update(array('Savetext'));
        }
    }

    public function loadSaveFileModel() {
        $model = new Savefile('search');
        
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionDelete() {
        Savefiles::model()->findByPk($_POST['FileID'])->delete();
    }

    public function actionEdit_dropdown() {
        $data = Savefiles::model()->findAll('FileID=:FileID', array(':FileID' => (int) $_POST['FileID']));
        $data = CHtml::listData($data, 'id', 'name');

        foreach ($data as $value => $name) {
            echo CHtml::tag('option', array('value' => $value), CHtml::encode($name), true);
        }
    }

    public function actionLoad_lastselect_html() {
        $model = Savefile::model()->findByPk(array('FilesID' => $_POST["FileID"], 'UserID' => Yii::app()->user->id));
        $str = (json_decode($model->Savetext));
//        $str = $model->Savetext;
//        header('Content-Type: application/json');
        
        for ($i = 0; $i < sizeof($str); $i++) {
            echo $str[$i] . ",";
        }
    }

    public function loadModel($id) {
        $model = FilesGen::model()->findByPk($id);
        
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadSelectModel() {
        $model = Selection::model();
        
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadSaveModel() {
        $model = new Savefiles;
        
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function filters() {
        return array(
            array('booster.filters.BootstrapFilter - delete')
        );
    }

}
