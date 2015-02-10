<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OnayVer
 *
 * @author TOSHIBA
 */
class OnayVer extends CAction{
     public function run($id) {
         
           
           $controller = $this->getController();
          
           $model_i = BekleyenIslemler::model()->findByPk($id);
           $model_c = $model_i->cihaz;
           $kayit_no = $this->generateSerial();
           
             if(true){
           $onay_i = new Islemler;
           $onay_c = new Cihazlar;
           
           $onay_i->setAttributes($model_i->getAttributes(),false);
           $onay_i->baslangic = new CDbExpression('NOW()');
           $onay_i->guncelleme = $onay_i->baslangic;
           $onay_i->kayit_no = $kayit_no;
           $onay_i->islem_no = null;
           
           $onay_c->setAttributes($model_c->getAttributes(),false);
           $onay_c->cihaz_durum = '2';
           $onay_c->guncelleme = $onay_i->guncelleme;
           $onay_c->cihaz_id = null;
           
         
           if ($onay_c->save(false))
            {
              $onay_i->cihaz_id=$onay_c->cihaz_id;
              $onay_i->save(false);
              
              $model_i->delete();
              $model_c->delete();
              Notify::model()->setNotify(Yii::app()->user->id, 'Islemler', '0', $onay_i->islem_no,'');
              
            }
           }
           $controller->redirect(array('tables/bekleyenislemler'));
            
        }
        
    private function sendMail($mail,$kayit_no){ 
        $kayit_no = "yada <p style='color:red;'>".$kayit_no."</p> nolu kayıt numarasını kullanarak ";
        $mail = new YiiMailer();
        $mail->setFrom(Yii::app()->params['adminEmail']);
        $mail->setTo('ycl1991@hotmail.com');
        $mail->setSubject('İstek Yanıtı');  $mail->setBody('Arıza tamir isteğiniz kabul edilmiştir. İşlem durumunu, cihaz takip sorgulama bölümünden'.
        ' sicil numaranızı kullanarak takip edebilirsiniz.');
      
        if($mail->send())
            return true;
        else return false;
         
     }
     
     private function checkExist($serial) {
          $result = Islemler::model()->findByAttributes(array('kayit_no'=>$serial));
          if ($result!=null)
              return true;
          else return false;
         
     }
     
     private function generateSerial() {
            $str = '';
            for($i = 0; $i < 10; $i++){
                  if($letter_OR_number = rand(0,1)){ // true: harf seçildi
                     $str .= chr(rand(65, 90));
                  } else { // false: sayı seçildi
                     $str .= chr(rand(48,57));
                  }
            }

            if( $this->checkExist($str))
            {
                $this->generateSerial();
            }
            else return $str;
     }
}
