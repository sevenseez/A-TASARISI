<?php

/**
 * This is the model class for table "islemler".
 *
 * The followings are the available columns in table 'islemler':
 * @property integer $islem_no
 * @property integer $cihaz_id
 * @property string $istek_sahibi
 * @property integer $sicil_no
 * @property string $ip_addr
 * @property string $istek_telefon
 * @property string $istek_email
 * @property integer $istek_birim
 * @property string $baslangic
 * @property string $guncelleme
 * @property string $bitis
 *
 * The followings are the available model relations:
 * @property Birimler $istekBirim
 * @property Cihazlar $cihaz
 */
class Islemler extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
       
	public function tableName()
	{
		return 'islemler';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
                return array(
			array('cihaz_id, istek_sahibi, sicil_no, istek_email '
                            . 'istek_telefon, istek_birim', 'required','message'=>'Bu alan boş bırakılamaz.'),
			array('cihaz_id, istek_birim','numerical', 'integerOnly'=>true,),
			array('istek_sahibi', 'length', 'max'=>30),
                        array('sicil_no','length', 'min'=>11, 'max'=>11,'tooShort'=>'Bu alan 11 karakter uzunluğunda olmalıdır.'),
                        array('sicil_no','numerical','integerOnly'=>true,'min'=>'10000000000','tooSmall'=>'Sicil numarası 0 ile başlayamaz.'),
                        array('istek_telefon','length','min'=>10 ),
                        array('ip_addr', 'length', 'max'=>15),
			array('istek_email','email','message'=>'Geçersiz e-posta adresi'),
			array('baslangic, guncelleme, bitis', 'safe'),
                        array('istek_sahibi','match','pattern' => '/^[a-zA-ZÇŞĞÜÖİçşğüöı\s]+$/',
                            'message'=>'Bu alan harflerden oluşmak zorundadır.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('islem_no, cihaz_id, istek_sahibi, sicil_no, ip_addr, istek_telefon, istek_email, istek_birim, baslangic, guncelleme, bitis', 'safe', 'on'=>'search'),
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
			'istekBirim' => array(self::BELONGS_TO, 'Birimler', 'istek_birim'),
			'cihaz' => array(self::BELONGS_TO, 'Cihazlar', 'cihaz_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'islem_no' => 'Islem No',
			'cihaz_id' => 'Cihaz',
			'istek_sahibi' => 'Istek Sahibi',
			'sicil_no' => 'Sicil Nu.',
                        'ip_addr' => 'Ip Adresi',
			'istek_telefon' => 'Telefon',
			'istek_email' => 'E-Posta',
			'istek_birim' => 'Birim',
			'baslangic' => 'Baslangic',
			'guncelleme' => 'Guncelleme',
			'bitis' => 'Bitis',
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
                
                $criteria->alias='u';
                $criteria->with='istekBirim';
                
		$criteria->compare('islem_no',$this->islem_no);
		$criteria->compare('cihaz_id',$this->cihaz_id);
		$criteria->compare('istek_birim',$this->istek_birim);
		$criteria->compare('u.guncelleme',$this->guncelleme,true);
                
                
                $sort = new CSort();
                $sort->attributes = array(
                    'birimAdi'=>array(
                        'asc' => 'istekBirim.birim_adi',
                        'desc' => 'istekBirim.birim_adi desc'   
                    ),
                    '*',
                );
                $sort->defaultOrder = 'u.guncelleme DESC';
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                        ),

                        'sort' => $sort,
		));  
	}
        
        
         public function behaviors()
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
	 * @return Islemler the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
