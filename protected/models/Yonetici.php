<?php

/**
 * This is the model class for table "yonetici".
 *
 * The followings are the available columns in table 'yonetici':
 * @property integer $y_id
 * @property string $y_adsoyad
 * @property integer $yetki
 * @property integer $y_birim
 * @property string $y_kullanici_adi
 * @property string $y_sifre
 * @property string $y_email
 * @property string $y_image
 */
class Yonetici extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
        public $sifre_tekrar;
	public function tableName()
	{
		return 'yonetici';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('y_adsoyad, y_kullanici_adi, y_sifre, y_email', 'required'),
			array('yetki, y_birim', 'numerical', 'integerOnly'=>true),
                        array('y_email','email','message'=>'Geçersiz e-posta adresi'),
			array('y_adsoyad', 'length', 'max'=>30),
			array('y_kullanici_adi', 'length', 'max'=>15),
			array('y_sifre', 'length', 'max'=>10),
			array('y_email, y_image', 'length', 'max'=>100),
                        array('y_image', 'file','types'=>'jpg, gif, png', 'allowEmpty'=>true, 'maxSize'=>1*1024*1024,'tooLarge'=>'dosya boyutu sınırları aşıyor...'
                            ,'on'=>'update'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('y_id, y_adsoyad, yetki, y_birim, y_kullanici_adi, y_sifre, y_email, y_image', 'safe', 'on'=>'search'),
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
			'yoneticiBirim' => array(self::BELONGS_TO, 'Birimler', 'y_birim'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'y_id' => 'Y',
			'y_adsoyad' => 'Ad Soyad',
			'yetki' => 'Yetki',
			'y_birim' => 'Birim',
			'y_kullanici_adi' => 'Kullanici Adı',
			'y_sifre' => 'Sifre',
			'y_email' => 'E-Posta',
			'y_image' => 'Image',
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
                
                $criteria->with='yoneticiBirim';
		$criteria->compare('y_id',$this->y_id);
		$criteria->compare('y_adsoyad',$this->y_adsoyad,true);
		$criteria->compare('y_kullanici_adi',$this->y_kullanici_adi,true);
		$criteria->compare('y_sifre',$this->y_sifre,true);
		$criteria->compare('y_email',$this->y_email,true);
                
                $sort = new CSort();
                $sort->attributes = array(
                    'birimAdi'=>array(
                        'asc' => 'yoneticiBirim.birim_adi',
                        'desc' => 'yoneticiBirim.birim_adi desc'   
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
        
         public function getUsername($id) {
            
            if ($id==0) { return 'Müşteri';}
            else {
                
            $model=$this->findByPK($id);
              return $model->y_kullanici_adi;

            }
            
        }
        public function getNameAvatar($id) {
            if($id=='0')
            {
                return array('Müşteri','/ProjectNew/images/profil/default.jpg');
                
            }
            else {
               $user = $this->findByPk($id);
               return array($user->y_adsoyad,$user->Image);
                
            }
            
        }
        public function getYetkiarray() {
            
            return array('0'=>'Sınırlı','1'=>'Tam');
            
        }
        
 
        public function getImage() {
            $drive_path = $_SERVER['DOCUMENT_ROOT'].'/ProjectNew/images/profil/';
            $path = Yii::app()->request->baseUrl.'/images/profil/';
            $url = $drive_path.$this->y_image;
            
            if (!file_exists($url)) {
                return $path.'default.jpg';
            }
            else return $path.$this->y_image;
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
	 * @return Yonetici the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
