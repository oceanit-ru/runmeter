<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property integer $locationId
 * @property integer $screenplayId
 * @property integer $number
 * @property string $createdAt
 * @property string $updateAt
 *
 * @property ConditionVisitLocation[] $conditionVisitLocations
 * @property Screenplay $screenplay
 * @property LocationTranslation[] $locationTranslations
 * @property Scene[] $scenes
 * @property SceneButton[] $sceneButtons
 * @property UserProgress[] $userProgresses
 * @property UserVisitedLocations[] $userVisitedLocations
 * @property UserProgress[] $userProgresses0
 */
class BaseLocation extends \common\models\db\TranslatableModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['screenplayId', 'number'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
            [['screenplayId'], 'exist', 'skipOnError' => true, 'targetClass' => Screenplay::className(), 'targetAttribute' => ['screenplayId' => 'screenplayId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'locationId' => 'Location ID',
            'screenplayId' => 'Screenplay ID',
            'number' => 'Number',
            'createdAt' => 'Created At',
            'updateAt' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConditionVisitLocations()
    {
        return $this->hasMany(ConditionVisitLocation::className(), ['locationId' => 'locationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScreenplay()
    {
        return $this->hasOne(Screenplay::className(), ['screenplayId' => 'screenplayId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocationTranslations()
    {
        return $this->hasMany(LocationTranslation::className(), ['locationId' => 'locationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScenes()
    {
        return $this->hasMany(Scene::className(), ['locationId' => 'locationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSceneButtons()
    {
        return $this->hasMany(SceneButton::className(), ['segueLocationId' => 'locationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProgresses()
    {
        return $this->hasMany(UserProgress::className(), ['currentLocationId' => 'locationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserVisitedLocations()
    {
        return $this->hasMany(UserVisitedLocations::className(), ['locationId' => 'locationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProgresses0()
    {
        return $this->hasMany(UserProgress::className(), ['userProgressId' => 'userProgressId'])->viaTable('userVisitedLocations', ['locationId' => 'locationId']);
    }
}
