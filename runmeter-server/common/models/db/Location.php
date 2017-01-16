<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

use common\components\behaviors\ImageUploadBehavior;

/**
 * Description of Location
 *
 * @author gorohovvalerij
 */
class Location extends BaseLocation
{
	public function behaviors()
	{
		return [
			'image-upload' => [
				'class' => ImageUploadBehavior::class,
				'attribute' => 'image',
				'thumbs' => [
					'thumb' => ['width' => 400, 'height' => 400],
					'small_thumb' => ['width' => 200, 'height' => 200],
				],
				'filePath' => '@uploads/[[model]]_[[pk]]_[[attribute]].[[extension]]',
				'fileUrl' => '[[model]]_[[pk]]_[[attribute]].[[extension]]',
				'thumbPath' => '@uploads/[[profile]]_[[model]]_[[pk]]_[[attribute]].[[extension]]',
				'thumbUrl' => '[[profile]]_[[model]]_[[pk]]_[[attribute]].[[extension]]',
			],
		];
	}
	
	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['screenplayId', 'number'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
            [['name'], 'string', 'max' => 255],
			[['image'], 'file', 'extensions' => 'jpeg, jpg, gif, png'],
            [['screenplayId'], 'exist', 'skipOnError' => true, 'targetClass' => Screenplay::className(), 'targetAttribute' => ['screenplayId' => 'screenplayId']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'locationId' => 'ID',
            'screenplayId' => 'Сценарий',
            'name' => 'Название',
            'number' => 'Порядковый номер',
            'image' => 'Изображение',
            'createdAt' => 'Создать',
            'updateAt' => 'Редактировать',
        ];
    }
	
	public function getImageUrl()
	{
		if (isset($this->image)) {
					return \yii\helpers\Url::to('@webUploads/' . $this->getImageFileUrl('image'), true);
		} else {
			return '';
		}
	}
	
	public function getThumbUrl()
	{
		if (isset($this->image)) {
					return \yii\helpers\Url::to('@webUploads/' . $this->getThumbFileUrl('image', $profile = 'thumb'), true);
		} else {
			return '';
		}
	}
	
	public function getSmallThumbUrl()
	{
		if (isset($this->image)) {
					return \yii\helpers\Url::to('@webUploads/' . $this->getThumbFileUrl('image', $profile = 'small_thumb'), true);
		} else {
			return '';
		}
	}
}
