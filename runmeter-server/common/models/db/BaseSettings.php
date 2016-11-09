<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property integer $settingsId
 * @property string $initialReferencePeriod
 * @property string $maximumReferencePeriod
 * @property integer $bonusDivider
 * @property integer $bonusThreshold
 * @property integer $maximumBonusesInReferencePeriod
 * @property integer $useDataEnteredByUser
 */
class BaseSettings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['initialReferencePeriod', 'maximumReferencePeriod'], 'number'],
            [['bonusDivider', 'bonusThreshold', 'maximumBonusesInReferencePeriod', 'useDataEnteredByUser'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'settingsId' => 'Settings ID',
            'initialReferencePeriod' => 'Initial Reference Period',
            'maximumReferencePeriod' => 'Maximum Reference Period',
            'bonusDivider' => 'Bonus Divider',
            'bonusThreshold' => 'Bonus Threshold',
            'maximumBonusesInReferencePeriod' => 'Maximum Bonuses In Reference Period',
            'useDataEnteredByUser' => 'Use Data Entered By User',
        ];
    }
}
