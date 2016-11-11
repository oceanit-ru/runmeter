<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of DepositHistory
 *
 * @author gorohovvalerij
 */
class DepositHistory extends BaseDepositHistory
{

	//put your code here
	public static function sumBonusesForUser($userId)
	{
		return static::find()->where(['userId' => $userId])->sum('bonuses');
	}
	
	public static function sumStepsForUser($userId)
	{
		return static::find()->where(['userId' => $userId])->sum('steps');
	}

}
