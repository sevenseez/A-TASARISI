<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class crud {
    
    public $params;
    
    public function mainCall($table,$key) {
         
          if (isset($_POST['DeleteButton']))  { $this->delete($table);        }
          if (isset($_POST['UpdateButton']))  { $this->update($table,$key);   }
          if (isset($_POST['InsertButton']))  { $this->insert($table,$key);   }
 
           
          $model= new $table;
          $this->countScript($table);
         
       
      }
      
    public function delete ($table){
         $bool=0;
         // Buton tıklandı mı ?
                    
                        if (isset($_POST['selectedIds']))
                        {   
                            foreach ($_POST['selectedIds'] as $id)
                            {
                                $model = $this->loadModel($id,$table);
                                
                               if ( $model->delete() )
                                {
                                   Notify::model()->setNotify(Yii::app()->user->id,$table,'3',$id,'');
                                } else {$bool=1;}
                            }
                            if ($bool==0) {
                                header('Location: '.$table);  // refresh page without submitting filled data:
                                }
                        }
              }
    
    
    public function update ($table,$key){
        
                        if (isset($_POST[$table][$key]))
                        { 
                                $id = $_POST[$table][$key];
                                $model= $this->loadModel($id,$table);
                                $model->attributes = $_POST[$table];
                                if ($table!='Yonetici') {
                                $model->guncelleme=date('Y-m-d H:i:s'); }
                                
                                if ($model->save()){
                                }
                                else echo var_dump($model->getErrors());
                                header('Location: '.$table); 
                     }
        }
        
      
     
        public function insert($table,$key){
            
             
                   if(isset($_POST[$table]))
                {
                       $model =new $table;
                       $model->attributes=$_POST[$table];
                       if ($table != 'Yonetici') {
                           $model->guncelleme = date('Y-m-d H:i:s');
                       }
                       if ($table == 'Islemler') {
                           $model->baslangic=$model->guncelleme;
                           $model->ip_addr = ip2long($model->ip_addr);
                       }
                      
                       if ( $model->save() ){
                         Notify::model()->setNotify(Yii::app()->user->id,$table,'2',$model->$key,'');  
                       }
                       else
                         echo var_dump($model->getErrors());

                       header('Location: '.$table); 
               }   
        }
            
      

         
        public function countScript($table){

              $count= Notify::model()->checkNotify($table);
              if($count>0){
              $cs = Yii::app()->getClientScript();
              $cs->registerScript(BaseUrl.'/js/admin/cell_edit.js', 'load_this('.$count.');');
              }
        }
      
        public function loadModel($id,$table) {
                $model = $table::model()->findByPk($id);
                if ($model === null) {
                    throw new \CHttpException(404, 'The requested page does not exist.');
                }
        return $model;
        }   
      
        public function zaman ($date) {
                $aylar = array('January'    =>    'Ocak',
                        'February'    =>    'Şubat',
                        'March'        =>    'Mart',
                        'April'        =>    'Nisan',
                        'May'        =>    'Mayıs',
                        'June'        =>    'Haziran',
                        'July'        =>    'Temmuz',
                        'August'    =>    'Ağustos',
                        'September'    =>    'Eylül',
                        'October'    =>    'Ekim',
                        'November'    =>    'Kasım',
                        'December'    =>    'Aralık', 
                );
        $date = date('H:m / d - F',$date);
        $date = strtr($date,$aylar);
        return $date;

        }
        public function search($table,$text_old) { 
            $table = new $table;
            $rows = $table->findAll();
            
            $text = strtolower($text_old); 
            $text= explode(' ',$text);
            
            $bool = false;
            $array = array();
            for($i=0;$i<count($rows);$i++){
               for ($j=0;$j<count($text);$j++){
                   if($j>0 && $bool!=true){
                       break;
                   }
                   
                   $bool = false;
                    foreach($rows[$i] as $item=>$value){
                    
                        $new=$this->specialCondition($item, $value);
                        if(strpos($new,$text[$j])!== false){
                            $bool=true;
                            break;
                        }
                    }
                }
                if($bool==true) {
                     array_push($array,$rows[$i]);
                }
            }  
           
           $dataProvider=new CArrayDataProvider($array,array(
               'keyField'=>$table->tableSchema->primaryKey,
               'sort' => array('defaultOrder'=>'guncelleme DESC',),
                        'pagination'=>array(
                            'pageSize'=> '10',
                            'params'=>array('search'=>$text_old)
                        ),
               
           )); 
            return  $dataProvider;
         
        }
        
        private function specialCondition($item,$value) {
            if($item=='cihaz_durum') {  $value = Cihazlar::model()->durum[$value];}
            if($item=='cihaz_marka') { 
               $marka = Markalar::model()->findByPk($value);
               $value=$marka->marka_adi.$marka->marka_tipi;}
            if($item=='istek_birim' || $item=='y_birim') {
                $birim = Birimler::model()->findByPk($value);
                $value = $birim->birim_adi;
            }
            if($item=='action') {
                $c = Notify::model()->activity_desc($value);
                $value = $c;
            }
            if($item=='userid' && $value!='0'){
                $a = Yonetici::model()->findByPk($value);
                $value = $a->y_adsoyad;
            }
           
            return strtolower($value);
        }
     
     }