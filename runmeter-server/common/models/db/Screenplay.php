<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of Scenario
 *
 * @author gorohovvalerij
 */
class Screenplay extends BaseScreenplay
{
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'screenplayId' => 'ID',
            'name' => 'Название',
            'createdAt' => 'Создано',
            'updateAt' => 'Обновлено',
        ];
    }
	
	static public function getBaseScreenplay() 
	{
		//TODO impl
		return static::find()->one();
	}
	
	
}
