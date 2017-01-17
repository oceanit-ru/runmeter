<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "userPressedButton".
 *
 * @property integer $userPressedButtonId
 * @property integer $screenplayId
 * @property integer $sceneButtonId
 * @property integer $userId
 *
 * @property SceneButton $sceneButton
 * @property Screenplay $screenplay
 * @property User $user
 */
class BaseUserPressedButton extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userPressedButton';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['screenplayId', 'sceneButtonId', 'userId'], 'required'],
            [['screenplayId', 'sceneButtonId', 'userId'], 'integer'],
            [['sceneButtonId'], 'exist', 'skipOnError' => true, 'targetClass' => SceneButton::className(), 'targetAttribute' => ['sceneButtonId' => 'sceneButtonId']],
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
            'userPressedButtonId' => 'User Pressed Button ID',
            'screenplayId' => 'Screenplay ID',
            'sceneButtonId' => 'Scene Button ID',
            'userId' => 'User ID',
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
}
