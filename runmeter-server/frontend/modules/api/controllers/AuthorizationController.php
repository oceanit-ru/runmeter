<?php

namespace frontend\modules\api\controllers;

use yii\filters\VerbFilter;
use Yii;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use ErrorException;
use common\components\helpers\ModelHelper;
use frontend\modules\api\models\FBLoginForm;
use frontend\modules\api\models\VKLoginForm;

class AuthorizationController extends \yii\web\Controller
{
	public function behaviors()
    {
		$behaviors = parent::behaviors();

		$behaviors['verbs'] = [
		    'class' => VerbFilter::className(),
		    'actions' => [
				'login-by-fb' => ['post'],
				'login-by-vk' => ['post']
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
	
	/**
	 * @api {post} /authorization/login-by-fb Авторизация через Facebook
	 * @apiDescription Авторизация через Facebook.
	 * @apiError ErrorException.
	 * @apiGroup Authorization
	 *
	 * @apiParam {String}		fbUserId		Facebook UserId.
	 * @apiParam {String}		fbAccessToken	Facebook TokenString.
	 *
	 * @apiVersion 0.1.0
	 */
	
    public function actionLoginByFb()
    {
		$modelForm = new FBLoginForm();
		$modelForm->load(Yii::$app->request->post(), '');
		if ($modelForm->login()) {
		    return []; 
		} else {
		    throw new ErrorException(ModelHelper::getFirstError($modelForm));
		}
    }
	
	/**
	 * @api {post} /authorization/login-by-vk Авторизация через Vkontakte
	 * @apiDescription Авторизация через Vkontakte.
	 * @apiError ErrorException.
	 * @apiGroup Authorization
	 *
	 * @apiParam {String}		vkUserId		Vkontakte UserId.
	 * @apiParam {String}		vkAccessToken	Vkontakte TokenString.
	 *
	 * @apiVersion 0.1.0
	 */
	
    public function actionLoginByVk()
    {
		$modelForm = new VKLoginForm();
		$modelForm->load(Yii::$app->request->post(), '');
		if ($modelForm->login()) {
		    return []; 
		} else {
		    throw new ErrorException(ModelHelper::getFirstError($modelForm));
		}
    }

}
