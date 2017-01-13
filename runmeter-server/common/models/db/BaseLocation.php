<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property integer $locationId
 * @property integer $scenarioId
 * @property string $name
 * @property integer $number
 * @property string $image
 * @property string $createdAt
 * @property string $updateAt
 *
 * @property ConditionVisitLocation[] $conditionVisitLocations
 * @property Scenario $scenario
 * @property Scene[] $scenes
 * @property SceneButton[] $sceneButtons
 */
class BaseLocation extends \yii\db\ActiveRecord
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
            [['scenarioId', 'number'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
            [['scenarioId'], 'exist', 'skipOnError' => true, 'targetClass' => Scenario::className(), 'targetAttribute' => ['scenarioId' => 'scenarioId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'locationId' => 'Location ID',
            'scenarioId' => 'Scenario ID',
            'name' => 'Name',
            'number' => 'Number',
            'image' => 'Image',
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
    public function getScenario()
    {
        return $this->hasOne(Scenario::className(), ['scenarioId' => 'scenarioId']);
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
}
