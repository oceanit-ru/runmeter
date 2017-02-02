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
use frontend\modules\api\models\ResetProgressForm;

class ProgressController extends PrivateController
{

	public function behaviors()
	{
		$behaviors = parent::behaviors();

		$behaviors['verbs'] = [
			'class' => VerbFilter::className(),
			'actions' => [
				'save' => ['post'],
				'load' => ['get'],
				'reset' => ['post']
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
	 * @api {post} /progress/save Сохранение прогресса
	 * @apiDescription Сохранение прогресса.
	 * @apiError ErrorException.
	 * @apiGroup Progress
	 *
	 * @apiParam {String}		[fbUserId]						Facebook UserId.
	 * @apiParam {String}		[vkUserId]						Vkontakte UserId.
	 * 
	 * @apiParam {Integer}		screenplayId				ID сценария.
	 * @apiParam {Integer}		currentLocationId			Текущая локация.
	 * @apiParam {Integer}		currentSceneId				Текущая сцена.
	 * @apiParam {Integer}		currentButtonId				Текущая текстовая кнопка.
	 * @apiParam {Integer}		createdAt					Создан.
	 * @apiParam {Integer}		updateAt					Обновлен.
	 * @apiParam {Integer[]}	loadedScenes				Загруженные сцены.
	 * @apiParam {Integer[]}	visitedLocations			Посещенные локации.
	 * @apiParam {Integer[]}	pressedButtons				Нажатые кнопки.
	 * @apiParam {Object[]}		buttonsPayments				Оплаченные кнопки.
	 * @apiParam {Integer}		buttonsPayments.buttonId	ID кнопки.
	 * @apiParam {Integer}		buttonsPayments.cost		Оплаченная стоимость.
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
	 * @api {get} /progress/load Загрузка прогресса
	 * @apiDescription Загрузка прогресса.
	 * @apiError ErrorException.
	 * @apiGroup Progress
	 *
	 * @apiParam {String}		[fbUserId]						Facebook UserId.
	 * @apiParam {String}		[vkUserId]						Vkontakte UserId.
	 * 
	 * @apiParam {Integer}		[updateAt]						Дата обновления локальной версии.
	 * @apiParam {Integer}		screenplayId					ID сценария.
	 * 
	 * @apiSuccess {Integer}		userProgressId				ID прогресса.
	 * @apiSuccess {Integer}		screenplayId				ID сценария.
	 * @apiSuccess {Integer}		currentLocationId			Текущая локация.
	 * @apiSuccess {Integer}		currentSceneId				Текущая сцена.
	 * @apiSuccess {Integer}		currentButtonId				Текущая текстовая кнопка.
	 * @apiSuccess {Integer}		createdAt					Создан.
	 * @apiSuccess {Integer}		updateAt					Обновлен.
	 * @apiSuccess {Integer[]}		loadedScenes				Загруженные сцены.
	 * @apiSuccess {Integer[]}		visitedLocations			Посещенные локации.
	 * @apiSuccess {Integer[]}		pressedButtons				Нажатые кнопки.
	 * @apiSuccess {String(JSON)}	buttonsPayments					Оплаченные кнопки.
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

	/**
	 * @api {post} /progress/reset Сброс прогресса
	 * @apiDescription Сброс прогресса.
	 * @apiError ErrorException.
	 * @apiGroup Progress
	 *
	 * @apiParam {String}		[fbUserId]						Facebook UserId.
	 * @apiParam {String}		[vkUserId]						Vkontakte UserId.
	 * 
	 * @apiParam {Integer}		screenplayId					ID сценария.
	 *
	 * @apiVersion 0.1.0
	 */
	public function actionReset()
	{
		$modelForm = new ResetProgressForm();
		$modelForm->load(Yii::$app->request->post(), '');
		if ($modelForm->resetProgress()) {
			return [];
		} else {
			throw new ErrorException(ModelHelper::getFirstError($modelForm));
		}
	}

}
