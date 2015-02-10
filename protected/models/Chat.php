<?php

/**
 * This is the model class for table "chat".
 *
 * The followings are the available columns in table 'chat':
 * @property integer $c_id
 * @property string $c_k_id
 * @property string $c_icerik
 * @property string $c_date
 */
class Chat extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'chat';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('c_k_id, c_icerik, c_date', 'required'),
			array('c_icerik', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('c_id, c_k_id, c_icerik, c_date', 'safe', 'on'=>'search'),
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
			'c_id' => 'C',
			'c_k_id' => 'C K ID',
			'c_icerik' => 'C Icerik',
			'c_date' => 'C Date',
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

		$criteria->compare('c_id',$this->c_id);
		$criteria->compare('c_k_id',$this->c_k_id,true);
		$criteria->compare('c_icerik',$this->c_icerik,true);
		$criteria->compare('c_date',$this->c_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
                        'pagination'=>false,
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
	 * @return Chat the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
