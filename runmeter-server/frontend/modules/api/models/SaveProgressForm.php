<?php

namespace frontend\modules\api\models;

use yii\base\Model;
use yii\helpers\Json;
use common\models\db\User;
use common\models\db\UserProgress;
use common\models\db\UserVisitedLocations;
use common\models\db\UserButtonsPayments;
use common\models\db\UserLoadedScenes;
use common\models\db\UserPressedButtons;
use Yii;

/**
 * Description of LoginForm
 *
 * @author gorohovvalerij
 */
class SaveProgressForm extends TranslatedForm
{

	public $screenplayId;
	public $currentLocationId;
	public $currentSceneId;
	public $currentButtonId;
	public $visitedLocations;
	public $buttonsPayments;
	public $loadedScenes;
	public $pressedButtons;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['screenplayId', 'currentLocationId', 'currentSceneId', 'currentButtonId'], 'integer'],
			[['visitedLocations', 'buttonsPayments', 'loadedScenes', 'pressedButtons'], 'default'],
		];
	}

	public function load($data, $formName = null)
	{
		$result = parent::load($data, $formName);
		if (isset($data['buttonsPayments'])) {
			$this->buttonsPayments = Json::decode($data['buttonsPayments']);
		}
		return $result;
	}

	public function saveProgress()
	{

		\Yii::warning($this->validate(), 'validate_safeProgress');
		if (!$this->validate()) {
			return false;
		}

		$db = Yii::$app->db;
		$transaction = $db->beginTransaction();
		$user = User::getUser();
		if (!isset($user)) {
			$this->addError('user', 'User not validate');
			$transaction->rollBack();
			return false;
		}

		Yii::warning(['userId' => $user->userId,
			'screenplayId' => $this->screenplayId]);
		$progress = UserProgress::find()->where(['userId' => $user->userId,
					'screenplayId' => $this->screenplayId])->one();
		if ($progress === NULL) {
			$progress = new UserProgress();
			$progress->userId = $user->userId;
			$progress->screenplayId = $this->screenplayId;
		}
		$progress->currentLocationId = $this->currentLocationId;
		$progress->currentSceneId = $this->currentSceneId;
		$progress->currentButtonId = $this->currentButtonId;
		$progress->updateAt = Yii::$app->formatter->asDatetime(time());
		if (!($progress->save())) {
			$this->addError('progress', 'Progress not save');
			$transaction->rollBack();
			return false;
		}

		if (!empty($this->loadedScenes)) {
			$newLoadedScenes = array_diff($this->loadedScenes, $progress->loadedScenes());
			foreach ($newLoadedScenes as $value) {
				$sceneLoaded = new UserLoadedScenes();
				$sceneLoaded->userProgressId = $progress->userProgressId;
				$sceneLoaded->sceneId = $value;
				if (!($sceneLoaded->save())) {
					$this->addError('progress', 'Progress not save');
					$transaction->rollBack();
					return false;
				}
			}
		}

		if (!empty($this->visitedLocations)) {
			$newVisitedLocations = array_diff($this->visitedLocations, $progress->visitedLocations());
			foreach ($newVisitedLocations as $value) {
				$visitedLocation = new UserVisitedLocations();
				$visitedLocation->userProgressId = $progress->userProgressId;
				$visitedLocation->locationId = $value;
				if (!($visitedLocation->save())) {
					$this->addError('progress', 'Progress not save');
					$transaction->rollBack();
					return false;
				}
			}
		}

		if (!empty($this->pressedButtons)) {
			$newPressedButtons = array_diff($this->pressedButtons, $progress->pressedButtons());
			foreach ($newPressedButtons as $value) {
				$pressedButton = new UserPressedButtons();
				$pressedButton->userProgressId = $progress->userProgressId;
				$pressedButton->buttonId = $value;
				if (!($pressedButton->save())) {
					$this->addError('progress', 'Progress not save');
					$transaction->rollBack();
					return false;
				}
			}
		}


		if (!empty($this->buttonsPayments)) {
			foreach ($this->buttonsPayments as $value) {
				$buttonPayment = UserButtonsPayments::find()->where(['userProgressId' => $progress->userProgressId, 'buttonId' => $value['buttonId']])->one();
				if ($buttonPayment === NULL) {
					$buttonPayment = new UserButtonsPayments();
					$buttonPayment->userProgressId = $progress->userProgressId;
					$buttonPayment->buttonId = $value['buttonId'];
				}
				$buttonPayment->cost = $value['cost'];
				if (!($buttonPayment->save())) {
					$this->addError('progress', 'Progress not save');
					$transaction->rollBack();
					return false;
				}
			}
		}
//
		$transaction->commit();

		return true;
	}
}
