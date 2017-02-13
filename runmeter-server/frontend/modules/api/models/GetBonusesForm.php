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
class GetBonusesForm extends TranslatedForm
{

	private $user;

	public function getBonuses()
	{
		$this->user = User::getUser();
		$serializedArray = array();
		$serializedArray['bonuses'] = $this->user->bonuses();
		$serializedArray['steps'] = $this->user->steps();
		$serializedArray['yesterdayBonuses'] = $this->user->yesterdayBonuses();
		$serializedArray['yesterdaySteps'] = $this->user->yesterdaySteps();
		return $serializedArray;
	}

}
