<?php

use yii\db\Migration;

class m170127_105554_create_add_vkToken_in_user extends Migration
{

	public function safeUp()
	{
		$this->addColumn('user', 'vkUserId', $this->string());
	}

	public function safeDown()
	{
		$this->dropColumn('user', 'vkUserId');
	}

}
