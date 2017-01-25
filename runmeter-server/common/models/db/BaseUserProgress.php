<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "userProgress".
 *
 * @property integer $userProgressId
 * @property integer $userId
 * @property integer $screenplayId
 * @property integer $currentLocationId
 * @property integer $currentSceneId
 * @property integer $currentButtonId
 * @property string $createdAt
 * @property string $updateAt
 *
 * @property UserButtonsPayments[] $userButtonsPayments
 * @property SceneButton[] $buttons
 * @property UserLoadedScenes[] $userLoadedScenes
 * @property Scene[] $scenes
 * @property UserPressedButtons[] $userPressedButtons
 * @property SceneButton[] $buttons0
 * @property SceneButton $currentButton
 * @property Location $currentLocation
 * @property Scene $currentScene
 * @property Screenplay $screenplay
 * @property User $user
 * @property UserVisitedLocations[] $userVisitedLocations
 * @property Location[] $locations
 */
class BaseUserProgress extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userProgress';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userId', 'screenplayId', 'currentLocationId', 'currentSceneId', 'currentButtonId'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
            [['currentButtonId'], 'exist', 'skipOnError' => true, 'targetClass' => SceneButton::className(), 'targetAttribute' => ['currentButtonId' => 'sceneButtonId']],
            [['currentLocationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['currentLocationId' => 'locationId']],
            [['currentSceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['currentSceneId' => 'sceneId']],
            [['screenplayId'], 'exist', 'skipOnError' => true, 'targetClass' => Screenplay::className(), 'targetAttribute' => ['screenplayId' => 'screenplayId']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['userId' => 'userId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userProgressId' => 'User Progress ID',
            'userId' => 'User ID',
            'screenplayId' => 'Screenplay ID',
            'currentLocationId' => 'Current Location ID',
            'currentSceneId' => 'Current Scene ID',
            'currentButtonId' => 'Current Button ID',
            'createdAt' => 'Created At',
            'updateAt' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserButtonsPayments()
    {
        return $this->hasMany(UserButtonsPayments::className(), ['userProgressId' => 'userProgressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getButtons()
    {
        return $this->hasMany(SceneButton::className(), ['sceneButtonId' => 'buttonId'])->viaTable('userButtonsPayments', ['userProgressId' => 'userProgressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLoadedScenes()
    {
        return $this->hasMany(UserLoadedScenes::className(), ['userProgressId' => 'userProgressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScenes()
    {
        return $this->hasMany(Scene::className(), ['sceneId' => 'sceneId'])->viaTable('userLoadedScenes', ['userProgressId' => 'userProgressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPressedButtons()
    {
        return $this->hasMany(UserPressedButtons::className(), ['userProgressId' => 'userProgressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getButtons0()
    {
        return $this->hasMany(SceneButton::className(), ['sceneButtonId' => 'buttonId'])->viaTable('userPressedButtons', ['userProgressId' => 'userProgressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentButton()
    {
        return $this->hasOne(SceneButton::className(), ['sceneButtonId' => 'currentButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentLocation()
    {
        return $this->hasOne(Location::className(), ['locationId' => 'currentLocationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCurrentScene()
    {
        return $this->hasOne(Scene::className(), ['sceneId' => 'currentSceneId']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['userId' => 'userId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserVisitedLocations()
    {
        return $this->hasMany(UserVisitedLocations::className(), ['userProgressId' => 'userProgressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['locationId' => 'locationId'])->viaTable('userVisitedLocations', ['userProgressId' => 'userProgressId']);
    }
}
