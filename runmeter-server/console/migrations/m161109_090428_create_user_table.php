<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m161109_090428_create_user_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function up()
	{
		$this->createTable('user', [
			'userId' => $this->primaryKey(),
			'fbUserId' => $this->integer()->unique(),
		]);

		$this->createIndex('fbUserId_idx', 'user', 'fbUserId');
	}

	/**
	 * @inheritdoc
	 */
	public function down()
	{
		$this->dropIndex('fbUserId_idx', 'user');
		$this->dropTable('user');
	}

}
