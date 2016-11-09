<?php

namespace frontend\modules\api\models;

use yii\base\Model;
use common\models\db\User;
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
	public $startDate;
	public $endDate;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['bonuses', 'usedBonuses', 'startDate', 'endDate'], 'required'],
		];
	}

	public function login()
	{
		if (!$this->validate()) {
			return false;
		}
		$user = User::findIdentityByFBUserId($this->fbUserId);
		if (!isset($user)) {
			return $this->registration();
		}
		return true;
	}

	public function registration()
	{
		$db = Yii::$app->db;
		$transaction = $db->beginTransaction();
		$user = new User();
		$user->fbUserId = $this->fbUserId;
		$user->bonuses = 0;
		try {
			if ($user->save()) {
				$transaction->commit();
			} else {
				$this->addError('transaction', 'User not save!');
				$transaction->rollBack();
				return false;
			}
		} catch (Exception $exc) {
			$this->addError('transaction', $exc->getMessage());
			$transaction->rollBack();
			return false;
		}
		return true;
	}

}
