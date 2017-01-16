<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "depositHistory".
 *
 * @property integer $depositHistoryId
 * @property integer $userId
 * @property string $createdAt
 * @property integer $bonuses
 * @property integer $steps
 *
 * @property User $user
 */
class BaseDepositHistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'depositHistory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'bonuses', 'steps'], 'integer'],
            [['createdAt'], 'safe'],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'userId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'depositHistoryId' => 'Deposit History ID',
            'userId' => 'User ID',
            'createdAt' => 'Created At',
            'bonuses' => 'Bonuses',
            'steps' => 'Setps',
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
