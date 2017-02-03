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
 * Description of Scene
 *
 * @author gorohovvalerij
 */
class Scene extends BaseScene
{

	protected $translateModelName = 'SceneTranslation';

	/**
	 * @inheritdoc
	 */
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
	
	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['locationId', 'number', 'displayedButtonCount'], 'integer'],
            [['createdAt', 'updateAt'], 'safe'],
			[['image'], 'file', 'extensions' => 'jpeg, jpg, gif, png'],
            [['locationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['locationId' => 'locationId']],
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
		return $this->hasMany(SceneTranslation::className(), ['sceneId' => 'sceneId']);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'sceneId' => 'ID',
			'locationId' => 'Локация',
			'name' => 'Название',
            'image' => 'Изображение',
			'number' => 'Порядковый номер',
			'displayedButtonCount' => 'Количество видимых кнопок',
			'createdAt' => 'Создан',
			'updateAt' => 'Обновлен',
		];
	}

	/**
	 * 
	 * @return mixed[]
	 */
	public function serializationToArray()
	{
		return [
			'sceneId' => $this->sceneId,
			'locationId' => $this->locationId,
			'name' => ($this->translate(\Yii::$app->language)->name != null) ? $this->translate(\Yii::$app->language)->name : $this->translate(\Yii::$app->sourceLanguage)->name,
			'number' => $this->number,
			'image' => $this->getImageUrl(),
			'displayedButtonCount' => $this->displayedButtonCount,
			'createdAt' => \Yii::$app->formatter->asTimestamp($this->createdAt),
			'updateAt' => \Yii::$app->formatter->asTimestamp($this->updateAt),
			'sceneButtons' => SceneButton::serializationOfArray(SceneButton::find()->where(['sceneId' => $this->sceneId])->orderBy('number')->all())
		];
	}

	/**
	 * 
	 * @param Scene[] $array
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
