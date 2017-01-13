<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "scenario".
 *
 * @property integer $scenarioId
 * @property string $createdAt
 * @property string $updateAt
 *
 * @property Location[] $locations
 */
class BaseScenario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scenario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createdAt', 'updateAt'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'scenarioId' => 'Scenario ID',
            'createdAt' => 'Created At',
            'updateAt' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['scenarioId' => 'scenarioId']);
    }
}
