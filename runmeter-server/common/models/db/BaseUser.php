<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $userId
 * @property integer $bonuses
 * @property integer $fbUserId
 *
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
            [['bonuses', 'fbUserId'], 'integer'],
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
            'bonuses' => 'Bonuses',
            'fbUserId' => 'Fb User ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserUsedBonuses()
    {
        return $this->hasMany(UserUsedBonuses::className(), ['userId' => 'userId']);
    }
}
