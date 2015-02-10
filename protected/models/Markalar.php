<?php

/**
 * This is the model class for table "markalar".
 *
 * The followings are the available columns in table 'markalar':
 * @property integer $marka_id
 * @property string $marka_adi
 * @property string $marka_tipi
 * @property string $marka_ekleyen
 * @property string $guncelleme
 *
 * The followings are the available model relations:
 * @property Cihazlar[] $cihazlars
 */
class Markalar extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'markalar';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
      
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
                
		return array(
			array('marka_adi, marka_tipi', 'required'),
			array('marka_adi, marka_tipi', 'length', 'min'=>2,'max'=>40),
			array('guncelleme', 'safe'),
                        array('marka_adi','match','pattern' => '/^[a-zA-ZÇŞĞÜÖİçşğüöı\s]+$/',
                            'message'=>'Bu alan harflerden oluşmak zorundadır.'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('marka_id, marka_adi, marka_tipi, guncelleme', 'safe', 'on'=>'search'),
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
			'cihazlars' => array(self::HAS_MANY, 'Cihazlar', 'cihaz_marka'),
		);
	}
        
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'marka_id' => 'Marka',
			'marka_adi' => 'Marka Adi',
			'marka_tipi' => 'Marka Tipi',
			'guncelleme' => 'Guncelleme',
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

		$criteria->compare('marka_id',$this->marka_id);
		$criteria->compare('marka_adi',$this->marka_adi,true);
		$criteria->compare('marka_tipi',$this->marka_tipi,true);
                $criteria->compare('guncelleme',$this->guncelleme);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>array(
                            'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                        ),

                        'sort' => array('defaultOrder'=>'guncelleme DESC',),
		));
	}
        
        public function getMarkalist(){
            
        $markalist = CHtml::listData($this->findAll(), 'marka_id', 'fullName');
         return $markalist;
            
        }
        
        public function behaviors()
            {
                return array(
                    // Classname => path to Class
                    'ActiveRecordLogableBehavior'=>
                        'application.behaviors.ActiveRecordLogableBehavior',
                );
            }
        
        public function getFullName() {
            
            return $this->marka_adi.'/'.$this->marka_tipi;
        }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Markalar the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
