<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace common\components;

/**
 * Description of StringHelper
 *
 * @author gorohovvalerij
 */
class StringHelper
{

	static public function truncate($string, $maxLength)
	{
		return (strlen($string) > $maxLength) ? mb_substr($string, 0, $maxLength - 3) . '...' : $string;
	}
}
