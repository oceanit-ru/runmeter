<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sceneButton".
 *
 * @property integer $sceneButtonId
 * @property integer $sceneId
 * @property integer $number
 * @property integer $action
 * @property integer $segueLocationId
 * @property integer $segueSceneId
 * @property integer $showTextButtonId
 * @property integer $cost
 * @property string $createdAt
 * @property string $updateAt
 * @property string $product
 *
 * @property ConditionLoadScene[] $conditionLoadScenes
 * @property ConditionPressedButton[] $conditionPressedButtons
 * @property ConditionPressedButton[] $conditionPressedButtons0
 * @property ConditionVisitLocation[] $conditionVisitLocations
 * @property Scene $scene
 * @property Location $segueLocation
 * @property Scene $segueScene
 * @property BaseSceneButton $showTextButton
 * @property BaseSceneButton[] $baseSceneButtons
 * @property SceneButtonTranslation[] $sceneButtonTranslations
 * @property UserButtonsPayments[] $userButtonsPayments
 * @property UserProgress[] $userProgresses
 * @property UserPressedButtons[] $userPressedButtons
 * @property UserProgress[] $userProgresses0
 * @property UserProgress[] $userProgresses1
 */
class BaseSceneButton extends \common\models\db\TranslatableModel
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
            [['sceneId', 'number', 'action', 'segueLocationId', 'segueSceneId', 'showTextButtonId', 'cost'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
            [['product'], 'string', 'max' => 255],
            [['sceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['sceneId' => 'sceneId']],
            [['segueLocationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['segueLocationId' => 'locationId']],
            [['segueSceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['segueSceneId' => 'sceneId']],
            [['showTextButtonId'], 'exist', 'skipOnError' => true, 'targetClass' => BaseSceneButton::className(), 'targetAttribute' => ['showTextButtonId' => 'sceneButtonId']],
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
            'number' => 'Number',
            'action' => 'Action',
            'segueLocationId' => 'Segue Location ID',
            'segueSceneId' => 'Segue Scene ID',
            'showTextButtonId' => 'Show Text Button ID',
            'cost' => 'Cost',
            'createdAt' => 'Created At',
            'updateAt' => 'Update At',
            'product' => 'Product',
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
    public function getShowTextButton()
    {
        return $this->hasOne(BaseSceneButton::className(), ['sceneButtonId' => 'showTextButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaseSceneButtons()
    {
        return $this->hasMany(BaseSceneButton::className(), ['showTextButtonId' => 'sceneButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSceneButtonTranslations()
    {
        return $this->hasMany(SceneButtonTranslation::className(), ['sceneButtonId' => 'sceneButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserButtonsPayments()
    {
        return $this->hasMany(UserButtonsPayments::className(), ['buttonId' => 'sceneButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProgresses()
    {
        return $this->hasMany(UserProgress::className(), ['userProgressId' => 'userProgressId'])->viaTable('userButtonsPayments', ['buttonId' => 'sceneButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPressedButtons()
    {
        return $this->hasMany(UserPressedButtons::className(), ['buttonId' => 'sceneButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProgresses0()
    {
        return $this->hasMany(UserProgress::className(), ['userProgressId' => 'userProgressId'])->viaTable('userPressedButtons', ['buttonId' => 'sceneButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProgresses1()
    {
        return $this->hasMany(UserProgress::className(), ['currentButtonId' => 'sceneButtonId']);
    }
}
