<?php

namespace frontend\modules\api\models;

use yii\base\Model;
use common\models\db\User;
use common\models\db\UserUsedBonuses;
use common\models\db\DepositHistory;
use yii\db\Expression;
use Yii;

/**
 * Description of LoginForm
 *
 * @author gorohovvalerij
 */
class DepositBonusesForm extends TranslatedForm
{
	public $bonuses;
	public $steps;
	public $yesterdayBonuses;
	public $yesterdaySteps;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['bonuses', 'steps', 'yesterdayBonuses', 'yesterdaySteps'], 'integer']
		];
	}

	public function deposit()
	{
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
		
		if ($this->bonuses > 0) {
			$depositBonuses = new DepositHistory();
			$depositBonuses->userId = $user->userId;
			$depositBonuses->bonuses = $this->bonuses;
			$depositBonuses->steps = $this->steps;
			if (!($depositBonuses->save())) {
				$this->addError('user', 'Bonuses not save');
				$transaction->rollBack();
				return false;
			}
		}
		
		if ($this->yesterdayBonuses > 0) {
			$depositYesterdayBonuses = new DepositHistory();
			$depositYesterdayBonuses->userId = $user->userId;
			$depositYesterdayBonuses->bonuses = $this->yesterdayBonuses;
			$depositYesterdayBonuses->steps = $this->yesterdaySteps;
			$depositYesterdayBonuses->createdAt = new Expression('NOW() - INTERVAL 1 DAY');
			if (!($depositYesterdayBonuses->save())) {
				$this->addError('user', 'Bonuses not save');
				$transaction->rollBack();
				return false;
			}
		}

		$transaction->commit();
		return true;
	}

}
