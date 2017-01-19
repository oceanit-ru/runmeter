<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "conditionVisitLocation".
 *
 * @property integer $conditionVisitLocationId
 * @property integer $sceneButtonId
 * @property integer $locationId
 * @property integer $condition
 * @property string $createdAt
 * @property string $updateAt
 *
 * @property Location $location
 * @property SceneButton $sceneButton
 */
class BaseConditionVisitLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conditionVisitLocation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sceneButtonId', 'locationId', 'condition'], 'required'],
            [['sceneButtonId', 'locationId', 'condition'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
            [['locationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['locationId' => 'locationId']],
            [['sceneButtonId'], 'exist', 'skipOnError' => true, 'targetClass' => SceneButton::className(), 'targetAttribute' => ['sceneButtonId' => 'sceneButtonId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'conditionVisitLocationId' => 'Condition Visit Location ID',
            'sceneButtonId' => 'Scene Button ID',
            'locationId' => 'Location ID',
            'condition' => 'Condition',
            'createdAt' => 'Created At',
            'updateAt' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['locationId' => 'locationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSceneButton()
    {
        return $this->hasOne(SceneButton::className(), ['sceneButtonId' => 'sceneButtonId']);
    }
}
