<?php

/**
 * This is the model class for table "notify".
 *
 * The followings are the available columns in table 'notify':
 * @property integer $id
 * @property integer $user_id
 * @property integer $subject_id
 * @property string $activity_type
 * @property string $table_type
 * @property string $fields
 * @property string $is_read
 * @property string $date
 * @property integer $data_id
 */
class Notify extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notify';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('subject_id, activity_type, table_type', 'required'),
			array('user_id, subject_id, data_id , activity_type', 'numerical', 'integerOnly'=>true),
			array('table_type', 'length', 'max'=>20),
			array('is_read', 'length', 'max'=>1),
			array('date', 'safe'),
                        array('fields','max'=>'250'),
                    
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, subject_id, activity_type, fields ,table_type, is_read, date, data_id', 'safe', 'on'=>'search'),
                        array('is_read','required','on','remUnread'),
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
			'id' => 'ID',
			'user_id' => 'User',
			'subject_id' => 'Subject',
			'activity_type' => 'Activity Type',
			'table_type' => 'Table Type',
			'is_read' => 'Is Read',
			'date' => 'Date',
			'data_id' => 'Data',
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
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('subject_id',$this->subject_id);
		$criteria->compare('activity_type',$this->activity_type,true);
		$criteria->compare('table_type',$this->table_type,true);
                $criteria->compare('fields',$this->fields,true);
		$criteria->compare('is_read',$this->is_read,true);
		$criteria->compare('date',$this->date,true);
		$criteria->compare('data_id',$this->data_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Notify the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        public function activity_desc($act) {
            $desc =array(     0=> 'İstek',
                              1 => 'Güncelleme',
                              2 => 'Ekleme',
                              3 => 'Silme',
                              4 => 'Süresi doldu',
                              5 => 'İşleme alma',
                              6 => 'İşlemi sonlandırma',
                              7 => 'Sisteme giriş',
                              8 => 'Sistemden çıkış',
                              9 => 'Dilek-Şikayet',
                        );
            return $desc[$act];
        }
        // Bildirim yollama 
        protected static function getYetkiArray() {
            return array('Yonetici','BekleyenIslemler','Markalar','Birimler');
        }
        
        public function setNotify ($user_id,$table_type,$activity_type,$data_id,$fields){
            
            if ($activity_type=='4')
            {   
                $user_list = Yii::app()->db->createCommand("select y_id from yonetici")->queryAll();
                
            }
            else {
            $sql= Yii::app()->db->createCommand()
                    ->select('y_id')
                    ->from('yonetici')
                    ->where('y_id!=:id',array(':id'=>$user_id))
                    ;
            if (in_array($table_type, $this->yetkiArray)) {
               $sql->setText('');
               $sql->where("yetki='1' AND y_id!=:id",array(':id'=>$user_id));
            }
            
            $user_list=$sql->queryAll();
            }
            
            foreach($user_list as $item){
                    //process each item here
                    $this->activity_type = $activity_type;
                    $this->subject_id = $item['y_id'];
                    $this->table_type = $table_type;
                    $this->data_id = $data_id;
                    $this->fields = $fields;
                    $this->user_id = $user_id;
                    $this->setIsNewRecord(true);
                    $this->insert();
                    $this->unsetAttributes();
                    
                }
        }
        
        // Tablo tipine göre okunmayan bildirimlerin sayısı
        public function getUnread($subject_id,$table_type){
            
            $criteria = new CDbCriteria;
            $criteria->select='id';
            $criteria->group = 'data_id';
            $criteria->condition ="subject_id ='$subject_id' AND table_type='$table_type' AND is_read='0' AND" 
                    . " activity_type!='3' AND activity_type!='4'";
            $count=$this->findAll($criteria);
            
            return count($count); 
            
        }
        // Okundu olarak işaretleme
        public function remUnread($subject_id,$table_type) {
           
           $criteria = new CDbCriteria;
           $criteria->select = 'id';
           $criteria->condition = "subject_id = '$subject_id' AND table_type='$table_type'"
                           . " AND is_read = '0'";
           
           $_list= $this->findAll($criteria);
           
          foreach ($_list as $item){
           $model= $this->findByPk($item['id']);
           $model->is_read=1;
           $model->update();
          }
        }
        
           public function remOne($id,$table_type) {
           
           $subject_id = Yii::app()->user->id;
           $criteria = new CDbCriteria;
           $criteria->select = 'id';
           $criteria->condition = "subject_id = '$subject_id' AND table_type='$table_type'"
                           . " AND is_read = '0' AND id='$id'";
           
           $_list= $this->findAll($criteria);
           
          foreach ($_list as $item){
           $model= $this->findByPk($item['id']);
           $model->is_read=1;
           $model->update();
          }
        }
        
        // Tablo açıldıgında ilk seferde değişikliklerin gösterildikten sonra kaldırılması için
        public function checkNotify ($table) {
          
            $id = Yii::app()->session['id'];
            $count = $this->getUnread($id,$table); 
            $this->remUnread($id,$table);
            return $count;
           
      }
       // x gündür bakılmayan cihazlar için - SERVER SIDE 
      /*  public function checkExpired(){
            
            $isCookie =  Yii::app()->request->cookies['expired_notify'];
            
            if ( $isCookie==null || $isCookie!=true){
                
            $cookie = new CHttpCookie('expired_notify', true); // BUGUN ICIN BILDIRIM VERDIGINI BILDIREN COOKIE TANIMLIYOR
            $cookie->expire = strtotime('tomorrow');
            Yii::app()->request->cookies['expired_notify'] = $cookie;
            
            $this_date = date("Y-m-d",strtotime("-11 day"));
            $islem= Yii::app()->db->createCommand("select islem_no from islemler where "
                  . " DATE_FORMAT(guncelleme,'%y-%m-%d') = DATE_FORMAT('$this_date','%y-%m-%d')")->queryAll();
            
            foreach ($islem as $item){
                $this->setNotify('0', 'Islemler', '4', $item['islem_no']);
            }
            
            }
        } */
        
        
}
