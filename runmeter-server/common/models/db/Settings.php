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
	public static function serializationToArrayWithId($settingsId)
	{
		$settings = static::findOne($settingsId);
		if (isset($settings)) {
			$serializationArray = array (
				'initialReferencePeriod' => $settings->initialReferencePeriod,
				'maximumReferencePeriod' => $settings->maximumReferencePeriod,
				'bonusDivider' => $settings->bonusDivider,
				'bonusThreshold' => $settings->bonusThreshold,
				'maximumBonusesInReferencePeriod' => $settings->maximumBonusesInReferencePeriod,
				'useDataEnteredByUser' => $settings->useDataEnteredByUser
			);
			return $serializationArray;
		}
		return NULL;
	}

}
