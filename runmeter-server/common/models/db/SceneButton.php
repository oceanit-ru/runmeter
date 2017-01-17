<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

define("ACTION_TYPE_TEXT", 0);
define("ACTION_TYPE_QUESTION", 1);
define("ACTION_TYPE_SEGUE", 2);

/**
 * Description of SceneButton
 *
 * @author gorohovvalerij
 */
class SceneButton extends BaseSceneButton
{

	const ACTION_TYPE = [ 
		ACTION_TYPE_TEXT => 'Текст',
		ACTION_TYPE_QUESTION => 'Вопрос',
		ACTION_TYPE_SEGUE => 'Переход'
	];
	
	public function insert($runValidation = true, $attributes = null) {
		$result = parent::insert($runValidation, $attributes);
		if ($result) {
			$defaultCondition = new ConditionPressedButton();
			$defaultCondition->sceneButtonId = $this->sceneButtonId;
			$defaultCondition->verifiableSceneButtonId = $this->sceneButtonId;
			$defaultCondition->condition = 0;
			$defaultCondition->save();
		}
		return $result;
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'sceneButtonId' => 'ID',
			'sceneId' => 'Сцена',
			'text' => 'Текст',
			'action' => 'Тип',
			'answer' => 'Ответ',
			'segueLocationId' => 'Локация перехода',
			'segueSceneId' => 'Сцена перехода',
			'cost' => 'Цена',
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
			'sceneButtonId' => $this->sceneButtonId,
			'sceneId' => $this->sceneId,
			'text' => $this->text,
			'action' => $this->action,
			'answer' => $this->answer,
			'segueLocationId' => $this->segueLocationId,
			'segueSceneId' => $this->segueSceneId,
			'cost' => $this->cost,
			'conditionPressedButtons' => ConditionPressedButton::serializationOfArray($this->conditionPressedButtons),
			'conditionLoadScenes' => ConditionLoadScene::serializationOfArray($this->conditionLoadScenes),
			'conditionVisitLocations' => ConditionVisitLocation::serializationOfArray($this->conditionVisitLocations),
			'createdAt' => \Yii::$app->formatter->asTimestamp($this->createdAt),
			'updateAt' => \Yii::$app->formatter->asTimestamp($this->updateAt),
		];
	}

	/**
	 * 
	 * @param SceneButton[] $array
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

	public function getShortText()
	{
		return \common\components\StringHelper::truncate($this->text, 20);
	}

	public function getActionAsString()
	{
		$actionTypes = static::ACTION_TYPE;
		return $actionTypes[$this->action];
	}

}
