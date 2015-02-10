<?php

/**
 * This is the model class for table "cihazlar".
 *
 * The followings are the available columns in table 'cihazlar':
 * @property integer $cihaz_id
 * @property string $cihaz_adi
 * @property integer $cihaz_marka
 * @property string $cihaz_serino
 * @property integer $cihaz_durum
 * @property string $ariza_nedeni
 * @property string $guncelleme
 *
 * The followings are the available model relations:
 * @property Markalar $cihazMarka
 * @property Islemler[] $islemlers
 */
class Cihazlar extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
         public $doll;
	public function tableName()
	{
		return 'cihazlar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cihaz_adi, cihaz_marka','required','message'=>'Bu alan boş bırakılamaz.'),
			array('cihaz_marka, cihaz_durum', 'numerical', 'integerOnly'=>true,'message'=>'Bu alan rakamlardan oluşmalıdır.'),
			array('cihaz_adi', 'length' ,'max'=>20,'tooLong'=>'20 karakter sınırı'),
			array('cihaz_serino', 'length', 'max'=>15,'tooLong'=>'15 karakter sınırı'),
                        array('cihaz_serino , cihaz_adi','length','min'=>2,'tooShort' => 'En az 2 karakter girmelisiniz.'),
                        array('cihaz_serino','unique','message'=>'Bu seri numarası kullanımdadır.'),
			array('ariza_nedeni, yonetici_notu', 'length', 'max'=>200,'tooLong'=>'200 karakter sınırı'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('cihaz_id, cihaz_adi, cihaz_marka, cihaz_serino, cihaz_durum, ariza_nedeni, guncelleme', 'safe', 'on'=>'search'),
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
			'cihazMarka' => array(self::BELONGS_TO, 'Markalar', 'cihaz_marka'),
			'islemlers' => array(self::HAS_MANY, 'Islemler', 'cihaz_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'cihaz_id' => 'Cihaz',
			'cihaz_adi' => 'Cihaz Adı',
			'cihaz_marka' => 'Cihaz Marka',
			'cihaz_serino' => 'Seri Numarası',
			'cihaz_durum' => 'Cihaz Durum',
			'ariza_nedeni' => 'Arıza nedenlerini giriniz.',
                        'yonetici_notu' => 'Yönetici Notu',
			'guncelleme' => 'Guncelleme',
                        'diger' => 'Diger Cihaz Tipi ve Markası',
                        
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
                $criteria->alias = "u";
                $criteria->with=array('cihazMarka');
		$criteria->compare('cihaz_id',$this->cihaz_id);
		$criteria->compare('cihaz_adi',$this->cihaz_adi,true);
		$criteria->compare('cihaz_marka',$this->cihaz_marka);
		$criteria->compare('cihaz_serino',$this->cihaz_serino,true);
		$criteria->compare('ariza_nedeni',$this->ariza_nedeni,true);
                $criteria->compare('u.guncelleme',$this->guncelleme);
                
                $sort = new CSort();
                $sort->attributes = array(
                            'markaAdi' => array(
                                'asc' => 'cihazMarka.marka_adi',
                                'desc'=>  'cihazMarka.marka_tipi desc',
                                ),
                            'markaTipi' => array(
                                'asc' => 'cihazMarka.marka_tipi',
                                'desc' => 'cihazMarka.marka_tipi desc',
                            ),
                            '*'
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
        
        public function getDurum () {
            
            return array('1'=>'Alınıyor','2'=>'Beklemede','3'=>'Garantide','4'=>'İşlemde','5'=>'Gönderiliyor','6'=>'Sonlandı');
            
        }
        
         public function getCihazlist(){
         
             $criteria=new CDbCriteria;
             $criteria->order = 'guncelleme desc';
        $cihazlist = CHtml::listData($this->findAll($criteria),'cihaz_id', 'fullName');
         return $cihazlist;
            
        }
        
        public function getFullName() {
            
            return str_pad($this->cihaz_id,"3",">>",STR_PAD_LEFT).' ~~ '.$this->cihaz_adi;
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
	 * @return Cihazlar the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}
