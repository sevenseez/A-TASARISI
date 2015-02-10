<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log','booster'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'ext.YiiMailer.YiiMailer',
                'application.behaviors.ActiveRecordLogableBehavior',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'yucel',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
            // ...
              
		
	),

	// application components
	'components'=>array(
             
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
                        'class' => WebUser,
                        'loginUrl' => 'site/panel'
 		),
                 'booster' => array(
                    'class' =>  'application.extensions.booster.components.Booster' ,
                     'fontAwesomeCss' => TRUE,
                     'responsiveCss' => FALSE,


                ),
               'widgetFactory' => array(
                 'widgets' => array(
                  'CLinkPager' => array(
                     'header' => '<div class="pagination pagination-right">', 
                     'cssFile'=>(strlen(dirname($_SERVER['SCRIPT_NAME']))>1 ? dirname($_SERVER['SCRIPT_NAME']) : '' ) . '/css/admin/pager.css',
                    'firstPageLabel' => '<<',
                    'lastPageLabel' => '>>',
                    'firstPageCssClass' => 'first',
                    'lastPageCssClass' => 'last',
                    'nextPageCssClass'=>'next',
                    'previousPageCssClass'=>'previous',
                    'maxButtonCount' => '5',
                    
                    )
                )
            ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
                        'showScriptName'=>false,
                        'caseSensitive'=>false,  
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                                
			),
		),
		
		'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=takip_sistem',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'yucel552',
			'charset' => 'utf8',
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
              
            
                'authManager'=>array(
                        'class'=>'CPhpAuthManager',
                       

                    ),
	),
        
        

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'kou-bilgi-islem@hotmail.com',
                'defaultPageSize'=>10,
	),
    
);