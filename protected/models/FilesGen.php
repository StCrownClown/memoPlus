<?php

/**
 * This is the model class for table "files".
 *
 * The followings are the available columns in table 'files':
 * @property integer $FilesID
 * @property string $Name
 * @property string $FilesName
 * @property string $html
 * @property integer $type
 * @property string $texthtml
 */
class FilesGen extends CActiveRecord {

    public function ConvertTag2Html($id) {
        $html = file_get_contents("myfile/" . $id . '.html');

        // Find special tag like #{Value} also #{Value#placeholder} then gen its.
        $pattern = "/#{(Value\d*)(?(?=#)#(.*?)|)}/i";
        $replacement = '<input type="textbox" name="$1" id="$1" style="width:120px;" placeholder="$2">';
        $html = preg_replace($pattern, $replacement, $html);

        // Gen #{Savetitle} to html 'input' form.
        $pattern = "/#{(Savetitle)}/i";
        $replacement = '<input type="textbox" name="$1" id="$1" style="width:120px;" >';
        $html = preg_replace($pattern, $replacement, $html);

        $pattern = "/#{(Num\d*?)}/i";
        $replacement = '<input type="textbox" OnKeyPress="return ChkNumber();" onkeyup="NumtoText()" name="$1" id="$1" style="width:120px;" >';
        $html = preg_replace($pattern, $replacement, $html);

        $pattern = "/#{(Numtext\d*?)}/i";
        $replacement = '<input type="textbox" name="$1" id="$1" style="width:240px;" >';
        $html = preg_replace($pattern, $replacement, $html);

        $pattern = "/#{(NumEN\d*?)}/i";
        $replacement = '<input type="textbox" OnKeyPress="return ChkNumber();" onkeyup="convert()" name="$1" id="$1" style="width:120px;" >';
        $html = preg_replace($pattern, $replacement, $html);

        $pattern = "/#{(NumtextEN\d*?)}/i";
        $replacement = '<input type="textbox" name="$1" id="$1" style="width:240px;" >';
        $html = preg_replace($pattern, $replacement, $html);

        $pattern = "/#{(Checkbox\d*?)}/i";
        $replacement = '<input type="checkbox" name="$1" id="$1" value="ThisBoxIsChecked" >';
        $html = preg_replace($pattern, $replacement, $html);

        $pattern = "/\\#{(Date\d*)}/i";
        $replacement = '<input type="textbox" class="datepicker" style="width:140px;" id="$1" name="$1" >';
        $html = preg_replace($pattern, $replacement, $html);

        $pattern = "/\\#{(DateEN\d*)}/i";
        $replacement = '<input type="textbox" class="datepicker_en" style="width:140px;" id="$1" name="$1" >';
        $html = preg_replace($pattern, $replacement, $html);

        $pattern = "/\\#{(Time\d*)}/i";
        $replacement = '<input id="$1" type="textbox" class="input-small" style="width:60px;" id="$1" name="$1" >';
        $html = preg_replace($pattern, $replacement, $html);

        $pattern = "/\\#{((Select)(\w*)(\d\d))}/i";
        $replacement = '<select name="$1" id="$1" style="width:120px;" class="test" >##[$3]##</select>';
        $html = preg_replace($pattern, $replacement, $html);

        $models = new SelectOpt;
        $models = SelectOpt::model()->findAll();
        foreach ($models as $item) {
            $arr_select = explode(";", $item['Name']);
            $str_select = '';
            $upbound = sizeof($arr_select);
            for ($i = 0; $i < $upbound; $i++) {
                $str_select = $str_select . '<option value="' . $arr_select[$i] . '">' . $arr_select[$i] . '</option>';
            }
            //$list[$item['Name_select']] = $str_select;
            $html = str_replace('##[' . $item['Name_select'] . ']##', $str_select, $html);
        }

        $handle = fopen("myfile/" . $id . "_edit.html", "w");
        fwrite($handle, $html);
        fclose($handle);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'files';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('Name', 'required'),
            array('type', 'numerical', 'integerOnly' => true),
            array('Name, html', 'length', 'max' => 255),
            array('FilesName', 'file', 'types' => 'doc,docx', 'allowEmpty' => false),
            array('html', 'file', 'types' => 'htm,html', 'allowEmpty' => true),
            array('active', 'length', 'max' => 10),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('FilesID, Name, FilesName, html, type, texthtml, active', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'FilesID' => 'Files',
            'Name' => 'Description',
            'FilesName' => 'Files Name',
            'html' => 'Html',
            'type' => 'Type',
            'texthtml' => 'Texthtml',
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('FilesID', $this->FilesID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('FilesName', $this->FilesName, true);
        $criteria->compare('html', $this->html, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('texthtml', $this->texthtml, true);
        $criteria->order = 'Name ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
    }

    public function searchlet() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->condition = 'Name not like "-ยกเลิกฟอร์ม-%"';

        $criteria->compare('FilesID', $this->FilesID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('FilesName', $this->FilesName, true);
        $criteria->compare('html', $this->html, true);
        $criteria->compare('type', 1);
        $criteria->compare('texthtml', $this->texthtml, true);
//                 $criteria->order = 'Name ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'Name ASC',
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
    }

    public function searchmemo() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->condition = 'Name not like "-ยกเลิกฟอร์ม-%"';

        $criteria->compare('FilesID', $this->FilesID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('FilesName', $this->FilesName, true);
        $criteria->compare('html', $this->html, true);
        $criteria->compare('type', 2);
        $criteria->compare('texthtml', $this->texthtml, true);
//                 $criteria->order = 'Name ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'Name ASC',
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
    }

    public function searchlet_eng() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('FilesID', $this->FilesID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('FilesName', $this->FilesName, true);
        $criteria->compare('html', $this->html, true);
        $criteria->compare('type', 3);
        $criteria->compare('texthtml', $this->texthtml, true);
//                 $criteria->order = 'Name ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'Name ASC',
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
    }

    public function searchmemo_eng() {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('FilesID', $this->FilesID);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('FilesName', $this->FilesName, true);
        $criteria->compare('html', $this->html, true);
        $criteria->compare('type', 4);
        $criteria->compare('texthtml', $this->texthtml, true);
//                 $criteria->order = 'Name ASC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'Name ASC',
            ),
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
    }

    public function search_lastselect($id) {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('FilesID', $id);
        $criteria->compare('Name', $this->Name, true);
        $criteria->compare('FilesName', $this->FilesName, true);
        $criteria->compare('html', $this->html, true);
        $criteria->compare('type', $this->type);
        $criteria->compare('texthtml', $this->texthtml, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 20,
            ),
        ));
    }

    public function loadModel($id) {
        $model = FilesGen::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FilesGen the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
