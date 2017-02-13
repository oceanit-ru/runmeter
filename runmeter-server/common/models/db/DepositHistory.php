<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;


use yii\db\Expression;

/**
 * Description of DepositHistory
 *
 * @author gorohovvalerij
 */
class DepositHistory extends BaseDepositHistory
{

	//put your code here
	public static function sumTodayBonusesForUser($userId)
	{
		return static::find()->where(['userId' => $userId])->andWhere(['between','createdAt', new Expression('NOW() - INTERVAL 1 DAY'), new Expression('NOW()')])->sum('bonuses');
	}
	
	public static function sumTodayStepsForUser($userId)
	{
		return static::find()->where(['userId' => $userId])->andWhere(['between','createdAt', new Expression('NOW() - INTERVAL 1 DAY'), new Expression('NOW()')])->sum('steps');
	}
	
	//put your code here
	public static function sumYesterdayBonusesForUser($userId)
	{
		return static::find()->where(['userId' => $userId])->andWhere(['between','createdAt', new Expression('NOW() - INTERVAL 2 DAY'), new Expression('NOW() - INTERVAL 1 DAY')])->sum('bonuses');
	}
	
	public static function sumYesterdayStepsForUser($userId)
	{
		return static::find()->where(['userId' => $userId])->andWhere(['between','createdAt', new Expression('NOW() - INTERVAL 2 DAY'), new Expression('NOW() - INTERVAL 1 DAY')])->sum('steps');
	}
	
	

}
