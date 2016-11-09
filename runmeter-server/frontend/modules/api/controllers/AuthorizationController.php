<?php

namespace frontend\modules\api\controllers;

class AuthorizationController extends \yii\web\Controller
{
	public function behaviors()
    {
		$behaviors = parent::behaviors();

		$behaviors['verbs'] = [
		    'class' => VerbFilter::className(),
		    'actions' => [
				'send-sms' => ['post'],
				'sign-in' => ['post']
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

		if ($modelForm->login()) {
		    return []; 
		} else {
		    throw new ErrorException(ModelHelper::getFirstError($modelForm));
		}
    }

}
