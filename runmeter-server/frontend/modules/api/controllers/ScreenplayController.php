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
	 * @api {get} /screenplay/load Загрузка сценария
	 * @apiDescription Загрузка сценария.
	 * @apiError ErrorException.
	 * @apiGroup Screenplay
	 *
	 * @apiParam {String}		[fbUserId]						Facebook UserId.
	 * @apiParam {String}		[vkUserId]						Vkontakte UserId.
	 * 
	 * @apiParam {Integer}		[updateAt]						Дата обновления локальной версии.
	 * @apiParam {Integer}		[screenplayId]					ID сценария.
	 * 
	 * @apiSuccess {Integer}	screenplayId					ID сценария.
	 * @apiSuccess {String}		name							Название.
	 * @apiSuccess {Integer}	createdAt						Создан.
	 * @apiSuccess {Integer}	updateAt						Обновлен.
	 * @apiSuccess {Object[]}	locations						Локации.
	 * @apiSuccess {Integer}	locations.locationId				ID локации.
	 * @apiSuccess {Integer}	locations.screenplayId				ID сценария.
	 * @apiSuccess {String}		locations.name						Название.
	 * @apiSuccess {Integer}	locations.number					Порядковый номер.
	 * @apiSuccess {Integer}	locations.createdAt					Создана.
	 * @apiSuccess {Integer}	locations.updateAt					Обновлена.
	 * @apiSuccess {Object[]}	locations.scenes					Сцены.
	 * @apiSuccess {Integer}	locations.scenes.sceneId				ID сцены.
	 * @apiSuccess {Integer}	locations.scenes.locationId				ID локации.
	 * @apiSuccess {String}		locations.scenes.name					Название.
	 * @apiSuccess {Integer}	locations.scenes.number					Порядковый номер.
	 * @apiSuccess {Integer}	locations.scenes.image					Изображение.
	 * @apiSuccess {Integer}	locations.scenes.displayedButtonCount	Количество единовременно отображаемых кнопок (без учета текста).
	 * @apiSuccess {Integer}	locations.scenes.createdAt				Создана.
	 * @apiSuccess {Integer}	locations.scenes.updateAt				Обновлена.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons			Кнопки.
	 * @apiSuccess {Object[]}	locations.scenes.sceneButtons.sceneButtonId				ID кнопки.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.sceneId					ID сцены.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.number					Порядковый номер.
	 * @apiSuccess {String}		locations.scenes.sceneButtons.text						Текст.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.action					Тип (Текст => 0, Вопрос, Переход).
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.answerTextButtonId		Кнопка с ответом.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.segueLocationId			Локация перехода.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.segueSceneId				Сцена перехода.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.showTextButtonId			Отображаемая при переходе кнопка.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.cost						Стоимость кнопки.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.createdAt					Создана.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.updateAt		I			Обновлена.
	 * @apiSuccess {Object[]}	locations.scenes.sceneButtons.conditionPressedButtons	Условия (Нажата кнопка).
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionPressedButtons.conditionPressedButtonId		ID условия.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionPressedButtons.sceneButtonId					ID кнопки.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionPressedButtons.verifiableSceneButtonId		ID проверяемой кнопки.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionPressedButtons.condition						Условие.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionPressedButtons.createdAt						Создано.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionPressedButtons.updateAt						Обновлено.
	 * @apiSuccess {Object[]}	locations.scenes.sceneButtons.conditionLoadScenes		Условия (Загружена сцена).
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionLoadScenes.conditionPressedButtonId			ID условия.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionLoadScenes.sceneButtonId						ID кнопки.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionLoadScenes.sceneId							ID сцены.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionLoadScenes.condition							Условие.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionLoadScenes.createdAt							Создано.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionLoadScenes.updateAt							Обновлено.
	 * @apiSuccess {Object[]}	locations.scenes.sceneButtons.conditionVisitLocations	Условия (Посещена локация).
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionVisitLocations.conditionPressedButtonId		ID условия.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionVisitLocations.sceneButtonId					ID кнопки.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionVisitLocations.locationId					ID локации.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionVisitLocations.condition						Условие.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionVisitLocations.createdAt						Создано.
	 * @apiSuccess {Integer}	locations.scenes.sceneButtons.conditionVisitLocations.updateAt						Обновлено.
	 *
	 *
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
