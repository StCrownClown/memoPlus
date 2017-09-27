<?php

class TemplateController extends Controller {

    public function filters() {
        return array(
            array('booster.filters.BootstrapFilter - delete')
        );
    }

    public static function output_file($file, $name, $mime_type = '') {
        if (!is_readable($file))
            die('File not found or inaccessible!');

        $size = filesize($file);
        $name = rawurldecode($name);

        /* Figure out the MIME type (if not specified) */
        $known_mime_types = array(
            "pdf" => "application/pdf",
            "txt" => "text/plain",
            "html" => "text/html",
            "htm" => "text/html",
            "exe" => "application/octet-stream",
            "zip" => "application/zip",
            "doc" => "application/msword",
            "xls" => "application/vnd.ms-excel",
            "ppt" => "application/vnd.ms-powerpoint",
            "gif" => "image/gif",
            "png" => "image/png",
            "jpeg" => "image/jpg",
            "jpg" => "image/jpg",
            "php" => "text/plain"
        );

        if ($mime_type == '') {
            $file_extension = strtolower(substr(strrchr($file, "."), 1));
            if (array_key_exists($file_extension, $known_mime_types)) {
                $mime_type = $known_mime_types[$file_extension];
            } else {
                $mime_type = "application/force-download";
            };
        };

        @ob_end_clean(); 
        // turn off output buffering to decrease cpu usage
        // required for IE, otherwise Content-Disposition may be ignored
        if (ini_get('zlib.output_compression'))
            ini_set('zlib.output_compression', 'Off');

        header('Content-Type: ' . $mime_type);
        header('Content-Disposition: attachment; filename="' . $name . '"');
        header("Content-Transfer-Encoding: binary");
        header('Accept-Ranges: bytes');

        /* The three lines below basically make the 
          download non-cacheable */
        header("Cache-control: private");
        header('Pragma: private');
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

        // multipart-download and download resuming support
        if (isset($_SERVER['HTTP_RANGE'])) {
            list($a, $range) = explode("=", $_SERVER['HTTP_RANGE'], 2);
            list($range) = explode(",", $range, 2);
            list($range, $range_end) = explode("-", $range);
            $range = intval($range);
            if (!$range_end) {
                $range_end = $size - 1;
            } else {
                $range_end = intval($range_end);
            }

            $new_length = $range_end - $range + 1;
            header("HTTP/1.1 206 Partial Content");
            header("Content-Length: $new_length");
            header("Content-Range: bytes $range-$range_end/$size");
        } else {
            $new_length = $size;
            header("Content-Length: " . $size);
        }

        /* output the file itself */
        $chunksize = 1 * (1024 * 1024);
        $bytes_send = 0;
        if ($file = fopen($file, 'r')) {
            if (isset($_SERVER['HTTP_RANGE']))
                fseek($file, $range);

            while (!feof($file) &&
            (!connection_aborted()) &&
            ($bytes_send < $new_length)
            ) {
                $buffer = fread($file, $chunksize);
                print($buffer);
                flush();
                $bytes_send += strlen($buffer);
            }
            fclose($file);
        } else
            die('Error - can not open file.');
        die();
    }

