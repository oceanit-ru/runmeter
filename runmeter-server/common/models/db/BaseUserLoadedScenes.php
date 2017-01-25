<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "userLoadedScenes".
 *
 * @property integer $userProgressId
 * @property integer $sceneId
 *
 * @property UserProgress $userProgress
 * @property Scene $scene
 */
class BaseUserLoadedScenes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userLoadedScenes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['userProgressId', 'sceneId'], 'required'],
            [['userProgressId', 'sceneId'], 'integer'],
            [['userProgressId'], 'exist', 'skipOnError' => true, 'targetClass' => UserProgress::className(), 'targetAttribute' => ['userProgressId' => 'userProgressId']],
            [['sceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['sceneId' => 'sceneId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'userProgressId' => 'User Progress ID',
            'sceneId' => 'Scene ID',
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
    public function getScene()
    {
        return $this->hasOne(Scene::className(), ['sceneId' => 'sceneId']);
    }
}
