<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Istek
 *
 * @author TOSHIBA
 */
class Istek extends CAction{
    public function run() {
           
            $controller = $this->getController();
            $model1 = new BekleyenIslemler;
            $model2 = new BekleyenCihazlar;
            
            if(isset($_POST['BekleyenCihazlar']) && isset($_POST['BekleyenIslemler'])){
                
               $model1->attributes=$_POST['BekleyenIslemler'];
               $model2->attributes=$_POST['BekleyenCihazlar'];
               
               // Diger markalara giriş yapdılysa o değeri alması için...
               if(isset($_POST['BekleyenCihazlar']['diger_marka']) && isset($_POST['BekleyenCihazlar']['diger_tipi'])){
                   
                   $diger_marka = $_POST['BekleyenCihazlar']['diger_marka'];
                   $diger_tipi = $_POST['BekleyenCihazlar']['diger_tipi'];
                   
                   if(!empty( $diger_marka) && !empty( $diger_marka)){
                       
                       $markalar = new Markalar();
                       $result = $markalar->findByAttributes(array('marka_adi'=>$diger_marka,'marka_tipi'=>$diger_tipi));
                      
                       if (count($result)==0){
                           $markalar->marka_adi=$diger_marka;
                           $markalar->marka_tipi=$diger_tipi;
                           $markalar->marka_ekleyen='Müşteri';
                           $markalar->guncelleme=date('Y-m-d H:i:s');
                                   
                           if($markalar->save()){
                           $model2['cihaz_marka']= $markalar->marka_id;
                           $notify = new Notify();
                           $notify->setNotify('0', 'Markalar', '2', $markalar->marka_id, '');
                           
                           }
                           
                           else { 
                              
                               echo CJavaScript::jsonEncode('Kayıt sırasında bir hata oluştu...'); 
                               Yii::app()->end();}
                       }
                       else if(count($result!=0)){
                           echo CJavaScript::jsonEncode('Bu marka ve cihaz tipi bulunmaktadır.'); 
                           Yii::app()->end();   
                       }
                   }
                   
               } // Diger kontrol kayıt  bitiş
              ////// 
                  $model1['ip_addr']=ip2long($_POST['BekleyenIslemler']['ip_addr']);
                  $model1['tarih']= date('Y-m-d H:i:s');
                  $model1['istek_sahibi']=$_POST['BekleyenIslemler']['istek_isim'].' '.$_POST['BekleyenIslemler']['istek_soyisim'];

                  $val1 = $model1->validate();
                  $val2 = $model2->validate();
                  if($val2){
                            $model2->save(false);
                            $model1['cihaz_id']  = $model2->cihaz_id;//Yii::app()->db->getLastInsertID();
                            
                            if($val1){
                            $model1->save(false);
                            echo CJavaScript::jsonEncode('success');
                            $notify = new Notify;
                            $notify->setNotify('0', 'BekleyenIslemler', '0',$model1['islem_no'] ,'');
                            $model1->unsetAttributes();
                            $model2->unsetAttributes();
                            Yii::app()->end();  
                                        }
                                else { 
                                 $model2->delete();
                                 echo CJavaScript::jsonEncode($model1->getErrors()); 
                                 Yii::app()->end();
                                    }
                          
                        }
                        else  { 
                            echo CJavaScript::jsonEncode('Lütfen doldurulması zorunlu alanları doldurup, girileriniz kontrol ediniz.'); 
                            Yii::app()->end();
                        }
            $controller->redirect(Yii::app()->user->returnUrl);
            }
            $controller->renderPartial('istek',array('model1'=>$model1,'model2'=>$model2),false,true);
           
            
            
        }
}
