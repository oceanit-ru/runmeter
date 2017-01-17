<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of ConditionPressedButton
 *
 * @author gorohovvalerij
 */
class ConditionPressedButton extends BaseConditionPressedButton
{
	
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'conditionPressedButtonId' => 'ID',
            'sceneButtonId' => 'Scene Button ID',
            'verifiableSceneButtonId' => 'Кнопка',
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
			'conditionPressedButtonId' => $this->conditionPressedButtonId,
			'sceneButtonId' => $this->sceneButtonId,
			'verifiableSceneButtonId' => $this->verifiableSceneButtonId,
			'condition' => $this->condition,
			'createdAt' => \Yii::$app->formatter->asTimestamp($this->createdAt),
			'updateAt' => \Yii::$app->formatter->asTimestamp($this->updateAt),
		];
	}

	/**
	 * 
	 * @param ConditionPressedButton[] $array
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
