<?php

// Define Local devolopment. Change 'prod' to 'dev' for local devolopment.
defined('YII_ENV') or define('YII_ENV', 'dev');

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');
// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
    'basePath' => dirname(__FILE__) . DIRECTORY_SEPARATOR . '..',
    'name' => 'Memo Plus',
    'theme' => 'classic',
    'defaultController' => 'site/login',
    // preloading 'log' component
    'preload' => array('bootstrap'),
    'aliases' => array(
        'booster' => 'application.extensions.yiibooster',
    ),
    // autoloading model and component classes
    'import' => array(
        'application.models.*',
        'application.components.*',
    ),
    'modules' => array(
        // uncomment the following to enable the Gii tool

        'gii' => array(
            'class' => 'system.gii.GiiModule',
            'password' => 'Test',
            // If removed, Gii defaults to localhost only. Edit carefully to taste.
            'ipFilters' => array('127.0.0.1', '::1'),
            'generatorPaths' => array('bootstrap.gii'),
        ),
    ),
    // application components
    'components' => array(
        'user' => array(
            // enable cookie-based authentication
            'class' => 'WebUser',
            'allowAutoLogin' => true,
            'loginUrl' => array('/site/login'),
        ),
        // import PHPExcel Class for Export Excel files
        'excel' => array(
            'class' => 'application.extensions.PHPExcel.Classes.PHPExcel',
        ),
        'urlManager' => array(
            'urlFormat' => 'path',
            'showScriptName' => false,
            'routeVar' => 'route',
            'rules' => array(
                //'login'=>'site/login',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ),
        ),
        // database settings are configured in database.php
        'db' => require(dirname(__FILE__) . '/database.php'),
        'errorHandler' => array(
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ),
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
        'booster' => array(
            'class' => 'booster.components.Booster',
            'responsiveCss' => true,
        ),
        'bootstrap' => array(
            'class' => 'booster.components.Bootstrap',
        ),
    ),
    // application-level parameters that can be accessed
    // using Yii::app()->params['paramName']
    'params' => array(
        'admingroup' => array(
            // chumchai
            '000511',
            // sunee 
            '002439',
            // นางสาว ธัญนันท์ กรานเลิศ 
            '002015',
            // นาง ขนิษฐา มีอนันต์ 
            '000678',
            // นางสาว สุณิสา สิงหทัต 
            '002690',
            // ต่อ Outsource
            '901180',
            // siam
            '002170',
			//นางสาว จิรัชญา พรหมศิริ  
			'005777',
        ),
        // this is used in contact page
        'adminEmail' => 'biotec@nstda.or.th',
        'accessRules' => array(
            'site' => array(
                array('allow',
                    'users' => array('admin'),
                ),
                array('allow',
                    'actions' => array('index'),
                    'users' => array('*'),
                ),
                array('allow',
                    'actions' => array('login', 'error', 'logout'),
                    'users' => array('*')
                ),
                array('deny'),
            ),
            'FilesGen' => array(
                array('allow',
                    'actions' => array('index', 'let', 'memo', 'let_eng', 'memo_eng', 'last_select'),
                    'users' => array('user'),
                ),
                array('allow',
                    'actions' => array('admin', 'delete', 'let', 'memo', 'let_eng', 'memo_eng', 'create', 'update', 'view'),
                    'users' => array('admin'),
                ),
                array('deny'),
            ),
        ),
    ),
);
