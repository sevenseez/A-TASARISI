<?php

/**
 * This is the model class for table "birimler".
 *
 * The followings are the available columns in table 'birimler':
 * @property integer $birim_id
 * @property string $birim_adi
 * @property string $guncelleme
 *
 * The followings are the available model relations:
 * @property Islemler[] $islemlers
 */
class Birimler extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'birimler';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('birim_adi', 'required'),
			array('birim_adi', 'length', 'max'=>40),
			array('guncelleme', 'safe'),
                        array('birim_adi','match','pattern' => '/^[a-zA-ZÇŞĞÜÖİçşğüöı\s]+$/',
                            'message'=>'Bu alan harflerden oluşmak zorundadır.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('birim_id, birim_adi, guncelleme', 'safe', 'on'=>'search'),
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
			'islemlers' => array(self::HAS_MANY, 'Islemler', 'istek_birim'),
		);
	}
        
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'birim_id' => 'Birim',
			'birim_adi' => 'Birim Adi',
			'guncelleme' => 'Guncelleme',
		);
	}
        
        public function getBirimList() {
            
            $birimler = CHtml::listData($this->findAll(), 'birim_id', 'birim_adi');
            return $birimler;
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

		$criteria->compare('birim_id',$this->birim_id);
		$criteria->compare('birim_adi',$this->birim_adi,true);
		$criteria->compare('guncelleme',$this->guncelleme,true);
              
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'sort' => array('defaultOrder'=>'guncelleme DESC',),
                        'pagination'=>array(
                            'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                            
                        ),

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
	 * @return Birimler the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
