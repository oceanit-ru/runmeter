<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $userId
 * @property integer $fbUserId
 *
 * @property DepositHistory[] $depositHistories
 * @property UserUsedBonuses[] $userUsedBonuses
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
            [['fbUserId'], 'integer'],
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
    public function getUserUsedBonuses()
    {
        return $this->hasMany(UserUsedBonuses::className(), ['userId' => 'userId']);
    }
}
