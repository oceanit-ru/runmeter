<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\widgets\translatableTextInput;

use yii\base\Widget;

/**
 * Description of TranslatableTextInput
 *
 * @author gorohovvalerij
 * @var $form yii\widgets\ActiveForm
 */
class TranslatableTextInput extends Widget
{

	public $model;
	public $attribute;
	public $languageList;
	public $form;
	public $label;
	private $sourceLanguage;

	public function init()
	{
		parent::init();
	}

	public function run()
	{
		// Register AssetBundle
		TranslatableTextInputAsset::register($this->getView());
		return $this->render('_translatableTextInput', [
					'model' => $this->model,
					'attribute' => $this->attribute,
					'languageList' => $this->languageList,
					'form' => $this->form,
					'label' => isset($this->label) ? $this->label : null
		]);
	}

}
