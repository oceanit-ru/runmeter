<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace common\models\db;

/**
 * Description of LocationTranslation
 *
 * @author gorohovvalerij
 */
class LocationTranslation extends BaseLocationTranslation
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
            [['locationId'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['locationId' => 'locationId']],
        ];
    }
}
