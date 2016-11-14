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
	
	/**
	 * @api {get} /bonuses/get Получение настроек
	 * @apiDescription Получение настроек.
	 * @apiError ErrorException.
	 * @apiGroup Settings
	 * 
     * @apiSuccess {Number}			initialReferencePeriod				Максимальный стартовый учетный период.
     * @apiSuccess {Number}			maximumReferencePeriod				Максимальный учетный период.
     * @apiSuccess {Integer}		bonusDivider						Делитель для формулы преобразования шагов в бонусы.
     * @apiSuccess {Integer}		bonusThreshold						Порог для доступных шагов.
     * @apiSuccess {Integer}		maximumBonusesInReferencePeriod		Максимальное доступное кол-во бонусов за период.
     * @apiSuccess {Bool}			useDataEnteredByUser				Использовать введенные пользователем данные.
	 *
	 * @apiVersion 0.1.0
	 */
	
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
