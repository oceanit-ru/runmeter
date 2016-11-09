<?php

namespace frontend\modules\api\controllers;

use frontend\modules\api\controllers\PrivateController;
use yii\filters\VerbFilter;
use yii\filters\ContentNegotiator;
use yii\web\Response;

class BonusesController extends PrivateController
{
	public function behaviors()
    {
		$behaviors = parent::behaviors();

		$behaviors['verbs'] = [
		    'class' => VerbFilter::className(),
		    'actions' => [
				'deposit' => ['post'],
				'get' => ['get']
		    ]
		];
		
		$behaviors['contentNegotiator'] = [
    	    'class' => ContentNegotiator::className(),
    	    'formats' => [
    		  'application/json' => Response::FORMAT_JSON,
    	    ],
    	];


		return $behaviors;
    }
	
	
    public function actionDeposit()
    {
        return $this->render('deposit');
    }

    public function actionGet()
    {
        return $this->render('get');
    }

}
