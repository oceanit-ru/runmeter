<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scenario`.
 */
class m170113_065026_create_scenario_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createTable('scenario', [
			'scenarioId' => $this->primaryKey(),
			'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
			'updateAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')->notNull()
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		$this->dropTable('scenario');
	}

}
