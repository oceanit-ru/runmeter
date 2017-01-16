<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of Scene
 *
 * @author gorohovvalerij
 */
class Scene extends BaseScene
{
	/**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'sceneId' => 'ID',
            'locationId' => 'Локация',
            'name' => 'Название',
            'number' => 'Порядковый номер',
            'displayedButtonCount' => 'Количество видимых кнопок',
            'createdAt' => 'Создан',
            'updateAt' => 'Обновлен',
        ];
    }
}
