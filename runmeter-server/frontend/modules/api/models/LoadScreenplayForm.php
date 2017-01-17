<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\modules\api\models;

use common\models\db\Screenplay;
use yii\base\Model;
use Yii;

/**
 * Description of LoadScreenplayForm
 *
 * @author gorohovvalerij
 */
class LoadScreenplayForm  extends Model
{
	public $screenplayId;
	
	/* @var $screenplay Screenplay */
	public $screenplay;
	
	/**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['screenplayId'], 'default']
        ];
    }

	public function loadScreenplay()
	{
		$this->validate();
		if (isset($this->screenplayId)) {
			$this->screenplay = Screenplay::findOne($this->screenplayId);
		} else {
			$this->screenplay = Screenplay::getBaseScreenplay();
		}
		return true;
	}
}
