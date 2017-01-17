<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "userLoadScene".
 *
 * @property integer $userLoadSceneId
 * @property integer $screenplayId
 * @property integer $sceneId
 * @property integer $userId
 *
 * @property Scene $scene
 * @property Screenplay $screenplay
 * @property User $user
 */
class BaseUserLoadScene extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'userLoadScene';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['screenplayId', 'sceneId', 'userId'], 'required'],
            [['screenplayId', 'sceneId', 'userId'], 'integer'],
            [['sceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['sceneId' => 'sceneId']],
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
            'userLoadSceneId' => 'User Load Scene ID',
            'screenplayId' => 'Screenplay ID',
            'sceneId' => 'Scene ID',
            'userId' => 'User ID',
        ];
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
