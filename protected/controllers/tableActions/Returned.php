<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Returned
 *
 * @author TOSHIBA
 */
class Returned extends CAction{
    public function run($id) {
            
            $controller = $this->getController();
            $model_i = BitenIslemler::model()->findByPK($id);
            $model_c = $model_i->cihaz;
            
            $return_i = new Islemler; 
            $return_c = new Cihazlar;
            
            $return_i->setAttributes($model_i->getAttributes(), false);// Copy row between idetical rows
            $return_i->bitis=NULL;
            $return_i->guncelleme = date('Y-m-d H:i:s');
            
            
            $return_c->setAttributes($model_c->getAttributes(), false);
            $return_c->cihaz_durum = '2';
            $return_c->guncelleme =  date('Y-m-d H:i:s');
            if ($return_c->save(false))
            {
              $return_c->setIsNewRecord(true);
            
              $return_i->save(false);
              $model_i->delete();
              $model_c->delete();
              Notify::model()->setNotify(Yii::app()->user->id, 'Islemler', '5', $return_i->islem_no,'' );
            }
            $controller->redirect(array('tables/bitenislemler'));
}

 }
