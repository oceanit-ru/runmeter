<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\modules\api\models;

use yii\base\Model;
use yii\helpers\Json;
use common\models\db\User;
use common\models\db\UserProgress;
use common\models\db\UserVisitedLocations;
use common\models\db\UserButtonsPayments;
use common\models\db\UserLoadedScenes;
use common\models\db\UserPressedButtons;
use Yii;

/**
 * Description of ResetProgressForm
 *
 * @author gorohovvalerij
 */
class ResetProgressForm extends Model
{

	public $screenplayId;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['screenplayId'], 'integer']
		];
	}

	public function resetProgress()
	{
		if (!$this->validate()) {
			return false;
		}

		$user = User::getUser();
		if (!isset($user)) {
			$this->addError('user', 'User not validate');
			return false;
		}  
		$progress = UserProgress::find()->where(['userId' => $user->userId,
			'screenplayId' => $this->screenplayId])->one();
		if ($progress !== NULL) {
			return $progress->delete();
		}
		return true;
	}

	//put your code here
}
