<?php

return [
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'components' => [
		'cache' => [
			'class' => 'yii\caching\FileCache',
		],
		'formatter' => [
			'datetimeFormat' => 'Y-M-d H:i:s',
			'dateFormat' => 'Y-M-d',
		],
		
	],
	//'timeZone' => 'Europe/Moscow',
	'language' => 'ru-RU',
	'sourceLanguage' => 'ru-RU'
	
];
