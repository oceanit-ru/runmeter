<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "userVisitedLocations".
 *
 * @property integer $userProgressId
 * @property integer $locationId
 *
 * @property UserProgress $userProgress
 * @property Location $location
 */
class BaseUserVisitedLocations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userVisitedLocations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userProgressId', 'locationId'], 'required'],
            [['userProgressId', 'locationId'], 'integer'],
            [['userProgressId'], 'exist', 'skipOnError' => true, 'targetClass' => UserProgress::className(), 'targetAttribute' => ['userProgressId' => 'userProgressId']],
            [['locationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['locationId' => 'locationId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userProgressId' => 'User Progress ID',
            'locationId' => 'Location ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProgress()
    {
        return $this->hasOne(UserProgress::className(), ['userProgressId' => 'userProgressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['locationId' => 'locationId']);
    }
}
