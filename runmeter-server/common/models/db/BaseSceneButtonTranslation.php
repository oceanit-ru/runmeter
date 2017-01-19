<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sceneButtonTranslation".
 *
 * @property integer $sceneButtonId
 * @property string $language
 * @property string $text
 *
 * @property SceneButton $sceneButton
 */
class BaseSceneButtonTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sceneButtonTranslation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sceneButtonId', 'language'], 'required'],
            [['sceneButtonId'], 'integer'],
            [['text'], 'string'],
            [['language'], 'string', 'max' => 16],
            [['sceneButtonId'], 'exist', 'skipOnError' => true, 'targetClass' => SceneButton::className(), 'targetAttribute' => ['sceneButtonId' => 'sceneButtonId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sceneButtonId' => 'Scene Button ID',
            'language' => 'Language',
            'text' => 'Text',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSceneButton()
    {
        return $this->hasOne(SceneButton::className(), ['sceneButtonId' => 'sceneButtonId']);
    }
}
