<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of checkExpired
 *
 * @author TOSHIBA
 */
class expiredCommand extends CConsoleCommand {
    public function run($args) {
        echo "Islemler gerceklestiriliyor...\n";
        
        $three_days = date("Y-m-d",strtotime("-3 day"));
        $thirty_days=date("Y-m-d",strtotime("-30 day"));
        
        $islem= Yii::app()->db->createCommand("select islem_no from islemler where "
                  . " DATE_FORMAT(guncelleme,'%y-%m-%d') < DATE_FORMAT('$three_days','%y-%m-%d')")->queryAll();
        
         $islem= Yii::app()->db->createCommand("select cihaz_id from cihazlar where cihaz_durum='3' AND "
                  . " DATE_FORMAT(guncelleme,'%y-%m-%d') < DATE_FORMAT('$thirty_days','%y-%m-%d')")->queryAll();
         
         foreach ($islem as $item){
                Notify::model()->setNotify('0', 'Islemler', '4', $item['islem_no'],'');
            }
        echo "Bildirimler Yollandi...\n";
         
        Yii::app()->db->createCommand("delete from notify where "
                . " DATE_FORMAT(date,'%y-%m-%d') = DATE_FORMAT('$three_months','%y-%m-%d')")->execute();
        
        
        Yii::app()->db->createCommand("delete from activerecordlog where "
                . " DATE_FORMAT(creationdate,'%y-%m-%d') = DATE_FORMAT('$three_months','%y-%m-%d')")->execute();
        
        Yii::app()->db->createCommand("delete b.*,i.* from biten_cihazlar b , biten_islemler i where "
                ." b.cihaz_id= i.cihaz_id AND DATE_FORMAT(i.bitis,'%y-%m-%d') = DATE_FORMAT('$three_months','%y-%m-%d')")->execute();
        
        
        echo "Eskimis veriler kaldirildi...\n";
        echo "Cikis Yapiliyor...\n";
    }
}
