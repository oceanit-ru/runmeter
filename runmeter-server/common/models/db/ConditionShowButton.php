<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of ConditionShowButton
 *
 * @author gorohovvalerij
 */
class ConditionShowButton extends BaseConditionShowButton
{
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'conditionShowButtonId' => 'ID',
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
			'conditionShowButtonId' => $this->conditionShowButtonId,
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
