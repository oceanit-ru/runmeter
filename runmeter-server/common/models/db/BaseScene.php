<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "scene".
 *
 * @property integer $sceneId
 * @property integer $locationId
 * @property integer $number
 * @property integer $displayedButtonCount
 * @property string $createdAt
 * @property string $updateAt
 *
 * @property ConditionLoadScene[] $conditionLoadScenes
 * @property Location $location
 * @property SceneButton[] $sceneButtons
 * @property SceneButton[] $sceneButtons0
 * @property SceneTranslation[] $sceneTranslations
 * @property UserLoadScene[] $userLoadScenes
 */
class BaseScene extends \common\models\db\TranslatableModel
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scene';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['locationId', 'number', 'displayedButtonCount'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
            [['locationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['locationId' => 'locationId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sceneId' => 'Scene ID',
            'locationId' => 'Location ID',
            'number' => 'Number',
            'displayedButtonCount' => 'Displayed Button Count',
            'createdAt' => 'Created At',
            'updateAt' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConditionLoadScenes()
    {
        return $this->hasMany(ConditionLoadScene::className(), ['sceneId' => 'sceneId']);
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
    public function getSceneButtons()
    {
        return $this->hasMany(SceneButton::className(), ['sceneId' => 'sceneId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSceneButtons0()
    {
        return $this->hasMany(SceneButton::className(), ['segueSceneId' => 'sceneId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSceneTranslations()
    {
        return $this->hasMany(SceneTranslation::className(), ['sceneId' => 'sceneId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLoadScenes()
    {
        return $this->hasMany(UserLoadScene::className(), ['sceneId' => 'sceneId']);
    }
}
