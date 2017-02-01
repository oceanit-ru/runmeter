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
 * Description of GetProgressForm
 *
 * @author gorohovvalerij
 */
class GetProgressForm extends Model
{

	public $screenplayId;
	public $updateAt;

	/* @var $progress UserProgress */
	public $progress;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['screenplayId', 'updateAt'], 'integer']
		];
	}

	public function loadProgress()
	{
		if (!$this->validate()) {
			return false;
		}

		$user = User::getUser();
		if (!isset($user)) {
			$this->addError('user', 'User not validate');
			return false;
		}  
		
		$updateAtSqlFormat = Yii::$app->formatter->asDatetime($this->updateAt);
		$this->progress = UserProgress::find()->where(['userId' => $user->userId,
			'screenplayId' => $this->screenplayId])->andWhere(['>=', 'updateAt', $updateAtSqlFormat])->one();
		if ($this->progress === NULL) {
			$this->progress = NULL;
		}
		return true;
	}

	//put your code here
}
