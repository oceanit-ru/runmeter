<?php

namespace frontend\modules\api\models;

use yii\base\Model;
use common\models\db\User;
use common\models\db\UserUsedBonuses;
use common\models\db\DepositHistory;
use Yii;

/**
 * Description of LoginForm
 *
 * @author gorohovvalerij
 */
class DepositBonusesForm extends Model
{

	public $bonuses;
	public $steps;
	public $usedBonuses;
	public $usedSteps;
	public $startTime;
	public $endTime;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['bonuses', 'steps', 'usedBonuses', 'usedSteps'], 'integer'],
			[['startTime', 'endTime'], 'safe'],
		];
	}

	public function deposit()
	{
		//var_dump($this->attributes); die();
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

		$depositBonuses = new DepositHistory();
		$depositBonuses->userId = $user->userId;
		$depositBonuses->bonuses = $this->bonuses;
		$depositBonuses->steps = $this->steps;

		if (!($depositBonuses->save())) {
			$this->addError('user', 'Bonuses not save');
			$transaction->rollBack();
			return false;
		}

		if (!$this->saveUserUsedBonuses($user)) {
			$this->addError('user', 'Used bonuses not save');
			$transaction->rollBack();
			return false;
		}

		$transaction->commit();

		return true;
	}

	private function saveUserUsedBonuses($user)
	{
		if (empty($user->userUsedBonuses)) {
			$userUsedBonuses = new UserUsedBonuses();
			$userUsedBonuses->userId = $user->userId;
		} else {
			$userUsedBonuses = $user->userUsedBonuses[0];
		}
		$userUsedBonuses->bonuses = $this->usedBonuses;
		$userUsedBonuses->steps = $this->usedSteps;
		$userUsedBonuses->startTime = $this->startTime;
		$userUsedBonuses->endTime = $this->endTime;

		if (!($userUsedBonuses->save())) {
			return false;
		}
		return true;
	}

}
