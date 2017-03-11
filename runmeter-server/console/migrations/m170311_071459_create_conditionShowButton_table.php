<?php

use yii\db\Migration;

/**
 * Handles the creation of table `conditionshowbutton`.
 */
class m170311_071459_create_conditionShowButton_table extends Migration
{
    /**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createTable('conditionShowButton', [
			'conditionShowButtonId' => $this->primaryKey(),
			'sceneButtonId' => $this->integer()->notNull(),
			'verifiableSceneButtonId' => $this->integer()->notNull(),
			'condition' => $this->boolean()->notNull(),
			'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
			'updateAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull()
		]);

		/*
		 * columnName = sceneButtonId
		 */
		$this->createIndex(
				'conditionSB_sceneButtonId_idx', 'conditionShowButton', 'sceneButtonId'
		);

		$this->addForeignKey(
				'conditionSB_sceneButtonId_sceneButton_sceneButtonId_fk', 'conditionShowButton', 'sceneButtonId', 'sceneButton', 'sceneButtonId', 'CASCADE'
		);

		/*
		 * columnName = verifiableSceneButtonId
		 */
		$this->createIndex(
				'conditionSB_verifiableSceneButtonId_idx', 'conditionShowButton', 'verifiableSceneButtonId'
		);

		$this->addForeignKey(
				'conditionSB_verifiableSceneButtonId_sceneButton_sceneButtonId_fk', 'conditionShowButton', 'verifiableSceneButtonId', 'sceneButton', 'sceneButtonId', 'CASCADE'
		);
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		/*
		 * columnName = sceneButtonId
		 */
		$this->dropForeignKey(
				'conditionSB_sceneButtonId_sceneButton_sceneButtonId_fk', 'conditionShowButton'
		);

		$this->dropIndex(
				'conditionSB_sceneButtonId_idx', 'conditionShowButton'
		);

		/*
		 * columnName = verifiableSceneButtonId
		 */
		$this->dropForeignKey(
				'conditionSB_verifiableSceneButtonId_sceneButton_sceneButtonId_fk', 'conditionShowButton'
		);

		$this->dropIndex(
				'conditionSB_verifiableSceneButtonId_idx', 'conditionShowButton'
		);

		$this->dropTable('conditionShowButton');
	}
}
