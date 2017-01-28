<?php

namespace common\components;

use yii\base\Component;
use yii\helpers\Json;

class VkManagerComponent extends Component
{
	private static $_userInfoResponse;
	
	/**
	 * @param integer $userId
	 * @param string $userToken
	 * @return boolean
	 */
    public static function validateAccessToken($userId, $userToken)
    {
        $userInfoResponse = CurlComponent::curl("https://api.vk.com/method/users.get?fields=photo_50&access_token=" . $userToken);

        $userInfoResponse = Json::decode($userInfoResponse);
        
      	if (isset($userInfoResponse["response"])) {
      		$vkUserUid = $userInfoResponse["response"][0]["uid"];      		
      		if ($vkUserUid != $userId) {
      			return false;
      		}  		
      		self::$_userInfoResponse = $userInfoResponse;    		
      		return true;
      	}

        return false;
    }
}