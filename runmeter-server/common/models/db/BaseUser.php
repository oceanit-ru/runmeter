<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $userId
 * @property string $fbUserId
 * @property string $email
 * @property string $passwordHash
 * @property string $accessToken
 * @property integer $role
 *
 * @property DepositHistory[] $depositHistories
 * @property UserLoadScene[] $userLoadScenes
 * @property UserPressedButton[] $userPressedButtons
 * @property UserUsedBonuses[] $userUsedBonuses
 * @property UserVisitLocation[] $userVisitLocations
 */
class BaseUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['role'], 'integer'],
            [['fbUserId', 'email', 'passwordHash', 'accessToken'], 'string', 'max' => 255],
            [['fbUserId'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userId' => 'User ID',
            'fbUserId' => 'Fb User ID',
            'email' => 'Email',
            'passwordHash' => 'Password Hash',
            'accessToken' => 'Access Token',
            'role' => 'Role',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDepositHistories()
    {
        return $this->hasMany(DepositHistory::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLoadScenes()
    {
        return $this->hasMany(UserLoadScene::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPressedButtons()
    {
        return $this->hasMany(UserPressedButton::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserUsedBonuses()
    {
        return $this->hasMany(UserUsedBonuses::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserVisitLocations()
    {
        return $this->hasMany(UserVisitLocation::className(), ['userId' => 'userId']);
    }
}
