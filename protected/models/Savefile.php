<?php

/**
 * This is the model class for table "savefile".
 *
 * The followings are the available columns in table 'savefile':
 * @property integer $FilesID
 * @property integer $UserID
 * @property string $Savetext
 */
class Savefile extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'savefile';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('FilesID, UserID', 'required'),
			array('FilesID, UserID', 'numerical', 'integerOnly'=>true),
			array('Savetext', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, FilesID, UserID, Savetext, Savetitle, savedate', 'safe', 'on'=>'search'),
				// The following rule is used by search().
				// @todo Please remove those attributes that should not be searched.
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
				'filesdetail_ids' => array(self::BELONGS_TO, 'FilesDetail', array('FilesID'=>'FilesID')),
				'user_ids' => array(self::BELONGS_TO, 'TblUser', array('UserID'=>'UserID')),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'FilesID' => 'Files',
			'UserID' => 'User',
			'Savetext' => 'Savetext',
			'Savetitle' => 'เรื่อง',
			'savedate' => 'วันที่บันทึก',
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
		
		// Hide deleted file when savefile.hidefile = "1".
		$criteria->condition = 'hidefile!=1';
		
		$criteria->compare('ID',$this->ID);
		$criteria->compare('FilesID',$this->FilesID,true);
		$criteria->compare('UserID',$this->UserID,true);
		$criteria->compare('savedate',$this->savedate,true);
		
		// Search admin group. If 'admin' show all, else show only yours.
		if (in_array(Yii::app()->user->id, Yii::app()->params['admingroup'])) {
		}else {
			$criteria->compare('UserID',Yii::app()->user->id);
		}

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort'=>array(
							'defaultOrder'=>'savedate DESC',
							),
//                         'pagination'=>array(
//                         'pageSize'=>20,
//                 ),
		));
	}
	
	// Code for GetFilesName, GetCenter, GetDepartment and return "-" if not found.
	public function GetFilesName() {
				
		$FindFilesID = FilesDetail::Model()->findByAttributes(array('FilesID'=>$this->FilesID));
		if ($FindFilesID==null||empty($FindFilesID)) {
			return "-";
		}
		else return FilesDetail::Model()->findByAttributes(array('FilesID'=>$this->FilesID))->Name;
	}
	
	public function GetFullName() {
	
		$FindFullName = TblUser::Model()->findByAttributes(array('UserID'=>$this->UserID));
		if ($FindFullName==null||empty($FindFullName)) {
			return $this->UserID;
		}
		else return TblUser::Model()->findByAttributes(array('UserID'=>$this->UserID))->fullname;
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Savefile the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
}
