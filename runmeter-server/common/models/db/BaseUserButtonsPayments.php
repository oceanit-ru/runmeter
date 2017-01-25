<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "userButtonsPayments".
 *
 * @property integer $userProgressId
 * @property integer $buttonId
 * @property integer $cost
 *
 * @property UserProgress $userProgress
 * @property SceneButton $button
 */
class BaseUserButtonsPayments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userButtonsPayments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userProgressId', 'buttonId'], 'required'],
            [['userProgressId', 'buttonId', 'cost'], 'integer'],
            [['userProgressId'], 'exist', 'skipOnError' => true, 'targetClass' => UserProgress::className(), 'targetAttribute' => ['userProgressId' => 'userProgressId']],
            [['buttonId'], 'exist', 'skipOnError' => true, 'targetClass' => SceneButton::className(), 'targetAttribute' => ['buttonId' => 'sceneButtonId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userProgressId' => 'User Progress ID',
            'buttonId' => 'Button ID',
            'cost' => 'Cost',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProgress()
    {
        return $this->hasOne(UserProgress::className(), ['userProgressId' => 'userProgressId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getButton()
    {
        return $this->hasOne(SceneButton::className(), ['sceneButtonId' => 'buttonId']);
    }
}
