<?php

namespace frontend\modules\api;

use Yii;

/**
 * api module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\api\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::$app->user->enableSession = false;
		//var_dump(Yii::$app->request->csrfCookie); die();
        $this->registerResponseComponent();
        // custom initialization code goes here
    }
    
    
    private function registerResponseComponent() {
        Yii::$app->set('response', [
            'class' => 'yii\web\Response',
            'on beforeSend' => function ($event) {
                $response = $event->sender;
        
                if (($response->data !== null) && is_array($response->data)) {
                	// ответ с ошибками
                	if (!$response->isSuccessful) {
                		$response->data = ["meta" => ['success' => $response->isSuccessful, 
                			'error' => isset($response->data["message"]) ? $response->data["message"] : ''], "data" => $response->data];
                	} else {	
                		// положительный ответ
	                    $response->data = ["meta" => ['success' => $response->isSuccessful, 'error' => ''], "data" => $response->data]; 
                	}
                    $response->format = yii\web\Response::FORMAT_JSON;
                } else if (is_string($response->data)) {
                    $response->format = yii\web\Response::FORMAT_RAW;
                }
                $response->statusCode = 200;
            },
        ]);
    }
}
