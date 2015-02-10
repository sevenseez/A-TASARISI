<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of behaviors
 *
 * @author TOSHIBA
 */
class ActiveRecordLogableBehavior extends CActiveRecordBehavior
{
    private $_oldattributes = array();
 
    public function afterSave($event)
    {
        
        $table = get_class($this->Owner);
        $data_id = $this->Owner->getPrimaryKey();
        $date = new CDbExpression('NOW()');
        $log=new Activerecordlog;
        
        if (!$this->Owner->isNewRecord) {
 
            // new attributes
            $newattributes = $this->Owner->getAttributes();
            $oldattributes = $this->getOldAttributes();
 
            // compare old and new
            foreach ($newattributes as $name => $value) {
                if (!empty($oldattributes)) {
                    $old = $oldattributes[$name];
                } else {
                    $old = '';
                }
 
                if ($value != $old && $name!='guncelleme') {
                    
                    $changes = $name . ' ('.$old.') => ('.$value.'), ';
                    $this->setLog($log, Yii::app()->user->id, '1',$changes);
                    $notify = new Notify();
                    $notify->setNotify(Yii::app()->user->id, get_class($this->Owner), '1',$this->Owner->getPrimaryKey() ,$changes);
                
                }
            } 
           
        } else {
            
            if (!Yii::app()->user->isGuest) {
            $user_id = Yii::app()->user->id;
            $activity = '2';
            }
            else { 
                
            if($table=='Dilek') {
                $activity='9';
            }
            else $activity='0';
            
            $user_id =  '0';
            }
           
            
            $this->setLog($log, $user_id, $activity,'');
        }
    }
 
    public function afterDelete($event)
    {
        $log=new Activerecordlog;
        
        $user_id = Yii::app()->user->id;
        $this->setLog($log, $user_id, '3','');
    }
 
    public function afterFind($event)
    {
        // Save old values
        $this->setOldAttributes($this->Owner->getAttributes());
    }
 
    public function getOldAttributes()
    {
        return $this->_oldattributes;
    }
 
    public function setOldAttributes($value)
    {
        $this->_oldattributes=$value;
    }
    
    public function setLog($log,$user_id,$activity_type,$changes){
            
            $disarda = ['7','8'];
            if(in_array($activity_type, $disarda) ){
            $table = 'Yonetici';
            $data_id = $user_id;
            }
            else {
                
            $table = get_class($this->Owner);
            $data_id = $this->Owner->getPrimaryKey();
            }
            $log->action = $activity_type;
            $log->model = $table;
            $log->idModel = $data_id;
            $log->userid = $user_id;
            $log->field = $changes;
            $log->creationdate = date('Y-m-d H:i:s');
            $log->setIsNewRecord(true);
            $log->insert();
            $log->unsetAttributes();
          
        }
        
    
        
      
        
}
