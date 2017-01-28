<?php

namespace frontend\modules\api\models;

use yii\base\Model;
use common\models\db\User;
use Yii;
use common\components\VkManagerComponent;

/**
 * Description of LoginForm
 *
 * @author gorohovvalerij
 */
class VKLoginForm extends Model
{

	public $vkUserId;
	public $vkAccessToken;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			// phone are both required
			[['vkUserId', 'vkAccessToken'], 'required'],
			['vkAccessToken', 'string'],
			['vkUserId', 'string']
		];
	}

	public function login()
	{
		if (!$this->validate()) {
			return false;
		}
		
		if (!VkManagerComponent::validateAccessToken($this->vkUserId, $this->vkAccessToken)) {
			$this->addError('vkontakte', "Access Denied");
		}
		$user = User::findIdentityByVKUserId($this->vkUserId);
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
		$user->vkUserId = $this->vkUserId;
		$user->role = User::ROLE_VK_USER;
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
