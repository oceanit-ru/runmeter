<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "userUsedBonuses".
 *
 * @property integer $userUsedBonusesId
 * @property integer $userId
 * @property integer $bonuses
 * @property string $startDate
 * @property string $endDate
 *
 * @property User $user
 */
class BaseUserUsedBonuses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userUsedBonuses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'bonuses'], 'integer'],
            [['startDate', 'endDate'], 'safe'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'userId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userUsedBonusesId' => 'User Used Bonuses ID',
            'userId' => 'User ID',
            'bonuses' => 'Bonuses',
            'startDate' => 'Start Date',
            'endDate' => 'End Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }
}
