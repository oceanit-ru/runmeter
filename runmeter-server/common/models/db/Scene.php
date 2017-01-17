<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of Scene
 *
 * @author gorohovvalerij
 */
class Scene extends BaseScene
{
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
			'name' => $this->name,
			'number' => $this->number,
			'displayedButtonCount' => $this->displayedButtonCount,
			'sceneButtons' => SceneButton::serializationOfArray($this->sceneButtons),
			'createdAt' => \Yii::$app->formatter->asTimestamp($this->createdAt),
			'updateAt' => \Yii::$app->formatter->asTimestamp($this->updateAt),
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
