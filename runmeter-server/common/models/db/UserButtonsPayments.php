<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of UserButtonsPayments
 *
 * @author gorohovvalerij
 */
class UserButtonsPayments extends BaseUserButtonsPayments
{
	/**
	 * 
	 * @return mixed[]
	 */
	public function serializationToArray()
	{
		return [
			'buttonId' => $this->buttonId,
			'cost' => $this->cost,
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
}
