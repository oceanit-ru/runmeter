<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of SceneTranslation
 *
 * @author gorohovvalerij
 */
class SceneTranslation extends BaseSceneTranslation
{
	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language'], 'required'],
            [['language'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 255],
            [['sceneId'], 'exist', 'skipOnError' => true, 'targetClass' => Scene::className(), 'targetAttribute' => ['sceneId' => 'sceneId']],
        ];
    }
}
