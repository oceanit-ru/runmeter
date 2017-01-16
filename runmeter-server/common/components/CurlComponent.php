<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\components;

use yii\base\Component;

/**
 * Description of CurlComponent
 *
 * @author gorohovvalerij
 */
class CurlComponent extends Component
{
	/** Create curl connection and get response
     * @param $url
     * @return mixed
     */
    public static function curl($url)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }

}
