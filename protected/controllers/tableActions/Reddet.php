<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Reddet
 *
 * @author TOSHIBA
 */
class Reddet extends CAction{
     public function run($id) {
             
         $controller=$this->getController();
        
         if(isset($_POST['replyButton']) &&  isset($_POST['replyMsg'])){
            
            $model_i = BekleyenIslemler::model()->findByPk($id);
            $model_c = $model_i->cihaz;
            $mail = $model_i->istek_email;
            $reply =  $_POST['replyMsg'];
            
           if($this->sendMail($mail,$reply)){
           $model_i->delete();
           $model_c->delete();
           Notify::model()->setNotify(Yii::app()->user->id, 'BekleyenIslemler', '3', $model_i->islem_no,'' );
           }
           $controller->redirect(array('tables/bekleyenislemler')); 
         }
         
         else {
          $model = new Doll; 
          $controller->renderPartial('bekleyen/reddet',array('id'=>$id,'model'=>$model),false,true);
         } 
        }
        
    private function sendMail($mail,$reply){ 
        if(empty($reply)) $reply = 'Arıza tamir isteğiniz kabul edilmemiştir.';
        
        $mail = new YiiMailer();
        $mail->setFrom(Yii::app()->params['adminEmail']);
        $mail->setTo('ycl1991@hotmail.com');
        $mail->setSubject('İstek Yanıtı');
        $mail->setBody($reply);
        if($mail->send())
            return true;
        else return false;
         
     }
     
}
