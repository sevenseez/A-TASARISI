<?php
include 'crud.php';

class TablesController extends CController
{       
    
    public function init() {
        
        $this->layout = 'adminLayout';
        
    }
    
    public function filters()
    {
        return array(
            'accessControl',
        );
    }
    
    public function accessRules() {
        return array(
            
             array('allow',
                'actions' => array('yonetici','bekleyenCihazlar','bekleyenIslemler','logs'),
                'expression' => '$user->isAdmin()'
                ),
            
            array('deny',
                'actions' => array('yonetici','bekleyenCihazlar','bekleyenIslemler','logs'),
                'users' => array('@'),
                ),
            
            array('allow', 
                'users' => array('@'),
            ),
            array('deny', 
                'users' => array('*'),
                'deniedCallback' => function() { Yii::app()->controller->redirect(array ('/')); }
            ),
           
             
            );
    }
	
        public function actions(){
                return array(
                    'mail'=>'application.controllers.tableActions.Mail',
                    'returned'=>'application.controllers.tableActions.Returned',
                    'onayver'=>'application.controllers.tableActions.OnayVer',
                    'reddet'=>'application.controllers.tableActions.Reddet',
                    'focusrow'=>'application.controllers.tableActions.FocusRow',
                    'generalfocusrow'=>'application.controllers.tableActions.GeneralFocusRow',
                    'search'=>'application.controllers.tableActions.Search',
                );
             }
             
        protected function beforeAction($action) {
            if(Yii::app()->request->isAjaxRequest) {
            Yii::app()->clientScript->scriptMap['jquery.js'] = false;
	    Yii::app()->clientScript->scriptMap['jquery-ui.min.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.yiigridview.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery.listview.js'] = false;
             Yii::app()->clientScript->scriptMap['jquery.ba-bbq.js'] = false;
        }
         return parent::beforeAction($action);
          }
          
          
        
        public function actionDetails($id) {
           
            Yii::app()->session['table_id'] = $id;
            $model1 = Islemler::model()->findByPK($id);
            $model2 = $model1->cihaz;
            
           $this->renderPartial('islemler/details',array('model1'=>$model1,'model2'=>$model2),false,true);
           
        }
        
        public function actionInsert($table){
            $model = new $table();
            $this->renderPartial($table.'/insert_'.$table,array('model'=>$model),false,true);
        }
        
        
        public function actionEdit($id,$table) { // örn islemler/edit_islemler i renderPartial'la renderlar
            
            $model = new $table;
            $model = $model->findByPk($id);
            $this->renderPartial($table.'/edit_'.$table,array('model'=>$model),false,true);
        }
        
            
      
        public function zaman($date) {
            
            $crud = new crud();
            return $crud->zaman($date);
        }
        
        /* Table Functions ***/ 
        
        public function actionMarkalar() {
            
          $table = 'Markalar';
          $this->tableAlgorithm($table,'marka_id');
      
        }
        
        public function actionBirimler() { 
         
          $table ='Birimler';
          $this->tableAlgorithm($table,'birim_id');

        }
        
        public function actionCihazlar() {
            
           $table = 'Cihazlar';
           $this->tableAlgorithm($table,'cihaz_id');
            
        } 
        
        public function actionIslemler() {
            
            $table = 'Islemler';
            $this->tableAlgorithm($table,'islem_no');
            
        } 
        
        public function actionYonetici() {
            
           $table = 'Yonetici';
           $this->tableAlgorithm($table, 'y_id');
            
        }
        
   
        public function perPage() {
            
          if (isset($_POST['pageSize'])) {
                    Yii::app()->user->setState('pageSize',(int)$_POST['pageSize']);
                    unset($_POST['pageSize']);  // would interfere with pager and repetitive page size change
                 }  
        }
        
        public function tableAlgorithm($table,$key) {
            
            $this->perPage();
            $crud = new \crud();
            $crud->mainCall($table,$key);
            
            $model= new $table;
            $model  = $model->search();
            
            $returned = $this->searchAlgorithm($table);
            if($returned!=null ) $model= $returned;
            
            $params = ['model'=>$model];
           
            if(!isset($_GET['ajax'])) 
            $this->render($table.'/'.$table, $params,false,true);
            else  $this->renderPartial($table.'/'.$table, $params,false,true); 
            
            
        }
     
        /* Table Functions Ends ***/ 
      public function searchAlgorithm($table) {
            
            if((isset($_POST['text']) && $_POST['text']!=null && $_POST['text']!='')||isset($_GET['search'])){
                if(isset($_GET['search']))
                    $send= $_GET['search'];
                else $send=$_POST['text'];
                
                $crud = new crud;
                return $crud->search($table,$send);
             }
          else return null;
          
      }
        
       /**** MIXED Table Functions / tableAlgorithm Dışındakiler ***/
        public function actionLogs() {
            
        $this->perPage();
        $model = Activerecordlog::model()->search();
        
        $returned = $this->searchAlgorithm('Activerecordlog');
        if($returned!=null) { $model = $returned; }
        
        $this->render('logs/logs',array('model'=>$model));
        }
        
          /*** bekleyen ve bitenler*////
        public function actionBitenIslemler() {
            $this->perPage();
            $model = BitenIslemler::model()->search();
            
            $crud = new crud();
            $crud->countScript('BitenIslemler');
            
            $returned = $this->searchAlgorithm('BitenIslemler');
            if($returned!=null) { $model = $returned; }
            
            $this->render('bitenler/bitenislemler',array('model'=>$model));
            
        }
        
        public function actionBitenCihazlar() {
            $this->perPage();
            $model = BitenCihazlar::model()->search();;
            
            $returned = $this->searchAlgorithm('BitenCihazlar');
            if($returned!=null) { $model = $returned; }
             
            $this->render('bitenler/bitencihazlar',array('model'=>$model));
            
        }
        
        public function actionBekleyenIslemler(){
            $this->perPage();
            $model = BekleyenIslemler::model()->search();
            
            $crud = new crud();
            $crud->countScript('BekleyenIslemler');
            
            $returned = $this->searchAlgorithm('BekleyenIslemler');
            if($returned!=null) { $model = $returned; }
        
            $this->render('bekleyen/bekleyenislemler',array('model'=>$model));
            
            
        }
        
         public function actionBekleyenCihazlar(){
            $this->perPage();
            $model = BekleyenCihazlar::model()->search();;
            
           $returned = $this->searchAlgorithm('BekleyenCihazlar');
            if($returned!=null) { $model = $returned; }
             
            $this->render('bekleyen/bekleyencihazlar',array('model'=>$model));
            
            
        }
        /*** Bekleyen ve Biten END!***/
        /**** Mixed tables End ! ***/
        
       public function getModelName()
        {
            return __CLASS__;
        }
   }     

