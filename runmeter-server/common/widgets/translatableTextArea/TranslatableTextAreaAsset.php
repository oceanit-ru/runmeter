<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\widgets\translatableTextArea;

use yii\web\AssetBundle;

/**
 * Description of TranslatableTextInputAsset
 *
 * @author gorohovvalerij
 */
class TranslatableTextAreaAsset extends AssetBundle
{
    public $js = [
		'js/tranlateModal.js'
    ];

    public $css = [
    ];

    public $depends = [
        'yii\web\JqueryAsset'
    ];
	
	public $publishOptions = [
	  'forceCopy'=>true,
	];

    public function init()
    {
        // Tell AssetBundle where the assets files are
        $this->sourcePath = __DIR__ . "/assets";
        parent::init();
    }
}
