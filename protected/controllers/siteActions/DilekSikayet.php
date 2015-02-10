<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DilekSikayet
 *
 * @author TOSHIBA
 */
class DilekSikayet extends CAction {
    
      public function run() {
            
            $controller = $this->getController();
            $model = new Dilek();
            if (isset($_POST['dilekButton'])) {

                if(isset($_POST['Dilek']))
                {
                    $model->attributes=$_POST['Dilek'];
                    $model['d_ip_addr']=ip2long($model['d_ip_addr']);
                  
                    if ( $model->save() ) // SAVE VALIDATION I KENDISI YAPIYOR ! 
                             {
                              Notify::model()->setNotify('0','Dilek','','','');
                              header('Location: dilekSikayet');// 
                             } 
                }   
            
                } 
            $controller->render('dilekSikayet',array('model'=>$model));
            
        }
}
