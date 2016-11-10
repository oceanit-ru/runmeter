<?php

namespace frontend\modules\api\controllers;

use yii\filters\VerbFilter;
use Yii;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use ErrorException;
use common\components\helpers\ModelHelper;
use frontend\modules\api\models\LoginForm;

class AuthorizationController extends \yii\web\Controller
{
	public function behaviors()
    {
		$behaviors = parent::behaviors();

		$behaviors['verbs'] = [
		    'class' => VerbFilter::className(),
		    'actions' => [
				'login' => ['post']
		    ]
		];
		
		$behaviors['contentNegotiator'] = [
    	    'class' => ContentNegotiator::className(),
    	    'formats' => [
    		  'application/json' => Response::FORMAT_JSON,
    	    ],
    	];


		return $behaviors;
    }
	
    public function actionLogin()
    {
		$modelForm = new LoginForm();
		$modelForm->load(Yii::$app->request->post(), '');
		//var_dump($modelForm); die();
		if ($modelForm->login()) {
		    return []; 
		} else {
		    throw new ErrorException(ModelHelper::getFirstError($modelForm));
		}
    }

}
