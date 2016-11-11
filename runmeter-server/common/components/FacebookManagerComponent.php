<?php

namespace common\components;

use ErrorException;
use Yii;
use yii\base\Component;
use yii\helpers\Json;

class FacebookManagerComponent extends Component{

    public static function validateAccessToken($userId, $userToken)
    {
        $appInfoResponseJson = CurlComponent::curl("https://graph.facebook.com/app?access_token=" . $userToken);

        $userInfoResponseJson = CurlComponent::curl("https://graph.facebook.com/v2.5/me?access_token=" . $userToken);

        $appInfoResponse = Json::decode($appInfoResponseJson);
        $userInfoResponse = Json::decode($userInfoResponseJson);

        $appId = $appInfoResponse["id"];

        $fbUserId = $userInfoResponse["id"];

        if (!$appInfoResponse || ($appId != Yii::$app->params['faceBookAppId']) || ($fbUserId != $userId)) {
			return false;
        }
		
		return true;
    }
}