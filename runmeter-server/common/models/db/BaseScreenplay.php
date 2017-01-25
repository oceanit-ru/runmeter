<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "screenplay".
 *
 * @property integer $screenplayId
 * @property string $createdAt
 * @property string $updateAt
 *
 * @property Location[] $locations
 * @property ScreenplayTranslation[] $screenplayTranslations
 * @property UserProgress[] $userProgresses
 */
class BaseScreenplay extends \common\models\db\TranslatableModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'screenplay';
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
            'screenplayId' => 'Screenplay ID',
            'createdAt' => 'Created At',
            'updateAt' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['screenplayId' => 'screenplayId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScreenplayTranslations()
    {
        return $this->hasMany(ScreenplayTranslation::className(), ['screenplayId' => 'screenplayId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProgresses()
    {
        return $this->hasMany(UserProgress::className(), ['screenplayId' => 'screenplayId']);
    }
}
