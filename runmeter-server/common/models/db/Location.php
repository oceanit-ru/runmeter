<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

use creocoder\translateable\TranslateableBehavior;
use common\components\behaviors\ImageUploadBehavior;

/**
 * Description of Location
 *
 * @author gorohovvalerij
 */
class Location extends BaseLocation
{
	protected $translateModelName = 'LocationTranslation';
	
	public function behaviors()
	{
		return [
			'translateable' => [
				'class' => TranslateableBehavior::className(),
				'translationAttributes' => ['name'],
			// translationRelation => 'translations',
			// translationLanguageAttribute => 'language',
			],
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
	
	public function transactions()
	{
		return [
			self::SCENARIO_DEFAULT => self::OP_INSERT | self::OP_UPDATE,
		];
	}

	public function getTranslations()
	{
		return $this->hasMany(LocationTranslation::className(), ['locationId' => 'locationId']);
	}
	
	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['screenplayId', 'number'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
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
	
	/**
	 * 
	 * @return mixed[]
	 */
	public function serializationToArray()
	{
		return [
			'locationId' => $this->locationId,
			'screenplayId' => $this->screenplayId,
			'name' => $this->translate(\Yii::$app->language)->name,
			'number' => $this->number,
			'image' => $this->getImageUrl(),
			'createdAt' => \Yii::$app->formatter->asTimestamp($this->createdAt),
			'updateAt' => \Yii::$app->formatter->asTimestamp($this->updateAt),
			'scenes' => Scene::serializationOfArray($this->scenes),
		];
	}

	/**
	 * 
	 * @param Location[] $array
	 * @return mixed[]
	 */
	public static function serializationOfArray($array)
	{
		$serializedArray = [];
		foreach ($array as $model) {
			$serializedArray[] = $model->serializationToArray();
		}
		return $serializedArray;
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
