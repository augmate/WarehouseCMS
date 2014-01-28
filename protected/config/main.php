<?php
 
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

return array(
 
  /*
  'components' => array(
      'detectMobileBrowser' => array(
          'class' => 'application.extensions.yii-detectmobilebrowser.XDetectMobileBrowser',
      ),
  ),  
  */

  //'theme'=>'freearch',
  'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
  'name'=>'AUGMATE-CMS/AR',

  // preloading 'log' component
  'preload'=>array(
    'log',
    'bootstrap'
    ),

  // autoloading model and component classes
  'import'=>array(
    'application.models.*',
    'application.components.*',
  ),

  'modules'=>array(
    // uncomment the following to enable the Gii tool
    
    'gii'=>array(
      'class'=>'system.gii.GiiModule',
      'password'=>'capstone',
       // If removed, Gii defaults to localhost only. Edit carefully to taste.
      'ipFilters'=>array('127.0.0.1','::1'),
      'generatorPaths'=>array(
          'bootstrap.gii', // since 0.9.1
      ),
    ),
  ),

  // application components
  'components'=>array(
    /*'detectMobileBrowser' => array(
        'class' => 'ext.yii-detectmobilebrowser.XDetectMobileBrowser',
    ),*/
    'mobileDetect' => array(
        'class' => 'ext.MobileDetect.MobileDetect'
    ),
    'user'=>array(
      // enable cookie-based authentication
      'allowAutoLogin'=>true,
    ),
    'bootstrap'=>array(
      'class'=>'ext.bootstrap.components.Bootstrap', // assuming you extracted bootstrap under extensions
      'responsiveCss'=>true,
        ),
    'image'=>array(
      'class'=>'application.extensions.image.CImageComponent',
      // GD or ImageMagick
      'driver'=>'GD',
      // ImageMagick setup path
      //'params'=>array('directory'=>'/opt/local/bin'),
    ),
    // uncomment the following to enable URLs in path-format
    /*
    'urlManager'=>array(
      'urlFormat'=>'path',
      'rules'=>array(
        '<controller:\w+>/<id:\d+>'=>'<controller>/view',
        '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
        '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
      ),
    ),
    */
    'urlManager'=>array(
        'urlFormat'=>'path',
        'rules'=>array(
            // REST patterns
            array('api/list', 'pattern'=>'api/<model:\w+>', 'verb'=>'GET'),
            array('api/list', 'pattern'=>'api/<id:\d+>/<model:\w+>', 'verb'=>'GET'),
            array('api/view', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'GET'),
            array('api/update', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'PUT'),
            array('api/delete', 'pattern'=>'api/<model:\w+>/<id:\d+>', 'verb'=>'DELETE'),
            array('api/create', 'pattern'=>'api/<model:\w+>', 'verb'=>'POST'),
            // Other controllers
            '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
        ),
    ),
    /*'db'=>array(
      'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
    ),*/
    // uncomment the following to use a MySQL database
    
    'db'=>array(
      'connectionString' => 'mysql:host=localhost;dbname=eshopweb_augmatecms',
      'emulatePrepare' => true,
      'username' => 'eshopweb_augmate',
      'password' => 'capstone',
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
  ),

  // application-level parameters that can be accessed
  // using Yii::app()->params['paramName']
  'params'=>array(
    // this is used in contact page
    'adminEmail'=>'info@augmate.com',
    'basePath'=>'',
    //'basePath'=>'/warehouse/',
  ),
);
