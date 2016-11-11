<?php

namespace frontend\modules\api\models;

use yii\base\Model;
use common\models\db\User;
use Yii;
use common\components\FacebookManagerComponent;

/**
 * Description of LoginForm
 *
 * @author gorohovvalerij
 */
class LoginForm extends Model
{

	public $fbUserId;
	public $fbAccessToken;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			// phone are both required
			[['fbUserId', 'fbAccessToken'], 'required'],
			['fbAccessToken', 'string'],
			['fbUserId', 'integer']
		];
	}

	public function login()
	{
		if (!$this->validate()) {
			return false;
		}
		
		if (!FacebookManagerComponent::validateAccessToken($this->fbUserId, $this->fbAccessToken)) {
			$this->addError('facebook', "Access Denied");
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
