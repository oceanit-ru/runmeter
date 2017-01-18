<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of ScreenplayTranslation
 *
 * @author gorohovvalerij
 */
class ScreenplayTranslation extends BaseScreenplayTranslation
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
            [['screenplayId'], 'exist', 'skipOnError' => true, 'targetClass' => Screenplay::className(), 'targetAttribute' => ['screenplayId' => 'screenplayId']],
        ];
    }
}
