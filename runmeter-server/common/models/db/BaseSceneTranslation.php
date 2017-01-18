<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sceneTranslation".
 *
 * @property integer $sceneId
 * @property string $language
 * @property string $name
 *
 * @property Scene $scene
 */
class BaseSceneTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sceneTranslation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sceneId', 'language'], 'required'],
            [['sceneId'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 255],
            [['sceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['sceneId' => 'sceneId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sceneId' => 'Scene ID',
            'language' => 'Language',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScene()
    {
        return $this->hasOne(Scene::className(), ['sceneId' => 'sceneId']);
    }
}
