<?php
/**
 * This is the model class for table "tbl_user".
 *
 * The followings are the available columns in table 'tbl_user':
 * @property integer $id
 * @property string $fullname
 * @property string $username
 * @property string $password
 * @property string $repassword
 * @property integer $group
 */
class TblUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tbl_user';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('UserID, fullname, Center, Division, Department', 'required'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, UserID, fullname, username, Center, Department', 'safe', 'on'=>'search'),
// 			array('username, password', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => '�����ŵ�ͧ�繵���ѡ�����͵���Ţ��ҹ��','on' => 'register'),
// 			array('repassword', 'compare', 'compareAttribute' => 'password','on' => 'register'),
// 			array('username', 'unique', 'className' => 'User', 'message' => '{attribute} "{value}" ��������к�����','on' => 'register'),
    
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
				'userfiles_ids' => array(self::HAS_MANY, 'Savefile', array('FilesID'=>'FilesID')),
		);
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'UserID' => 'UserID',
			'fullname' => 'Fullname',
			'username' => 'Username',
			'Center' => 'Center',
			'Division' => 'Division',
			'Department' => 'Department',
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
		$criteria->compare('UserID',$this->UserID,true);
		$criteria->compare('fullname',$this->fullname,true);
		$criteria->compare('Center',$this->Center,true);
		$criteria->compare('Division',$this->Division,true);
		$criteria->compare('Department',$this->Department,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
   public function validatePassword($password)
    {
        return $password === $this->password;
    }
     
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TblUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}