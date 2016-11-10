<?php

namespace frontend\modules\api\models;

use yii\base\Model;
use common\models\db\User;
use common\models\db\UserUsedBonuses;
use Yii;

/**
 * Description of LoginForm
 *
 * @author gorohovvalerij
 */
class DepositBonusesForm extends Model
{

	public $bonuses;
	public $usedBonuses;
	public $startTime;
	public $endTime;

	
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
            [['usedBonuses', 'bonuses'], 'integer'],
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

		$user->bonuses += $this->bonuses;

		if (!($user->save())) {
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
		$userUsedBonuses->startTime = $this->startTime;
		$userUsedBonuses->endTime = $this->endTime;

		if (!($userUsedBonuses->save())) {
			return false;
		}
		return true;
	}

}
