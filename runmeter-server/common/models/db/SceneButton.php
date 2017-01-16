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