    public function actionTemplate($FilesID, $IDSave) {
        $model = $this->loadModel($FilesID);
        $dir = Yii::getPathOfAlias('webroot.myfile');

        Yii::import('ext.phpoffice.phpword.samples.memoPlusFontStyle', true);
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor
                ($dir . '/' . $model->FilesID . '.docx');
        $templateProcessor->cloneBlock('CLONEME', 3);

        // Code for placeholder special tag when those tag in docx and html does not matches.
        $place_holder = "/#{Value\d*?(#.*?})/";
        $handle_file = fopen("myfile/" . $FilesID . ".html", "r");

        $find_pattern = fread($handle_file, filesize("myfile/" . $FilesID . ".html"));
        fclose($handle_file);
        preg_match_all($place_holder, $find_pattern, $matches, PREG_PATTERN_ORDER);

        // When #{Savetitle} does not exist. Program will not do $modelSave->Savetitle below.
        $pattern_Savetitle = "/(#{Savetitle})/";
        preg_match($pattern_Savetitle, $find_pattern, $matches_Savetitle);

        $pattern_Checkbox = "/#{(Checkbox\d*?)}/";

        preg_match_all($pattern_Checkbox, $find_pattern, $matches_checkbox, PREG_PATTERN_ORDER);

        $str_box_uncheck = mb_convert_encoding('&#9744;', 'UTF-8', 'HTML-ENTITIES');
        $str_box_checked = mb_convert_encoding('&#9745;', 'UTF-8', 'HTML-ENTITIES');

        $pattern_box_checked = "/(ThisBoxIsChecked)/";

        foreach ($_POST as $key => $value) {
            if (substr($key, 0, 8) == 'Checkbox' && $value == 'ThisBoxIsChecked') {
                $box_value = $str_box_checked;
                $value = substr($value, 0, -16) . $str_box_checked;
            }
            $templateProcessor->setValue($key, htmlspecialchars($value, ENT_COMPAT, 'UTF-8'));
        }

        foreach ($matches_checkbox[1] as $value) {
            $templateProcessor->setValue($value, $str_box_uncheck);
        }

        foreach ($matches[1] as $value) {
            $templateProcessor->setValue($value, htmlspecialchars("}", ENT_COMPAT, 'UTF-8'));
        }

        $modelSave = new Savefile;
        
        if ($IDSave != '0') {
            $modelSave = $modelSave->findByAttributes(array('ID' => $IDSave));
            $modelSave->Savetext = serialize($_POST);
            $modelSave->hidefile = "0";

            if ($matches_Savetitle) {
                $modelSave->Savetitle = $_POST["Savetitle"];
            }
            $modelSave->update();
        } 
        else {
            $modelSave->FilesID = $FilesID;
            $modelSave->UserID = Yii::app()->user->id;
            $modelSave->Savetext = serialize($_POST);
            $modelSave->hidefile = "0";

            if ($matches_Savetitle) {
                $modelSave->Savetitle = $_POST["Savetitle"];
            }

            $modelSave->save(false);
        }
        $filename = $model->FilesID . '_' . rand(5, 200) . '.docx';
        $templateProcessor->saveAs($dir . '/users/' . $filename);
        unset($templateProcessor);

        set_time_limit(0);
        $file_path = $dir . '/users/' . $filename;

        $this->output_file($file_path, $model->Name . ".docx", 'application/msword');

        $files = glob($dir . '/users/*');
        foreach ($files as $file) {
            if (is_file($file))
                unlink($file);
        }
//        unlink($dir . '/users/' . $filename);

        $this->render('template', array(
            'model' => $model, 'save_last_select' => 'a'
        ));
    }

    public function loadModel($id) {
        $model = FilesGen::model()->findByPk($id);
        
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function loadSaveFileModel() {
        $model = new Savefile('search');
        
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    public function actionSave_html() {
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
        } 
        catch (Exception $exc) {
            $model = Savefile::model()->findByPk(array('FilesID' => $_POST["FileID"], 'UserID' => Yii::app()->user->id));
//            $model = Savefile::model()->findByPk($id);
            if ($model === null) {
                throw new CHttpException(404, 'The requested page does not exist.');
            }
            $model->Savetext = $_POST["textJson"];
            $model->update(array('Savetext'));
        }
    }

    public function actionDeleteLastSelect() {
        $model = new Savefile;
        
        if (isset($_GET['IDsave'])) {
            $IDsave = $_GET['IDsave'];
        }
        $model = $model->findByAttributes(array('ID' => $IDsave));
        $model->hidefile = "1";
        $model->update();
//        Yii::app()->db->createCommand($query)->execute();
        $this->redirect(array('FilesGen/last_select'));
    }

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 