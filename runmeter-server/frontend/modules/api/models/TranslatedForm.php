<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\modules\api\models;

use yii\base\Model;
use Yii;

/**
 * Description of ТranslatedForm
 *
 * @author gorohovvalerij
 */
class TranslatedForm extends Model
{
	protected $language;

	public function load($data, $formName = null)
	{
		if (isset($data['language'])) {
			$language = $data['language'];
			if ($language == 'ru-RU' || $language == 'en-US') {
				\Yii::$app->language = $language;
				\Yii::warning(\Yii::$app->language, 'language');
			}
		}
		return parent::load($data, $formName);
	}
}