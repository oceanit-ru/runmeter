<?php

use yii\db\Migration;

class m170214_125429_add_column_product_in_table_scenebutton extends Migration
{
    public function safeUp()
    {
		$this->addColumn('sceneButton', 'product', $this->string());
    }

    public function safeDown()
    {
		$this->dropColumn('sceneButton', 'product');
    }
}
