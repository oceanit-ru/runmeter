<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property integer $locationId
 * @property integer $screenplayId
 * @property string $name
 * @property integer $number
 * @property string $image
 * @property string $createdAt
 * @property string $updateAt
 *
 * @property ConditionVisitLocation[] $conditionVisitLocations
 * @property Screenplay $screenplay
 * @property Scene[] $scenes
 * @property SceneButton[] $sceneButtons
 * @property UserVisitLocation[] $userVisitLocations
 */
class BaseLocation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['screenplayId', 'number'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
            [['screenplayId'], 'exist', 'skipOnError' => true, 'targetClass' => Screenplay::className(), 'targetAttribute' => ['screenplayId' => 'screenplayId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'locationId' => 'Location ID',
            'screenplayId' => 'Screenplay ID',
            'name' => 'Name',
            'number' => 'Number',
            'image' => 'Image',
            'createdAt' => 'Created At',
            'updateAt' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConditionVisitLocations()
    {
        return $this->hasMany(ConditionVisitLocation::className(), ['locationId' => 'locationId']);
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
    public function getScenes()
    {
        return $this->hasMany(Scene::className(), ['locationId' => 'locationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSceneButtons()
    {
        return $this->hasMany(SceneButton::className(), ['segueLocationId' => 'locationId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserVisitLocations()
    {
        return $this->hasMany(UserVisitLocation::className(), ['locationId' => 'locationId']);
    }
}
