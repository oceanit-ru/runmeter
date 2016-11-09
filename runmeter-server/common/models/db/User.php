<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of User
 *
 * @author gorohovvalerij
 */
class User extends BaseUser
{
	
	public static function findIdentityByFBUserId($fbUserId) {
		return static::find()->where(['fbUserId' => $fbUserId])->one();
	}
	//put your code here
}
