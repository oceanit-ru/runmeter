<?php

use yii\db\Migration;

/**
 * Handles the creation of table `userusedbonuses`.
 */
class m161109_093047_create_userUsedBonuses_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function up()
	{
		$this->createTable('userUsedBonuses', [
			'userUsedBonusesId' => $this->primaryKey(),
			'userId' => $this->integer(),
			'bonuses' => $this->integer(),
			'startTime' => $this->dateTime(),
			'endTime'=> $this->dateTime(),
		]);

		/*
		 * columnName = userId
		 */
		$this->createIndex(
				'idx_userUsedBonuses_userId', 'userUsedBonuses', 'userId'
		);

		$this->addForeignKey(
				'fk_userUsedBonuses_userId', 'userUsedBonuses', 'userId', 'user', 'userId', 'CASCADE'
		);
	}

	/**
	 * @inheritdoc
	 */
	public function down()
	{
		$this->dropForeignKey(
				'fk_userUsedBonuses_userId', 'userUsedBonuses'
		);

		$this->dropIndex(
				'idx_userUsedBonuses_userId', 'userUsedBonuses'
		);

		$this->dropTable('userUsedBonuses');
	}

}
