<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\widgets\translatableTextInput;

use yii\web\AssetBundle;

/**
 * Description of TranslatableTextInputAsset
 *
 * @author gorohovvalerij
 */
class TranslatableTextInputAsset extends AssetBundle
{
    public $js = [
        //'//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js'
		'js/tranlateModal.js'
    ];

    public $css = [
		'//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'
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
