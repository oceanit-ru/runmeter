<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\modules\api\controllers;

use yii\base\Controller;
use frontend\modules\api\models\LoadScreenplayForm;
use common\components\helpers\ModelHelper;
use yii\filters\VerbFilter;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use Yii;
use yii\base\ErrorException;

/**
 * Description of ScreenplayController
 *
 * @author gorohovvalerij
 */
class ScreenplayController extends Controller
{

	public function behaviors()
	{
		$behaviors = parent::behaviors();

		$behaviors['verbs'] = [
			'class' => VerbFilter::className(),
			'actions' => [
				'load' => ['get'],
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
	public function actionLoad()
	{
		$modelForm = new LoadScreenplayForm();
		$modelForm->load(Yii::$app->request->get(), '');
		if ($modelForm->loadScreenplay()) {
			if (isset($modelForm->screenplay)) {
				return $modelForm->screenplay->serializationToArray();
			} else {
				return [];
			}
		} else {
			throw new ErrorException(ModelHelper::getFirstError($modelForm));
		}
	}

}
