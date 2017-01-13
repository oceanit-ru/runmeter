<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "conditionLoadScene".
 *
 * @property integer $conditionLoadSceneId
 * @property integer $sceneButtonId
 * @property integer $sceneId
 * @property integer $condition
 * @property string $createdAt
 * @property string $updateAt
 *
 * @property SceneButton $sceneButton
 * @property Scene $scene
 */
class BaseConditionLoadScene extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'conditionLoadScene';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sceneButtonId', 'sceneId', 'condition'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
            [['sceneButtonId'], 'exist', 'skipOnError' => true, 'targetClass' => SceneButton::className(), 'targetAttribute' => ['sceneButtonId' => 'sceneButtonId']],
            [['sceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['sceneId' => 'sceneId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'conditionLoadSceneId' => 'Condition Load Scene ID',
            'sceneButtonId' => 'Scene Button ID',
            'sceneId' => 'Scene ID',
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
    public function getScene()
    {
        return $this->hasOne(Scene::className(), ['sceneId' => 'sceneId']);
    }
}
