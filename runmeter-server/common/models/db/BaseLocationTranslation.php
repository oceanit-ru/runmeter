<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "locationTranslation".
 *
 * @property integer $locationId
 * @property string $language
 * @property string $name
 *
 * @property Location $location
 */
class BaseLocationTranslation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'locationTranslation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['locationId', 'language'], 'required'],
            [['locationId'], 'integer'],
            [['language'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 255],
            [['locationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['locationId' => 'locationId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'locationId' => 'Location ID',
            'language' => 'Language',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['locationId' => 'locationId']);
    }
}
