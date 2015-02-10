<?php

/**
 * This is the model class for table "bekleyen_islemler".
 *
 * The followings are the available columns in table 'bekleyen_islemler':
 * @property integer $islem_no
 * @property integer $cihaz_id
 * @property string $istek_sahibi
 * @property integer $sicil_no
 * @property string $ip_addr
 * @property string $istek_telefon
 * @property string $istek_email
 * @property integer $istek_birim
 */
class BekleyenIslemler extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $istek_isim;
        public $istek_soyisim;
    

	public function tableName()
	{
		return 'bekleyen_islemler';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
	        return array(
			array('istek_sahibi, sicil_no, istek_email, '
                            . 'istek_telefon, istek_birim , istek_isim, istek_soyisim', 'required','message'=>'Bu alan boş bırakılamaz.'),
			array('cihaz_id, sicil_no , istek_birim','numerical', 'integerOnly'=>true,
                            'message'=>'Bu alan yalnızca rakamlardan oluşmalıdır.'),
                        array('sicil_no','checkSicil'),
                        array('istek_isim , istek_soyisim ','length','min'=>2,'tooShort'=>'En az 2 karakter girmelisiniz.'),
                        array('cihaz_id','unique'),
                        array('istek_telefon','length','min'=>10 ),
                        array('ip_addr', 'length', 'max'=>15),
                        array('sicil_no','length', 'min'=>11, 'max'=>11,'tooShort'=>'Bu alan 11 karakter uzunluğunda olmalıdır.'),
                        array('sicil_no','numerical','integerOnly'=>true,'min'=>'10000000000','tooSmall'=>'Sicil numarası 0 ile başlayamaz.'),
                        array('tarih','safe'),
			array('istek_email','email','message'=>'Geçersiz e-posta adresi'),
                        array('istek_sahibi, istek_isim, istek_soyisim','match','pattern' => '/^[a-zA-ZÇŞĞÜÖİçşğüöı\s]+$/',
                            'message'=>'Bu alan harflerden oluşmak zorundadır.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('islem_no, cihaz_id, istek_sahibi, sicil_no, ip_addr, tarih, istek_telefon, istek_email, istek_birim', 'safe', 'on'=>'search'),
		);
		
	}

	/**
	 * @return array relational rules.
	 */
        public function checkSicil($attribute,$params) {
            $value=$this->$attribute;
            $model = $this->findByAttributes(array('sicil_no'=>$this->sicil_no));
            if ($model!=null){
                $adsoyad= $this->istek_isim.$this->istek_soyisim;
              if($adsoyad!=$model->istek_sahibi || $this->istek_birim!=$model->istek_birim)   {
                $this->addError($attribute,'Girdiğiniz bilgiler kayıtlı bulunan sicil numaranızla uyuşmuyor ...');
                return false;
                
              }
              else return true;
            }
            else return true;
        }
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'istekBirim' => array(self::BELONGS_TO, 'Birimler', 'istek_birim'),
			'cihaz' => array(self::BELONGS_TO, 'BekleyenCihazlar', 'cihaz_id'),
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
			'sicil_no' => 'Sicil No',
			'ip_addr' => 'Ip Addr',
			'istek_telefon' => 'Istek Telefon',
			'istek_email' => 'Istek Email',
			'istek_birim' => 'Istek Birim',
                        'tarih' => 'Tarih',
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
                $criteria->with='istekBirim';
                
		$criteria->compare('islem_no',$this->islem_no);
		$criteria->compare('cihaz_id',$this->cihaz_id);
		$criteria->compare('istek_sahibi',$this->istek_sahibi,true);
		$criteria->compare('sicil_no',$this->sicil_no);
		$criteria->compare('istek_telefon',$this->istek_telefon,true);
		$criteria->compare('istek_email',$this->istek_email,true);
		$criteria->compare('istek_birim',$this->istek_birim);
                $criteria->compare('tarih',$this->tarih,true);
                
                
                 
                $sort = new CSort();
                $sort->attributes = array(
                    'birimAdi'=>array(
                        'asc' => 'istekBirim.birim_adi',
                        'desc' => 'istekBirim.birim_adi desc'   
                    ),
                    '*',
                );
                
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                        ),
                        'sort'=>$sort,
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
	 * @return BekleyenIslemler the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
