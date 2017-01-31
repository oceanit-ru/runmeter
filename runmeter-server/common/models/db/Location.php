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
			]
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
}
