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
class GetSettingsForm extends Model
{

	public function getSettings()
	{
		if (Yii::$app->params['development']) {
			$settingsId = Yii::$app->params['development.settingsId'];
		} else {
			$settingsId = Yii::$app->params['release.settingsId'];
		}

		return Settings::serializationToArrayWithId($settingsId);
	}

}
