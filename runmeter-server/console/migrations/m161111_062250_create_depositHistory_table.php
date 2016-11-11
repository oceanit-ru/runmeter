<?php

use yii\db\Migration;

/**
 * Handles the creation of table `depositHistory`.
 */
class m161111_062250_create_depositHistory_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createTable('depositHistory', [
			'depositHistoryId' => $this->primaryKey(),
			'userId' => $this->integer(),
			'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP'),
			'bonuses' => $this->integer(),
			'steps' => $this->integer()
		]);

		/*
		 * tableName = depositHistory
		 * columnName = userId
		 */
		$this->createIndex(
				'idx_depositHistoryId_userId', 'depositHistory', 'userId'
		);

		$this->addForeignKey(
				'fk_depositHistory_user_userId', 'depositHistory', 'userId', 'user', 'userId', 'CASCADE'
		);
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		$this->dropForeignKey(
				'fk_depositHistory_user_userId', 'depositHistory'
		);

		$this->dropIndex(
				'idx_depositHistoryId_userId', 'depositHistory'
		);

		$this->dropTable('depositHistory');
	}

}
