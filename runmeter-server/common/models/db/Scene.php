<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

use creocoder\translateable\TranslateableBehavior;
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
			'name' => $this->translate(\Yii::$app->language)->name,
			'number' => $this->number,
			'displayedButtonCount' => $this->displayedButtonCount,
			'createdAt' => \Yii::$app->formatter->asTimestamp($this->createdAt),
			'updateAt' => \Yii::$app->formatter->asTimestamp($this->updateAt),
			'sceneButtons' => SceneButton::serializationOfArray($this->sceneButtons),
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
}
