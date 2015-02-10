<?php

class TakipController extends CController
{       
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
        
	public function actionIndex()
	{
		$this->render('index');
	}
          
        public function actionSearch() {
            error_reporting(E_ALL);
            
            $model_i = new Islemler;
            $model_c = new Cihazlar;
            if(isset($_POST['search_box'])){
                  if($_POST['search_box']!=null && !empty($_POST['search_box'])){
                      
                      $dataArray=[];
                      $keyword = $_POST['search_box'];
                      $criteria = new CDbCriteria;
                      $criteria->condition = "sicil_no='$keyword' OR kayit_no='$keyword'";
                      $model_i = Islemler::model()->findAll($criteria);
                     
                     foreach ($model_i as $item){
                     $model_c = Cihazlar::model()->findByPk($item['cihaz_id']);
                     $dataArray[]=$model_c;  }
                     
                      $dataArray = new CArrayDataProvider($dataArray,
                            array('pagination' => false
                                ,'keyField' => 'cihaz_id'
                                )
                            );
                     
                  }
                  else { 
                        echo '<p class="no-data">Sicil numarası kayıtlı değil...</p>';
                        Yii::app()->end();
            }}
                  $itemView = 'application.views.takip.searchfeed';
                  $this->renderPartial('search',array('dataArray'=>$dataArray,'model_i'=>$model_i[0],'itemView'=>$itemView));
        }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}