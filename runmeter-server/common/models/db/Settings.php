<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of Settings
 *
 * @author gorohovvalerij
 */
class Settings extends BaseSettings
{

	/**
	 * 
	 * @param int $settingsId
	 * @return array or NULL
	 */
	public static function debugSettings()
	{
		return static::find()->where(['isDebugSettings' => true])->one();
	}
	
	public static function releaseSettings()
	{
		return static::find()->where(['isDebugSettings' => false])->one();
	}
	
	public function serializationToArray()
	{
		$serializationArray = array (
			'initialReferencePeriod' => $this->initialReferencePeriod,
			'maximumReferencePeriod' => $this->maximumReferencePeriod,
			'bonusDivider' => $this->bonusDivider,
			'bonusThreshold' => $this->bonusThreshold,
			'maximumBonusesInReferencePeriod' => $this->maximumBonusesInReferencePeriod,
			'useDataEnteredByUser' => $this->useDataEnteredByUser
		);
		return $serializationArray;
	}
	
	

}
