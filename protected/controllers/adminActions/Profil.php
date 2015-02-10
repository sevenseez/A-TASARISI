<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Profil
 *
 * @author TOSHIBA
 */
class Profil extends CAction{
     public function run() {
         
            $controller = $this->getController();
            $yonetici = Yonetici::model()->findByPK(Yii::app()->user->id);
                if(isset($_POST['Yonetici'])) {
                   
                 if($_POST['Yonetici']['y_sifre']==$_POST['Yonetici']['sifre_tekrar']){
                  
                $temp=$yonetici->y_image;
                $yonetici->attributes = $_POST['Yonetici'];
                
                $rnd = rand(0,9999);
                $uploadedFile=CUploadedFile::getInstance($yonetici,'y_image');
                
                $fileName = "{$rnd}-{$uploadedFile}"; 
                
                if (empty($uploadedFile) || ($uploadedFile==null)){
                $fileName = $temp;
                }
                else if ($temp!='default.jpg') {
                unlink($temp);
                
                }
                
               $yonetici->y_image = $fileName;
               
                if($yonetici->save()) 
                    {   if($fileName!=$temp) 
                    {
                    $uploadedFile->saveAs(Yii::getPathOfAlias('webroot').'/images/profil/'. $fileName); 
                    
                    }
                        echo CJavaScript::jsonEncode('success');
                    } 
                    else {
                    echo CJavaScript::jsonEncode('error');
                    Yii::app()->end();
                    }
                 }
                else {
                    echo CJavaScript::jsonEncode('error');
                    Yii::app()->end();
                    }
                }
             
            $controller->render('profil',array('yonetici'=>$yonetici));
        }
}
