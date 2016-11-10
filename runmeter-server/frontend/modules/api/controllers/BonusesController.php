<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\controllers\PrivateController;
use yii\filters\VerbFilter;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use ErrorException;
use common\components\helpers\ModelHelper;
use Yii;
use frontend\modules\api\models\DepositBonusesForm;
use frontend\modules\api\models\GetBonusesForm;

class BonusesController extends PrivateController
{

	public function behaviors()
	{
		$behaviors = parent::behaviors();

		$behaviors['verbs'] = [
			'class' => VerbFilter::className(),
			'actions' => [
				'deposit' => ['post'],
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

	public function actionDeposit()
	{
		$modelForm = new DepositBonusesForm();
		$modelForm->load(Yii::$app->request->post(), '');
		if ($modelForm->deposit()) {
			return $this->actionGet();
		} else {
			throw new ErrorException(ModelHelper::getFirstError($modelForm));
		}
	}

	public function actionGet()
	{
		$model = new GetBonusesForm();
		return $model->getBonuses();
	}

}
