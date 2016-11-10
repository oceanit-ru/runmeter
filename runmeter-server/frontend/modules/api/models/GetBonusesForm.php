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
		$serializedArray['bonuses'] = $this->user->bonuses;
		if (!empty($this->user->userUsedBonuses)) {
			$userUsedBonuses = $this->user->userUsedBonuses[0];
			$serializedArray['usedBonuses'] = $userUsedBonuses->bonuses;
			$serializedArray['startTime'] = $userUsedBonuses->startTime;
			$serializedArray['endTime'] = $userUsedBonuses->endTime;
		}
		return $serializedArray;	
	}

}
