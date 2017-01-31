<?php

use yii\db\Migration;

class m170131_103651_add_image_column_in_scene_table extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
	public function safeUp()
	{
		$this->addColumn('scene', 'image', $this->string());
	}

	public function safeDown()
	{
		$this->dropColumn('scene', 'image');
	}
}
