<?php

namespace frontend\modules\api\models;

use yii\base\Model;
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
class SaveProgressForm extends Model
{

	public $screenplayId;
	public $currentLocationiId;
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
			[['screenplayId', 'currentLocationiId', 'currentSceneId', 'currentButtonId'], 'integer'],
			[['visitedLocations', 'buttonsPayments', 'loadedScenes', 'pressedButtons'], 'string'],
		];
	}

	public function saveProgress()
	{
				\Yii::warning($this->attributes);
//		if (!$this->validate()) {
//			return false;
//		}
//
//		$db = Yii::$app->db;
//		$transaction = $db->beginTransaction();
//		$user = User::getUser();
//		if (!isset($user)) {
//			$this->addError('user', 'User not validate');
//			$transaction->rollBack();
//			return false;
//		}
//
//		$depositBonuses = new DepositHistory();
//		$depositBonuses->userId = $user->userId;
//		$depositBonuses->bonuses = $this->bonuses;
//		$depositBonuses->steps = $this->steps;
//
//		if (!($depositBonuses->save())) {
//			$this->addError('user', 'Bonuses not save');
//			$transaction->rollBack();
//			return false;
//		}
//
//		if (empty($user->userUsedBonuses)) {
//			$userUsedBonuses = new UserUsedBonuses();
//			$userUsedBonuses->userId = $user->userId;
//		} else {
//			$userUsedBonuses = $user->userUsedBonuses[0];
//		}
//		$userUsedBonuses->bonuses = $this->usedBonuses;
//		$userUsedBonuses->steps = $this->usedSteps;
//		$userUsedBonuses->startTime = $this->startTime;
//		$userUsedBonuses->endTime = $this->endTime;
//
//		if (!($userUsedBonuses->save())) {
//			$this->addError('user', 'Used bonuses not save');
//			$transaction->rollBack();
//			return false;
//		}
//
//		$transaction->commit();
//
//		return true;
	}

//	private function saveUserUsedBonuses($user)
//	{
//		if (empty($user->userUsedBonuses)) {
//			$userUsedBonuses = new UserUsedBonuses();
//			$userUsedBonuses->userId = $user->userId;
//		} else {
//			$userUsedBonuses = $user->userUsedBonuses[0];
//		}
//		$userUsedBonuses->bonuses = $this->usedBonuses;
//		$userUsedBonuses->steps = $this->usedSteps;
//		$userUsedBonuses->startTime = $this->startTime;
//		$userUsedBonuses->endTime = $this->endTime;
//
//		if (!($userUsedBonuses->save())) {
//			return false;
//		}
//		return true;
//	}

}
