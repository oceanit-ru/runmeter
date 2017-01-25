<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "userPressedButtons".
 *
 * @property integer $buttonId
 * @property integer $userProgressId
 *
 * @property SceneButton $button
 * @property UserProgress $userProgress
 */
class BaseUserPressedButtons extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userPressedButtons';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['buttonId', 'userProgressId'], 'required'],
            [['buttonId', 'userProgressId'], 'integer'],
            [['buttonId'], 'exist', 'skipOnError' => true, 'targetClass' => SceneButton::className(), 'targetAttribute' => ['buttonId' => 'sceneButtonId']],
            [['userProgressId'], 'exist', 'skipOnError' => true, 'targetClass' => UserProgress::className(), 'targetAttribute' => ['userProgressId' => 'userProgressId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'buttonId' => 'Button ID',
            'userProgressId' => 'User Progress ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getButton()
    {
        return $this->hasOne(SceneButton::className(), ['sceneButtonId' => 'buttonId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProgress()
    {
        return $this->hasOne(UserProgress::className(), ['userProgressId' => 'userProgressId']);
    }
}
