<?php

use yii\db\Migration;

/**
 * Handles the dropping of table `image_column_in_location`.
 */
class m170131_104223_drop_image_column_in_location_table extends Migration
{
     // Use safeUp/safeDown to run migration code within a transaction
	public function safeUp()
	{
		$this->dropColumn('location', 'image', $this->string());
	}

	public function safeDown()
	{
		$this->addColumn('location', 'image', $this->string());
	}
}
