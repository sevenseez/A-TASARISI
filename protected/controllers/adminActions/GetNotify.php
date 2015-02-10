<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GetNotify
 *
 * @author TOSHIBA
 */

class GetNotify extends CAction {
      public function run (){ // aktivite tipine göre bildirimlerin sayısı 
           $user_id = Yii::app()->user->id; 
           
         
           $criteria = new CDbCriteria;
           $criteria->select = 'activity_type';
           $criteria->condition =  "is_read = '0' AND  subject_id = '$user_id' ";
           $msg_list= Notify::model()->findAll($criteria);
           
           $return_array = [];
           foreach($msg_list as $item) {
               $return_array[]=$item['activity_type'];
               
           }
           echo CJavaScript::jsonEncode($return_array);
           
        }
}
