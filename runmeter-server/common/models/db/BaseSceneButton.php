<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sceneButton".
 *
 * @property integer $sceneButtonId
 * @property integer $sceneId
 * @property string $text
 * @property integer $action
 * @property string $answer
 * @property integer $segueLocationId
 * @property integer $segueSceneId
 * @property integer $cost
 * @property string $createdAt
 * @property string $updateAt
 *
 * @property ConditionLoadScene[] $conditionLoadScenes
 * @property ConditionPressedButton[] $conditionPressedButtons
 * @property ConditionPressedButton[] $conditionPressedButtons0
 * @property ConditionVisitLocation[] $conditionVisitLocations
 * @property Scene $scene
 * @property Location $segueLocation
 * @property Scene $segueScene
 * @property UserPressedButton[] $userPressedButtons
 */
class BaseSceneButton extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sceneButton';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sceneId', 'action', 'segueLocationId', 'segueSceneId', 'cost'], 'integer'],
            [['text', 'answer'], 'string'],
            [['createdAt', 'updateAt'], 'safe'],
            [['sceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['sceneId' => 'sceneId']],
            [['segueLocationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['segueLocationId' => 'locationId']],
            [['segueSceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['segueSceneId' => 'sceneId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sceneButtonId' => 'Scene Button ID',
            'sceneId' => 'Scene ID',
            'text' => 'Text',
            'action' => 'Action',
            'answer' => 'Answer',
            'segueLocationId' => 'Segue Location ID',
            'segueSceneId' => 'Segue Scene ID',
            'cost' => 'Cost',
            'createdAt' => 'Created At',
            'updateAt' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConditionLoadScenes()
    {
        return $this->hasMany(ConditionLoadScene::className(), ['sceneButtonId' => 'sceneButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConditionPressedButtons()
    {
        return $this->hasMany(ConditionPressedButton::className(), ['sceneButtonId' => 'sceneButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConditionPressedButtons0()
    {
        return $this->hasMany(ConditionPressedButton::className(), ['verifiableSceneButtonId' => 'sceneButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConditionVisitLocations()
    {
        return $this->hasMany(ConditionVisitLocation::className(), ['sceneButtonId' => 'sceneButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScene()
    {
        return $this->hasOne(Scene::className(), ['sceneId' => 'sceneId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSegueLocation()
    {
        return $this->hasOne(Location::className(), ['locationId' => 'segueLocationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSegueScene()
    {
        return $this->hasOne(Scene::className(), ['sceneId' => 'segueSceneId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPressedButtons()
    {
        return $this->hasMany(UserPressedButton::className(), ['sceneButtonId' => 'sceneButtonId']);
    }
}
