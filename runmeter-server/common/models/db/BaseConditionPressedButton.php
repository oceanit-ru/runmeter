<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "conditionPressedButton".
 *
 * @property integer $conditionPressedButtonId
 * @property integer $sceneButtonId
 * @property integer $verifiableSceneButtonId
 * @property integer $condition
 * @property string $createdAt
 * @property string $updateAt
 *
 * @property SceneButton $sceneButton
 * @property SceneButton $verifiableSceneButton
 */
class BaseConditionPressedButton extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conditionPressedButton';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sceneButtonId', 'verifiableSceneButtonId', 'condition'], 'required'],
            [['sceneButtonId', 'verifiableSceneButtonId', 'condition'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
            [['sceneButtonId'], 'exist', 'skipOnError' => true, 'targetClass' => SceneButton::className(), 'targetAttribute' => ['sceneButtonId' => 'sceneButtonId']],
            [['verifiableSceneButtonId'], 'exist', 'skipOnError' => true, 'targetClass' => SceneButton::className(), 'targetAttribute' => ['verifiableSceneButtonId' => 'sceneButtonId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'conditionPressedButtonId' => 'Condition Pressed Button ID',
            'sceneButtonId' => 'Scene Button ID',
            'verifiableSceneButtonId' => 'Verifiable Scene Button ID',
            'condition' => 'Condition',
            'createdAt' => 'Created At',
            'updateAt' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSceneButton()
    {
        return $this->hasOne(SceneButton::className(), ['sceneButtonId' => 'sceneButtonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVerifiableSceneButton()
    {
        return $this->hasOne(SceneButton::className(), ['sceneButtonId' => 'verifiableSceneButtonId']);
    }
}
