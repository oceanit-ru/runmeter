<?php

namespace frontend\modules\api\controllers;

use common\models\db\User;
use common\models\db\AccessToken;
use Yii;
use yii\base\Controller;
use yii\filters\ContentNegotiator;
use yii\web\Response;
use yii\web\NotFoundHttpException;

/**
 * Description of PrivateController
 *
 * @author gorohovvalerij
 */
class PrivateController extends Controller
{
    /**
     * {@inheritDoc}
     * @see \yii\rest\Controller::behaviors()
     */
    public function behaviors()
    {
    	$behaviors = parent::behaviors();
    
    	$behaviors['contentNegotiator'] = [
    	    'class' => ContentNegotiator::className(),
    	    'formats' => [
    		  'application/json' => Response::FORMAT_JSON,
    	    ],
    	];
    
    	return $behaviors;
    }
	
    /**
     * {@inheritDoc}
     * @see \yii\web\Controller::beforeAction()
     */
    public function beforeAction($action)
    {
	   if (!parent::beforeAction($action)) {
	       return false;
	   }

    	$user = $this->getUser();
    
    	if (!$user) {
    	    throw new NotFoundHttpException("User not found");
    	}

	   Yii::$app->user->login($user);

	   return true;
    }

    /** Get user by token from query string
     * @return null|static
     */
    protected function getUser()
    {
    	$fbUserId = $this->getFBUserId();
    	$user = User::findIdentityByFBUserId($accessToken);
    	if (empty($user)) {
    	    $this->getResponseFormatForInvalidUserId();
    	}
    	return $user;
    }

    /** Get user id
     * @return array|mixed
     */
    private function getFBUserId()
    {
    	$fbUserId = Yii::$app->request->get("fbUserId");
    	if (empty($fbUserId)) {
    	    $fbUserId = Yii::$app->request->post("fbUserId");
    	}
    	return $fbUserId;
    }

    private function getResponseFormatForInvalidUserId()
    {
    	Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
    	echo json_encode(["meta" => ['success' => false, 'error' => 'error login by facebook user id', 'invalidUserId' => true],
    	   "data" => []]);
    	Yii::$app->end();
    }
}
