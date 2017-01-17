<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of ConditionLoadScene
 *
 * @author gorohovvalerij
 */
class ConditionLoadScene extends BaseConditionLoadScene
{
	
	 /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'conditionLoadSceneId' => 'ID',
            'sceneButtonId' => 'Scene Button ID',
            'sceneId' => 'Сцена',
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
			'conditionLoadSceneId' => $this->conditionLoadSceneId,
			'sceneButtonId' => $this->sceneButtonId,
			'sceneId' => $this->sceneId,
			'sceneButtonId' => $this->sceneButtonId,
				
		];
	}

	/**
	 * 
	 * @param ConditionLoadScene[] $array
	 * @return mixed[]
	 */
	public static function serializationOfArray($array)
	{
		$serializedArray = [];
		foreach ($array as $city) {
			$serializedArray[] = $city->serializationToArray();
		}
		return $serializedArray;
	}
}
