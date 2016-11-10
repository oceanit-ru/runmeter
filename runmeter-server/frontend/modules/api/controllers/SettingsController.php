<?php

namespace frontend\modules\api\controllers;

use yii\filters\VerbFilter;
use Yii;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use ErrorException;
use common\components\helpers\ModelHelper;
use frontend\modules\api\models\GetSettingsForm;

class SettingsController extends \yii\web\Controller
{

	public function behaviors()
	{
		$behaviors = parent::behaviors();

		$behaviors['verbs'] = [
			'class' => VerbFilter::className(),
			'actions' => [
				'get' => ['get']
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

	public function actionGet()
	{
		$modelForm = new GetSettingsForm();
		$settings = $modelForm->getSettings();
		if ($settings != NULL) {
			return $settings;
		} else {
			$modelForm->addError('settings', 'Settings not found');
			throw new ErrorException(ModelHelper::getFirstError($modelForm));
		}
	}

}
