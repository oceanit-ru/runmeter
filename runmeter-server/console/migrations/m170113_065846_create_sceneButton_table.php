<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scenebutton`.
 */
class m170113_065846_create_sceneButton_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createTable('sceneButton', [
			'sceneButtonId' => $this->primaryKey(),
			'sceneId' => $this->integer(),
			'number' => $this->integer(),
			'action' => $this->integer(),
			'answerTextButtonId' => $this->integer(),
			'segueLocationId' => $this->integer(),
			'segueSceneId' => $this->integer(),
			'showTextButtonId' => $this->integer(),
			'cost' => $this->integer(),
			'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
			'updateAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull()
		]);

		/*
		 * columnName = sceneId
		 */
		$this->createIndex('sceneButton_sceneId_idx', 'sceneButton', 'sceneId');
		$this->addForeignKey('sceneButton_sceneId_scene_sceneId_fk', 'sceneButton', 'sceneId', 'scene', 'sceneId', 'CASCADE');

		/*
		 * columnName = segueLocationId
		 */
		$this->createIndex('sceneButton_segueLocationId_idx', 'sceneButton', 'segueLocationId');
		$this->addForeignKey('sceneButton_segueLocationId_location_locationId_fk', 'sceneButton', 'segueLocationId', 'location', 'locationId', 'CASCADE');

		/*
		 * columnName = segueSceneId
		 */
		$this->createIndex('sceneButton_segueSceneId_idx', 'sceneButton', 'segueSceneId');
		$this->addForeignKey('sceneButton_segueSceneId_scene_sceneId_fk', 'sceneButton', 'segueSceneId', 'scene', 'sceneId', 'CASCADE');

		/*
		 * columnName = answer
		 */
		$this->createIndex('sceneButton_answer_idx', 'sceneButton', 'answerTextButtonId');
		$this->addForeignKey('sceneButton_answer_sceneButton_sceneButtonId_fk', 'sceneButton', 'answerTextButtonId', 'sceneButton', 'sceneButtonId', 'CASCADE');

		/*
		 * columnName = showTextButtonId
		 */
		$this->createIndex('sceneButton_showTextButtonId_idx', 'sceneButton', 'showTextButtonId');
		$this->addForeignKey('sceneButton_showTextButtonId_sceneButton_sceneButtonId_fk', 'sceneButton', 'showTextButtonId', 'sceneButton', 'sceneButtonId', 'CASCADE');
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		/*
		 * columnName = sceneId
		 */
		$this->dropForeignKey('sceneButton_sceneId_scene_sceneId_fk', 'sceneButton');
		$this->dropIndex('sceneButton_sceneId_idx', 'sceneButton');

		/*
		 * columnName = segueLocationId
		 */
		$this->dropForeignKey('sceneButton_segueLocationId_location_locationId_fk', 'sceneButton');
		$this->dropIndex('sceneButton_segueLocationId_idx', 'sceneButton');

		/*
		 * columnName = segueSceneId
		 */
		$this->dropForeignKey('sceneButton_segueSceneId_scene_sceneId_fk', 'sceneButton');
		$this->dropIndex('sceneButton_segueSceneId_idx', 'sceneButton');

		/*
		 * columnName = answer
		 */
		$this->dropForeignKey('sceneButton_answer_sceneButton_sceneButtonId_fk', 'sceneButton');
		$this->dropIndex('sceneButton_answer_idx', 'sceneButton');

		/*
		 * columnName = showTextButtonId
		 */
		$this->dropForeignKey('sceneButton_showTextButtonId_sceneButton_sceneButtonId_fk', 'sceneButton');
		$this->dropIndex('sceneButton_showTextButtonId_idx', 'sceneButton');

		$this->dropTable('sceneButton');
	}

}
