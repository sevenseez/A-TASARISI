<?php
include 'crud.php';
class AdminController extends CController
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
                'actions' => array('settings'),
                'expression' => '$user->isAdmin()'
                ),
            
            array('deny',
                'actions' => array('settings'),
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
    
       
        public function actions() {
            return array(
              'profil' => 'application.controllers.adminActions.Profil', 
              'getnotify' => 'application.controllers.adminActions.GetNotify',
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
          
	public function actionIndex() {
            
       
        $dataProvider=$this->bildirimData('all');
	$this->render('index',array('notify'=>new Notify,'dataProvider'=>$dataProvider ));
		
	}
   
        public function actionChat() {
        
        if(isset($_POST['chatEntry'])) {
                $model = new Chat;
                $model->c_k_id=Yii::app()->user->id;
                $model->c_icerik = $_POST['chatEntry'];
                $model->c_date = date('Y:m:d H:i:s');
                $model->save();
            }  
        }
       
        
        
        public function actionBildirim() {
            if (isset($_GET['activity_type']))
            {
            $activity_type = $_GET['activity_type'];
            $itemView='application.views.admin.bildirim.bildirimfeed';
            
            }
            else {
                $activity_type='all';
                $itemView = 'application.views.admin.extra.newsfeed';
                
            }
            $dataProvider = $this->bildirimData($activity_type);
            $this->render('bildirim/bildirim',array('dataProvider'=>$dataProvider,'itemView'=>$itemView)); 
        }
        
        public function bildirimData($activity_type) {
            
         $the_id = Yii::app()->session['id'];  
         
        if ( $activity_type!='all') {
            $data = Yii::app()->db->createCommand('call bildirimfeed(:the_id,:act)');
            $data->bindValue(':the_id',$the_id);
            $data->bindValue(':act',$activity_type);
        }
        else {  
         $data = Yii::app()->db->createCommand('call newsfeed(:the_id)');
         $data->bindValue(':the_id',$the_id);
         
        }
        
        $dataProvider = $data->queryAll();
         return new CArrayDataProvider($dataProvider,
                 array('pagination' => false
                     )
                 );
        }
        
   
        public function actionDilek () {
            $dataProvider = Dilek::model()->search();
            $itemView = 'application.views.admin.extra.dilekfeed';
            Notify::model()->checkNotify('dilek');
            $this->render('extra/dilek',array('dataProvider' => $dataProvider,'itemView'=>$itemView));
        }

        public function actionReplySikayet() { 
            if($_POST['id']) {
                $id=$_POST['id'];
                $model = new Doll;
                $this->renderPartial('extra/dilekmail',array('id'=>$id,'model'=>$model),false,true); 
            }
            
            
        }
        
        public function actionReplyMessage(){
            
            if(isset($_POST['replyButton'])){
               if(!empty($_POST['replyMsg']) && !empty($_POST['idMsg'])){
                   $model = Dilek::model()->findByPk($_POST['idMsg']);
                   $mail = new YiiMailer();
                   $mail->setFrom(Yii::app()->params['adminEmail']);
                   $mail->setTo('ycl1991@hotmail.com');
                   $mail->setSubject('Yanıt --- '.$model->d_konu);  
                   $mail->setBody($_POST['replyMsg']);
                   if(true) //$mail->send()
                   {
                       $model->delete();
                   }
               }
              
            }
             $this->redirect(array('admin/dilek'));
        }
        
        public function actionSettings() {
            $model = Mailsetting::model()->setting;
            if(isset($_POST['Mailsetting']))
            {
                $model->attributes = $_POST['Mailsetting'];
                if($model->save())
                {
                    echo CJavaScript::jsonEncode('success');
                    Yii::app()->end();
                }
                else {
                    
                  echo CJavaScript::jsonEncode($model->getErrors());  
                  Yii::app()->end();
                }
            }
            $this->render('settings',array('model'=>$model));
           
        }
       
       
        public function actionLogout()
                
	{
            $log = new ActiveRecordLogableBehavior();
            $log->setLog(new Activerecordlog, Yii::app()->user->id, '8', '');
            Yii::app()->user->logout();
            $this->redirect(array('/'));
	}
        
        
        public function zaman($date) {
            
            $crud = new crud();
            return $crud->zaman($date);
        }
        
        
   }     
   
  
	
