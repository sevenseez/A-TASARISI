<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mail
 *
 * @author TOSHIBA
 */
class Mail extends CAction{
     public function run(){
           /* error_reporting(E_ALL);
            ini_set('display_errors', '1');
           */
            if(isset($_POST['mail'])){
                
            $area_val = $_POST['area'];
            $mail = $_POST['mail'];
            
            $model1 = Islemler::model()->findByPK(Yii::app()->session['table_id']);
            $model2 = $model1->cihaz;
            
            $mail = new YiiMailer();
            $mail->setLayout('');
            $mail->setFrom(Yii::app()->params['adminEmail']);
            $mail->setTo('ycl1991@hotmail.com');
            $mail->setSubject('Form');
            $mail->SMTPDebug = 1;
            $mail->Body = $mail->renderView('mail/page',array('model1'=>$model1,'model2'=>$model2,'area_val'=>$area_val));
            
            if ($mail->send()) {
                 $finished_i = new BitenIslemler; 
                 $finished_c = new BitenCihazlar;
                 $finished_i->setAttributes($model1->getAttributes(), false);// Copy row between idetical rows
                 $finished_i->bitis=date('Y-m-d H:i:s');
                 $finished_i->sonlandiran_kullanici = Yii::app()->user->id;
                 $finished_c->setAttributes($model2->getAttributes(), false);
                 $finished_c->cihaz_durum = '6';
                 
                 if($finished_i->save(false) && $finished_c->save(false)) {
                     $model1->delete();
                     $model2->delete();
                     $success='success';
                     echo  $success;
                     Notify::model()->setNotify(Yii::app()->user->id, 'BitenIslemler', '6', $finished_i->islem_no,'');
                    Yii::app()->end();}
            } else {
              echo CJavaScript::encode('error');
                  
            }
            
            }
     }
}
