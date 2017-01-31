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
 * @property string $image
 *
 * @property ConditionLoadScene[] $conditionLoadScenes
 * @property Location $location
 * @property SceneButton[] $sceneButtons
 * @property SceneButton[] $sceneButtons0
 * @property SceneTranslation[] $sceneTranslations
 * @property UserLoadedScenes[] $userLoadedScenes
 * @property UserProgress[] $userProgresses
 * @property UserProgress[] $userProgresses0
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
            [['image'], 'string', 'max' => 255],
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
            'image' => 'Image',
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
    public function getUserLoadedScenes()
    {
        return $this->hasMany(UserLoadedScenes::className(), ['sceneId' => 'sceneId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProgresses()
    {
        return $this->hasMany(UserProgress::className(), ['userProgressId' => 'userProgressId'])->viaTable('userLoadedScenes', ['sceneId' => 'sceneId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProgresses0()
    {
        return $this->hasMany(UserProgress::className(), ['currentSceneId' => 'sceneId']);
    }
}
