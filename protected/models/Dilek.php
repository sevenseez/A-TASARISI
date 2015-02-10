<?php

/**
 * This is the model class for table "dilek".
 *
 * The followings are the available columns in table 'dilek':
 * @property integer $d_id
 * @property string $d_ip_addr
 * @property string $d_adsoyad
 * @property string $d_email
 * @property string $d_konu
 * @property string $d_icerik
 */
class Dilek extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'dilek';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
	return array(
			array('d_ip_addr, d_adsoyad, d_email, d_konu, d_icerik', 'required','message'=>'Bu alan boş bırakılamaz.'),
                        array('d_adsoyad', 'length', 'max'=>30 , 'min'=>2,'tooShort'=>'Bu alan en az 2 harften oluşmalıdır'),
			array('d_email', 'length', 'max'=>100),
			array('d_konu', 'length', 'max'=>50),
                        array('d_ip_addr', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('d_id, d_adsoyad, d_ip_addr, d_email, d_konu, d_icerik', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'd_id' => 'D',
                         'd_ip_addr' => 'Ip Adresi',
			'd_adsoyad' => 'D Adsoyad',
			'd_email' => 'D Email',
			'd_konu' => 'D Konu',
			'd_icerik' => 'D Icerik',
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

		$criteria->compare('d_id',$this->d_id);
		$criteria->compare('d_adsoyad',$this->d_adsoyad,true);
		$criteria->compare('d_email',$this->d_email,true);
		$criteria->compare('d_konu',$this->d_konu,true);
                $criteria->compare('d_ip_addr',$this->d_ip_addr,true);
		$criteria->compare('d_icerik',$this->d_icerik,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination' => false,
                        'sort'=>array('defaultOrder'=>'d_id desc'),
		));
	}
        
        public function behaviors() ///  BU model(ACTIVE RECORD) için Log tutma classını aktive eder..
        {
                return array(
                    // Classname => path to Class
                    'ActiveRecordLogableBehavior'=>
                        'application.behaviors.ActiveRecordLogableBehavior',
                );
            }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Dilek the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
