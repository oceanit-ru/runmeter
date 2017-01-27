<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\controllers\PrivateController;
use yii\filters\VerbFilter;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use ErrorException;
use common\components\helpers\ModelHelper;
use Yii;
use frontend\modules\api\models\SaveProgressForm;
use frontend\modules\api\models\GetProgressForm;

class ProgressController extends PrivateController
{

	public function behaviors()
	{
		$behaviors = parent::behaviors();

		$behaviors['verbs'] = [
			'class' => VerbFilter::className(),
			'actions' => [
				'save' => ['post'],
				'load' => ['get']
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
	 * @apiParam {String}		fbUserId		Facebook UserId.
	 * 
	 * @apiParam {Integer}		bonuses			Количество начисляемых бонусов.
	 * @apiParam {Integer}		steps			Количество начисляемых шагов.
	 * @apiParam {Integer}		usedBonuses		Количество использованных бонусов.
	 * @apiParam {Integer}		usedSteps		Количество использованных шагов.
	 * @apiParam {SQL_DateTime}	startTime		Начало периода последнего использования шагов.
	 * @apiParam {SQL_DateTime}	endTime			Конец периода последнего использования шагов.
	 * 
	 * @apiSuccess {Integer}		bonuses						Общее количество бонусов.
	 * @apiSuccess {Integer}		steps						Общее количество шагов.
	 * @apiSuccess {Object}			userUsedBonuses				Использованных пользователем бонусов за период.
	 * @apiSuccess {Integer}		userUsedBonuses.bonuses		Количество использованных пользователем бонусов за период.
	 * @apiSuccess {Integer}		userUsedBonuses.steps		Количество использованных пользователем шагов за период.
	 * @apiSuccess {SQL_DateTime}	userUsedBonuses.startTime	Начало периода последнего использования шагов.
	 * @apiSuccess {SQL_DateTime}	userUsedBonuses.endTime		Конец периода последнего использования шагов.
	 *
	 * @apiVersion 0.1.0
	 */
	public function actionSave()
	{
		$modelForm = new SaveProgressForm();
		$modelForm->load(Yii::$app->request->post(), '');
		if ($modelForm->saveProgress()) {
			return []; //$this->actionGet();
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
	 * @apiParam {String}		fbUserId		Facebook UserId.
	 * 
	 * @apiSuccess {Integer}		bonuses						Общее количество бонусов.
	 * @apiSuccess {Integer}		steps						Общее количество шагов.
	 * @apiSuccess {Object}			userUsedBonuses				Использованных пользователем бонусов за период.
	 * @apiSuccess {Integer}		userUsedBonuses.bonuses		Количество использованных пользователем бонусов за период.
	 * @apiSuccess {Integer}		userUsedBonuses.steps		Количество использованных пользователем шагов за период.
	 * @apiSuccess {SQL_DateTime}	userUsedBonuses.startTime	Начало периода последнего использования шагов.
	 * @apiSuccess {SQL_DateTime}	userUsedBonuses.endTime		Конец периода последнего использования шагов.
	 *
	 * @apiVersion 0.1.0
	 */
	public function actionLoad()
	{
		$modelForm = new GetProgressForm();
		$modelForm->load(Yii::$app->request->get(), '');
		if ($modelForm->loadProgress()) {
			if ($modelForm->progress === NULL) {
				return [];
			} else {
				return $modelForm->progress->serializationToArray();
			}
		} else {
			throw new ErrorException(ModelHelper::getFirstError($modelForm));
		}
	}

}