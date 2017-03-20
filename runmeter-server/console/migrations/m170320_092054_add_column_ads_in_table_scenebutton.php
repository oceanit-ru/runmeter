<?php

use yii\db\Migration;

class m170320_092054_add_column_ads_in_table_scenebutton extends Migration
{
     public function safeUp()
    {
		$this->addColumn('sceneButton', 'showAds', $this->boolean());
    }

    public function safeDown()
    {
		$this->dropColumn('sceneButton', 'showAds');
    }
}
