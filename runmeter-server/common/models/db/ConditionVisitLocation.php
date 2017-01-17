<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of ConditionVisitLocation
 *
 * @author gorohovvalerij
 */
class ConditionVisitLocation extends BaseConditionVisitLocation
{
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'conditionVisitLocationId' => 'ID',
            'sceneButtonId' => 'Scene Button ID',
            'locationId' => 'Локация',
            'condition' => 'Условие',
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
			'conditionVisitLocationId' => $this->conditionVisitLocationId,
			'sceneButtonId' => $this->sceneButtonId,
			'locationId' => $this->locationId,
			'condition' => $this->condition,
			'createdAt' => \Yii::$app->formatter->asTimestamp($this->createdAt),
			'updateAt' => \Yii::$app->formatter->asTimestamp($this->updateAt),
		];
	}

	/**
	 * 
	 * @param ConditionVisitLocation[] $array
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
