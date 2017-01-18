<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db
;

use Yii;

/**
 * Description of TranslatableEntity
 *
 * @author gorohovvalerij
 * @property string $translateModelName 
 */
class TranslatableModel extends \yii\db\ActiveRecord
{
	protected $translateModelName = 'TranslatableModel';

	public function init()
	{
		parent::init();
		$translateModelName = $this->className() . 'Translation';
	}

	public function load($data, $formName = null)
	{
		$result = parent::load($data, $formName);
		if (isset($data[$this->translateModelName])) {
			foreach ($data[$this->translateModelName] as $language => $data) {
				foreach ($data as $attribute => $translation) {
					if (!empty($translation)) {
						$result = true;
						$this->translate($language)->$attribute = $translation;
					}
				}
			}
		}
		return $result;
	}

}
