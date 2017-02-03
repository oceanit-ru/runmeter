<?php

namespace frontend\modules\api\models;

use yii\base\Model;
use common\models\db\Settings;
use Yii;

/**
 * Description of LoginForm
 *
 * @author gorohovvalerij
 */
class GetSettingsForm extends TranslatedForm
{

	public function getSettings()
	{
		/* @var $settings Settings */
		if (YII_DEBUG) {
			$settings = Settings::debugSettings();
		} else {
			$settings = Settings::releaseSettings();
		}
		
		return ($settings != NULL) ? $settings->serializationToArray() : NULL;
	}

}
