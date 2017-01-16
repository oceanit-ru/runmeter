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
class GetBonusesForm extends Model
{

	private $user;

	public function getBonuses()
	{
		$this->user = User::getUser();
		$serializedArray = array();
		$serializedArray['bonuses'] = $this->user->bonuses();
		$serializedArray['steps'] = $this->user->steps();
		/* @var $userUsedBonuses UserUsedBonuses */
		$userUsedBonuses = UserUsedBonuses::find()->where(['userId' => $this->user->userId])->one();
		if (isset($userUsedBonuses)) {
			$serializedArray['userUsedBonuses'] = $userUsedBonuses->serializationToArray();
		}
		return $serializedArray;
	}

}
