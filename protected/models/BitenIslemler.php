<?php

/**
 * This is the model class for table "biten_islemler".
 *
 * The followings are the available columns in table 'biten_islemler':
 * @property integer $islem_no
 * @property integer $cihaz_id
 * @property string $istek_sahibi
 * @property integer $sicil_no
 * @property string $ip_addr
 * @property string $istek_telefon
 * @property string $istek_email
 * @property integer $istek_birim
 * @property string $sonlandiran_kullanici
 * @property string $baslangic
 * @property string $bitis
 */
class BitenIslemler extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'biten_islemler';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cihaz_id, istek_sahibi, sicil_no, istek_telefon, istek_birim , sonlandiran_kullanici', 'required'),
			array('cihaz_id, sicil_no, istek_birim', 'numerical', 'integerOnly'=>true),
			array('istek_sahibi', 'length', 'max'=>40),
			array('istek_telefon', 'length', 'max'=>16),
                        array('ip_addr', 'length', 'max'=>15),
                        array('sonlandiran_kullanici', 'numerical','integerOnly'),
			array('istek_email', 'length', 'max'=>100),
			array('baslangic, bitis', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('islem_no, cihaz_id, istek_sahibi, sicil_no, istek_telefon, ip_addr, istek_email, istek_birim, baslangic, bitis', 'safe', 'on'=>'search'),
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
		    'cihaz' => array(self::BELONGS_TO, 'BitenCihazlar', 'cihaz_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'islem_no' => 'İslem No',
			'cihaz_id' => 'Cihaz',
			'istek_sahibi' => 'İsteği Yapan',
			'sicil_no' => 'Sicil Nu',
                        'ip_addr' => 'Ip Adresi',
                        'sonlandiran_kullanici' => 'Sonlandiran Kullanici',
			'istek_telefon' => 'Telefon',
			'istek_email' => 'Email',
			'istek_birim' => 'Birim',
			'baslangic' => 'Baslangic',
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
                
                $criteria->with='istekBirim';
		$criteria->compare('islem_no',$this->islem_no);
		$criteria->compare('cihaz_id',$this->cihaz_id);
		$criteria->compare('sicil_no',$this->sicil_no);
                $criteria->compare('ip_addr',$this->ip_addr,true);
		$criteria->compare('istek_sahibi',$this->istek_sahibi,true);
		$criteria->compare('istek_telefon',$this->istek_telefon,true);
		$criteria->compare('istek_email',$this->istek_email,true);
		$criteria->compare('istek_birim',$this->istek_birim);
                $criteria->compare('sonlandiran_kullanici',$this->sonlandiran_kullanici,true);
                
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
	 * @return BitenIslemler the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
