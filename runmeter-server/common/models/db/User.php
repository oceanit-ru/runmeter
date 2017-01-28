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
 * @property string $password 
 * @author gorohovvalerij
 */
class User extends BaseUser implements IdentityInterface
{

	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;
	const ROLE_DEFAULT = 0;
	const ROLE_FB_USER = 1;
	const ROLE_VK_USER = 2;
	const ROLE_ADMIN = 3;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['role'], 'integer'],
			['role', 'default', 'value' => static::ROLE_DEFAULT],
			[['email', 'passwordHash', 'password', 'accessToken'], 'string', 'max' => 255],
			[['email'], 'unique'],
			[['fbUserId'], 'unique'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function load($data, $formName = null)
	{
		$result = parent::load($data, $formName);
		if (isset($data['User']['password'])) {
			if (!empty($data['User']['password'])) {
				$this->setPassword($data['User']['password']);
			}
		}
		return $result;
	}

	/**
	 * 
	 * @return string
	 */
	public function getAccessToken()
	{
		if (!isset($this->accessToken)) {
			$this->accessToken = Yii::$app->security->generateRandomString();
			$this->save();
		}

		return $this->accessToken;
	}
	
	/**
	 * 
	 * @return boolean
	 */
	public function isAdmin()
	{
		return ($this->role == static::ROLE_ADMIN);
	}

	/**
	 * Finds user by username
	 *
	 * @param string $username
	 * @return static|null
	 */
	public static function findByEmail($username)
	{
		return static::findOne(['email' => $username, 'role' => self::ROLE_ADMIN]);
	}

	/**
	 * 
	 * @param int $fbUserId
	 * @return int
	 */
	public static function findIdentityByFBUserId($fbUserId)
	{
		return static::find()->where(['fbUserId' => $fbUserId])->one();
	}
	
	/**
	 * 
	 * @param int $fbUserId
	 * @return int
	 */
	public static function findIdentityByVKUserId($vkUserId)
	{
		return static::find()->where(['vkUserId' => $vkUserId])->one();
	}

	public function getAuthKey()
	{
		if ($this->role == static::ROLE_FB_USER) {
			return $this->fbUserId;
		} else if ($this->role == static::ROLE_VK_USER) {
			return $this->vkUserId;
		} else if ($this->role == static::ROLE_ADMIN) {
			return $this->getAccessToken();
		} else {
			return '';
		}
	}

	/**
	 * @inheritdoc
	 */
	public function getId()
	{
		return $this->getPrimaryKey();
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey)
	{
		if ($this->getAuthKey() == $authKey) {
			return true;
		}
		return false;
	}

	/**
	 * Validates password
	 *
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		return Yii::$app->security->validatePassword($password, $this->passwordHash);
	}

	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->passwordHash = Yii::$app->security->generatePasswordHash($password);
	}

	/**
	 * 
	 * @return string
	 */
	public function getPassword()
	{
		return '';
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id)
	{
		return User::find()->where(['userId' => $id])->one();
	}

	/**
	 * 
	 * @param string $token
	 * @param type $type
	 * @return boolean
	 * @throws NotSupportedException
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		$user = static::findOne(['accessToken' => $token]);
		if (isset($user)) {
			return $user;
		}

		throw new NotSupportedException('User not found');
	}

	/**
	 * 
	 * Get user
	 * @return User
	 */
	public static function getUser()
	{
		return Yii::$app->user->getIdentity();
	}

	//put your code here

	/**
	 * 
	 * @return mixed[]
	 */
	public static function getRoles()
	{
		return[
			static::ROLE_DEFAULT => \Yii::t('app', 'Default'),
			static::ROLE_FB_USER => \Yii::t('app', 'Пользователь FB'),
			static::ROLE_VK_USER => \Yii::t('app', 'Пользователь VK'),
			static::ROLE_ADMIN => \Yii::t('app', 'Администратор')
		];
	}
	
	/**
	 * 
	 * @return int
	 */
	public function bonuses()
	{
		return DepositHistory::sumBonusesForUser($this->userId);
	}

	/**
	 * 
	 * @return int
	 */
	public function steps()
	{
		return DepositHistory::sumStepsForUser($this->userId);
	}

}
