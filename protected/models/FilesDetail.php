<?php

/**
 * This is the model class for table "savefiles".
 *
 * The followings are the available columns in table 'savefiles':
 * @property integer $id
 * @property string $FilesID
 * @property string $Name
 * @property string $UserID
 * @property string $Savetext
 *
 * The followings are the available model relations:
 * @property Files $files
 * @property TblUser $user
 */
class FilesDetail extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'files';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('Name', 'required'),
			array('type', 'numerical', 'integerOnly'=>true),
			array('Name, html', 'length', 'max'=>255),
                        array('FilesName', 'file', 'types' => 'doc,docx','allowEmpty' => true),
                        array('html', 'file', 'types' => 'htm,html','allowEmpty' => true), 
                        array('active', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('FilesID, Name, FilesName, html, type, texthtml,active', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'Files_Relation' => array(self::HAS_MANY, 'Savefile', 'FilesID'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;
		
		$files = new filesdetail;

		$criteria->compare('FilesID',$this->FilesID,true);
		$criteria->compare('Name',$this->Name,true);
		$criteria->compare('FilesName',$this->FilesName,true);
		$criteria->compare('html',$this->html,true);
		$criteria->compare('type',$this->type);
		$criteria->compare('texthtml',$this->texthtml,true);
                $criteria->order = 'Name ASC';

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Savefiles the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
