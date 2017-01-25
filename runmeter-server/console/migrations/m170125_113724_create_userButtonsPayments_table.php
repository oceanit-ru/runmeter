<?php

use yii\db\Migration;

/**
 * Handles the creation of table `userbuttonspayments`.
 */
class m170125_113724_create_userButtonsPayments_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createTable('userButtonsPayments', [
			'userProgressId' => $this->integer(),
			'buttonId' => $this->integer(),
			'cost' => $this->integer(),
		]);

		$this->addPrimaryKey('', 'userButtonsPayments', ['buttonId', 'userProgressId']);

		/*
		 * columnName = buttonId
		 */
		$this->createIndex(
				'userButtonsPayments_buttonId_idx', 'userButtonsPayments', 'buttonId'
		);

		$this->addForeignKey(
				'userButtonsPayments_buttonId_sceneButton_sceneButtonId_fk', 'userButtonsPayments', 'buttonId', 'sceneButton', 'sceneButtonId', 'CASCADE'
		);

		/*
		 * columnName = userProgressId
		 */
		$this->createIndex(
				'userButtonsPayments_userProgressId_idx', 'userButtonsPayments', 'userProgressId'
		);

		$this->addForeignKey(
				'userBP_userProgressId_userProgress_userProgressId_fk', 'userButtonsPayments', 'userProgressId', 'userProgress', 'userProgressId', 'CASCADE'
		);
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		$this->dropForeignKey(
				'userBP_userProgressId_userProgress_userProgressId_fk', 'userButtonsPayments'
		);

		$this->dropIndex(
				'userButtonsPayments_userProgressId_idx', 'userButtonsPayments'
		);

		$this->dropForeignKey(
				'userButtonsPayments_buttonId_sceneButton_sceneButtonId_fk', 'userButtonsPayments'
		);

		$this->dropIndex(
				'userButtonsPayments_buttonId_idx', 'userButtonsPayments'
		);

		$this->dropTable('userButtonsPayments');
	}

}
