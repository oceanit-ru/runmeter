<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of SceneButtonTranslation
 *
 * @author gorohovvalerij
 */
class SceneButtonTranslation extends BaseSceneButtonTranslation
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['language'], 'required'],
            [['text', 'answer'], 'string'],
            [['language'], 'string', 'max' => 16],
            [['sceneButtonId'], 'exist', 'skipOnError' => true, 'targetClass' => SceneButton::className(), 'targetAttribute' => ['sceneButtonId' => 'sceneButtonId']],
        ];
    }
}
