<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "screenplay".
 *
 * @property integer $screenplayId
 * @property string $name
 * @property string $createdAt
 * @property string $updateAt
 *
 * @property Location[] $locations
 * @property UserLoadScene[] $userLoadScenes
 * @property UserPressedButton[] $userPressedButtons
 * @property UserVisitLocation[] $userVisitLocations
 */
class BaseScreenplay extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'screenplay';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['createdAt', 'updateAt'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'screenplayId' => 'Screenplay ID',
            'name' => 'Name',
            'createdAt' => 'Created At',
            'updateAt' => 'Update At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocations()
    {
        return $this->hasMany(Location::className(), ['screenplayId' => 'screenplayId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserLoadScenes()
    {
        return $this->hasMany(UserLoadScene::className(), ['screenplayId' => 'screenplayId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPressedButtons()
    {
        return $this->hasMany(UserPressedButton::className(), ['screenplayId' => 'screenplayId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserVisitLocations()
    {
        return $this->hasMany(UserVisitLocation::className(), ['screenplayId' => 'screenplayId']);
    }
}
