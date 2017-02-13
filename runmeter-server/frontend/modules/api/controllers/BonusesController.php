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
	
	/**
	 * @api {post} /bonuses/deposit Начисление бонусов
	 * @apiDescription Начисление бонусов.
	 * @apiError ErrorException.
	 * @apiGroup Bonuses
	 *
	 * @apiParam {String}		[fbUserId]		Facebook UserId.
	 * @apiParam {String}		[vkUserId]		Vkontakte UserId.
	 * 
	 * @apiParam {Integer}		bonuses			Количество начисляемых бонусов.
	 * @apiParam {Integer}		steps			Количество начисляемых шагов.
	 * @apiParam {Integer}		yesterdayBonuses		Количество начисляемых бонусов (за период -48 - -24 часа).
	 * @apiParam {Integer}		yesterdaySteps		Количество использованных шагов  (за период -48 - -24 часа).
	 * 
     * @apiSuccess {Integer}		bonuses						Количество использованных пользователем бонусов (за период -24 - -0 часа).
     * @apiSuccess {Integer}		steps						Количество использованных пользователем шагов (за период -24 - -0 часа).
     * @apiSuccess {Integer}		yesterdayBonuses			Количество использованных пользователем бонусов (за период -48 - -24 часа).
     * @apiSuccess {Integer}		yesterdaySteps				Количество использованных пользователем шагов (за период -48 - -24 часа).
	 *
	 * @apiVersion 0.1.0
	 */
	
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
	
	/**
	 * @api {get} /bonuses/get Получение бонусов
	 * @apiDescription Получение бонусов.
	 * @apiError ErrorException.
	 * @apiGroup Bonuses
	 *
	 * @apiParam {String}		[fbUserId]		Facebook UserId.
	 * @apiParam {String}		[vkUserId]		Vkontakte UserId.
	 * 
     * @apiSuccess {Integer}		bonuses						Количество использованных пользователем бонусов (за период -24 - -0 часа).
     * @apiSuccess {Integer}		steps						Количество использованных пользователем шагов (за период -24 - -0 часа).
     * @apiSuccess {Integer}		yesterdayBonuses			Количество использованных пользователем бонусов (за период -48 - -24 часа).
     * @apiSuccess {Integer}		yesterdaySteps				Количество использованных пользователем шагов (за период -48 - -24 часа).
	 *
	 * @apiVersion 0.1.0
	 */
	
	public function actionGet()
	{
		$model = new GetBonusesForm();
		return $model->getBonuses();
	}

}
