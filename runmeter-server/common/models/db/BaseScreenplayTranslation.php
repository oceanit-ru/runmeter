<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "screenplayTranslation".
 *
 * @property integer $screenplayId
 * @property string $language
 * @property string $name
 *
 * @property Screenplay $screenplay
 */
class BaseScreenplayTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'screenplayTranslation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['screenplayId', 'language'], 'required'],
            [['screenplayId'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 255],
            [['screenplayId'], 'exist', 'skipOnError' => true, 'targetClass' => Screenplay::className(), 'targetAttribute' => ['screenplayId' => 'screenplayId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'screenplayId' => 'Screenplay ID',
            'language' => 'Language',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getScreenplay()
    {
        return $this->hasOne(Screenplay::className(), ['screenplayId' => 'screenplayId']);
    }
}
