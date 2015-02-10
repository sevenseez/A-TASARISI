<?php

class SiteController extends CController
{
	/**
	 * Declares class-based actions.
	 */
    public function filters()
            {
                return array(
                    'accessControl',
                );
            }
    
    public function accessRules() {
        return array(
            
            array('deny', 
                 'users' => array('@'),
                 'deniedCallback' => function() { Yii::app()->controller->redirect(array ('/admin/index')); }
            ),
            array('allow', 
                'users' => array('*'),
               
            ),
            
            );
        }
        
        
        protected function beforeAction($action) {
        if( Yii::app()->request->isAjaxRequest ) {
              Yii::app()->clientScript->scriptMap['jquery.js'] = false;
            Yii::app()->clientScript->scriptMap['jquery-2.0.0.js'] = false;
                } return parent::beforeAction($action);
          }
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
                        
                        'istek'=>'application.controllers.siteActions.Istek',
                        'dileksikayet'=>'application.controllers.siteActions.DilekSikayet',
               
                        
                            );
	}
          
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
                
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}
        
        
      


	
        public function actionLogin()
                
        {
    	$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='adminlogin-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()) {
                            $user = Yonetici::model()->findByAttributes(array('y_kullanici_adi'=>$model->username));
                        Yii::app()->user->id=$user->y_id;
                        Yii::app()->session['id']=$user->y_id;
                        $log = new ActiveRecordLogableBehavior();
                        $log->setLog(new Activerecordlog, $user->y_id, '7', '');
                         $this->redirect(array( 'admin/index' ));
                            
                        }
                $this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
                $this->renderPartial('login',array('model'=>$model));
		
	}

        public function actionDinamik()
            {
            
            $data=Markalar::model()->findAll('marka_tipi=:parent_id', 
                 array(':parent_id'=> $_POST['BekleyenCihazlar']['doll']));
 
                $data=CHtml::listData($data,'marka_id','marka_adi');
                foreach($data as $value=>$name)
                {  
                    echo CHtml::tag('option',
                               array('value'=>$value),CHtml::encode($name),true);
                }
            }
        

       
}