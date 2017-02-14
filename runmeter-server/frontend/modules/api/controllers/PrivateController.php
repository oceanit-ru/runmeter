<?php

namespace frontend\modules\api\controllers;

use common\models\db\User;
use common\models\db\AccessToken;
use Yii;
use yii\base\Controller;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\web\NotFoundHttpException;

/**
 * Description of PrivateController
 *
 * @author gorohovvalerij
 */
class PrivateController extends Controller
{

	/**
	 * {@inheritDoc}
	 * @see \yii\rest\Controller::behaviors()
	 */
	public function behaviors()
	{
		$behaviors = parent::behaviors();

		$behaviors['contentNegotiator'] = [
			'class' => ContentNegotiator::className(),
			'formats' => [
				'application/json' => Response::FORMAT_JSON,
			],
		];

		return $behaviors;
	}

	/**
	 * {@inheritDoc}
	 * @see \yii\web\Controller::beforeAction()
	 */
	public function beforeAction($action)
	{
		if (!parent::beforeAction($action)) {
			return false;
		}

		$user = $this->getUser();

		if (!$user) {
			throw new NotFoundHttpException("User not found");
		}

		Yii::$app->user->login($user);

		return true;
	}

	/** Get user by token from query string
	 * @return null|static
	 */
	protected function getUser()
	{
		$fbUser = $this->getFBUser();
		if (is_null($fbUser)) {
			$vkUser = $this->getVKUser();
			if (is_null($vkUser)) {
				$this->getResponseFormatForInvalidUserId();
			}
			return $vkUser;
		}
		return $fbUser;
	}

	/** Get user id
	 * @return array|mixed
	 */
	private function getFBUser()
	{
		$fbUserId = Yii::$app->request->get("fbUserId");
		//var_dump(Yii::$app->request->get("fbUserId")); die();
		if (empty($fbUserId)) {
			$fbUserId = Yii::$app->request->post("fbUserId");
		}
		if (empty($fbUserId)) {
			return NULL;
		}
		$fbUser = User::findIdentityByFBUserId($fbUserId);
		if (empty($fbUser)) {
			return NULL;
		}
		return $fbUser;
	}
	
	/** Get user id
	 * @return array|mixed
	 */
	private function getVKUser()
	{
		$vkUserId = Yii::$app->request->get("vkUserId");
			Yii::warning($vkUserId);
		if (empty($vkUserId)) {
			$vkUserId = Yii::$app->request->post("vkUserId");
			Yii::warning($vkUserId);
		}
		if (empty($vkUserId)) {
			return NULL;
		}
		$vkUser = User::findIdentityByVKUserId($vkUserId);
		Yii::warning($vkUser);
		if (empty($vkUser)) {
			return NULL;
		}
		return $vkUser;
	}

	private function getResponseFormatForInvalidUserId()
	{
		Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		echo json_encode(["meta" => ['success' => false, 'error' => 'error login by facebook user id', 'invalidUserId' => true],
			"data" => []]);
		Yii::$app->end();
	}

}
