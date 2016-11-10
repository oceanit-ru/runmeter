<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

use \yii\web\IdentityInterface;
use Yii;

/**
 * Description of User
 *
 * @author gorohovvalerij
 */
class User extends BaseUser implements IdentityInterface
{

	public static function findIdentityByFBUserId($fbUserId)
	{
		return static::find()->where(['fbUserId' => $fbUserId])->one();
	}

	public function getAuthKey()
	{
		return $this->fbUserId;
	}

	public function getId()
	{
		return $this->userId;
	}

	public function validateAuthKey($authKey)
	{
		if ($this->fbUserId == $authKey) {
			return true;
		}
		return false;
	}

	public static function findIdentity($id)
	{
		return User::find()->where($id)->one();
	}

	public static function findIdentityByAccessToken($token, $type = null)
	{
		return $tihs->findIdentityByFBUserId($token);
	}
	
	/** Get user
	 * @return User
	 */
	public static function getUser()
	{
		return Yii::$app->user->getIdentity();
	}

	//put your code here
}
