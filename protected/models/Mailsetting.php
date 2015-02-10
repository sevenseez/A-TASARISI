<?php

/**
 * This is the model class for table "mailsetting".
 *
 * The followings are the available columns in table 'mailsetting':
 * @property integer $id
 * @property string $mailer
 * @property string $host
 * @property integer $port
 * @property string $smtpsecure
 * @property integer $smtpauth
 * @property string $username
 * @property string $password
 */
class Mailsetting extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'mailsetting';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('mailer, host, port, smtpsecure, smtpauth, username, password', 'required','message'=>'Bazı zorunlu alanları boş bıraktınız'),
			array('port', 'numerical', 'integerOnly'=>true,'message'=>'Port değeri rakamlardan oluşmalıdır.'),
			array('mailer, smtpsecure', 'length', 'max'=>10,'message'=>'Mailer uzunluğu 10 karakteri aşmamalıdır.'),
			array('host', 'length', 'max'=>50,'message'=>'Mailer uzunluğu 50 karakteri aşmamalıdır.'),
                        array('smtpauth','numerical','integerOnly'=>true,'message'=>'SMTP Auth değeri rakamlardan oluşmalıdır.','max'=>1,'tooBig'=>'SMPT Auth değeri 0(False) ya da 1(True) değerlerinden biri olmalıdır.'),
			array('username', 'length', 'max'=>100,'message'=>'Mailer uzunluğu 100 karakteri aşmamalıdır.'),
			array('password', 'length', 'max'=>30,'message'=>'Mailer uzunluğu 30 karakteri aşmamalıdır.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, mailer, host, port, smtpsecure, smtpauth, username, password', 'safe', 'on'=>'search'),
		);
	}
        
        public function getSetting() {
            
            $settings = $this->findByPk('1');
            return $settings;
            
        }
	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'mailer' => 'Mailer',
			'host' => 'Host',
			'port' => 'Port',
			'smtpsecure' => 'Smtpsecure',
			'smtpauth' => 'Smtpauth',
			'username' => 'Username',
			'password' => 'Password',
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

		$criteria->compare('id',$this->id);
		$criteria->compare('mailer',$this->mailer,true);
		$criteria->compare('host',$this->host,true);
		$criteria->compare('port',$this->port);
		$criteria->compare('smtpsecure',$this->smtpsecure,true);
		$criteria->compare('smtpauth',$this->smtpauth);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Mailsetting the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
