<?php

use yii\db\Migration;

/**
 * Handles the creation of table `conditionloadscene`.
 */
class m170113_065939_create_conditionLoadScene_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createTable('conditionLoadScene', [
			'conditionLoadSceneId' => $this->primaryKey(),
			'sceneButtonId' => $this->integer()->notNull(),
			'sceneId' => $this->integer()->notNull(),
			'condition' => $this->boolean()->notNull(),
			'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
			'updateAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull()
		]);

		/*
		 * columnName = sceneButtonId
		 */
		$this->createIndex(
				'conditionLoadScene_sceneButtonId_idx', 'conditionLoadScene', 'sceneButtonId'
		);

		$this->addForeignKey(
				'conditionLoadScene_sceneButtonId_sceneButton_sceneButtonId_fk', 'conditionLoadScene', 'sceneButtonId', 'sceneButton', 'sceneButtonId', 'CASCADE'
		);

		/*
		 * columnName = sceneId
		 */
		$this->createIndex(
				'conditionLoadScene_sceneId_idx', 'conditionLoadScene', 'sceneId'
		);

		$this->addForeignKey(
				'conditionLoadScene_sceneId_scene_sceneId_fk', 'conditionLoadScene', 'sceneId', 'scene', 'sceneId', 'CASCADE'
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
				'conditionLoadScene_sceneButtonId_sceneButton_sceneButtonId_fk', 'conditionLoadScene'
		);

		$this->dropIndex(
				'conditionLoadScene_sceneButtonId_idx', 'conditionLoadScene'
		);

		/*
		 * columnName = sceneId
		 */
		$this->dropForeignKey(
				'conditionLoadScene_sceneId_scene_sceneId_fk', 'conditionLoadScene'
		);

		$this->dropIndex(
				'conditionLoadScene_sceneId_idx', 'conditionLoadScene'
		);

		$this->dropTable('conditionLoadScene');
	}

}
