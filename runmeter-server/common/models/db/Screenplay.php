<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of Scenario
 *
 * @author gorohovvalerij
 */
class Screenplay extends BaseScreenplay
{
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'screenplayId' => 'ID',
            'name' => 'Название',
            'createdAt' => 'Создано',
            'updateAt' => 'Обновлено',
        ];
    }
	
	/**
	 * 
	 * @return mixed[]
	 */
	public function serializationToArray()
	{
		return [
			'screenplayId' => $this->screenplayId,
			'name' => $this->name,
			'locations' => Scene::serializationOfArray($this->locations),
			'createdAt' => \Yii::$app->formatter->asTimestamp($this->createdAt),
			'updateAt' => \Yii::$app->formatter->asTimestamp($this->updateAt),
		];
	}

	/**
	 * 
	 * @param Screenplay[] $array
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
	
	/**
	 * 
	 * @return Screenplay
	 */
	public static function getBaseScreenplay() 
	{
		//TODO impl
		return static::find()->one();
	}
	
	
}
