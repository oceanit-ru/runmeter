<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of UserUsedBonuses
 *
 * @author gorohovvalerij
 */
class UserUsedBonuses extends BaseUserUsedBonuses
{
	/**
	 * 
	 * @param int $settingsId
	 * @return array or NULL
	 */
	public function serializationToArray()
	{
		$serializationArray = array (
			'bonuses' => $this->bonuses,
			'steps' => $this->steps,
			'startTime' => $this->startTime,
			'endTime' => $this->endTime
		);
		return $serializationArray;
	}
}
