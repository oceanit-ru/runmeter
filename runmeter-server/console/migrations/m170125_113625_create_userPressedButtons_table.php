<?php

use yii\db\Migration;

/**
 * Handles the creation of table `userpressedbuttons`.
 */
class m170125_113625_create_userPressedButtons_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createTable('userPressedButtons', [
			'buttonId' => $this->integer(),
			'userProgressId' => $this->integer(),
		]);

		$this->addPrimaryKey('', 'userPressedButtons', ['buttonId', 'userProgressId']);

		/*
		 * columnName = userProgressId
		 */
		$this->createIndex(
				'userPressedButtons_userProgressId_idx', 'userPressedButtons', 'userProgressId'
		);

		$this->addForeignKey(
				'userPB_userProgressId_userProgress_userProgressId_fk', 'userPressedButtons', 'userProgressId', 'userProgress', 'userProgressId', 'CASCADE'
		);

		/*
		 * columnName = buttonId
		 */
		$this->createIndex(
				'userPressedButtons_buttonId_idx', 'userPressedButtons', 'buttonId'
		);

		$this->addForeignKey(
				'userPB_buttonId_sceneButton_sceneButtonId_fk', 'userPressedButtons', 'buttonId', 'sceneButton', 'sceneButtonId', 'CASCADE'
		);
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		$this->dropForeignKey(
				'userPB_userProgressId_userProgress_userProgressId_fk', 'userPressedButtons'
		);

		$this->dropIndex(
				'userPressedButtons_userProgressId_idx', 'userPressedButtons'
		);

		$this->dropForeignKey(
				'userPB_buttonId_sceneButton_sceneButtonId_fk', 'userPressedButtons'
		);

		$this->dropIndex(
				'userPressedButtons_buttonId_idx', 'userPressedButtons'
		);

		$this->dropTable('userPressedButtons');
	}

}
