<?php

use yii\db\Migration;

class m170118_083842_add_backend_fields_in_user_table extends Migration
{

	// Use safeUp/safeDown to run migration code within a transaction
	public function safeUp()
	{
		$this->addColumn('user', 'email', $this->string(255));
		$this->addColumn('user', 'passwordHash', $this->string(255));
		$this->addColumn('user', 'accessToken', $this->string(255));
		$this->addColumn('user', 'role', $this->integer()->defaultValue(0)->notNull());
	}

	public function safeDown()
	{
		$this->dropColumn('user', 'email');
		$this->dropColumn('user', 'passwordHash');
		$this->dropColumn('user', 'accessToken');
		$this->dropColumn('user', 'role');
	}

}
