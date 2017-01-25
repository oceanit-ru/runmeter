<?php

use yii\db\Migration;

/**
 * Handles the creation of table `userprogress`.
 */
class m170125_113610_create_userProgress_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createTable('userProgress', [
			'userProgressId' => $this->primaryKey(),
			'userId' => $this->integer(),
			'screenplayId' => $this->integer(),
			'currentLocationId' => $this->integer(),
			'currentSceneId' => $this->integer(),
			'currentButtonId' => $this->integer(),
			'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
			'updateAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull()
		]);

		/*
		 * columnName = userId
		 */
		$this->createIndex(
				'userProgress_userId_idx', 'userProgress', 'userId'
		);

		$this->addForeignKey(
				'userProgress_userId_user_userId_fk', 'userProgress', 'userId', 'user', 'userId', 'CASCADE'
		);

		/*
		 * columnName = screenplayId
		 */
		$this->createIndex(
				'userProgress_screenplayId_idx', 'userProgress', 'screenplayId'
		);

		$this->addForeignKey(
				'userProgress_screenplayId_screenplay_screenplayId_fk', 'userProgress', 'screenplayId', 'screenplay', 'screenplayId', 'CASCADE'
		);

		/*
		 * columnName = currentLocationId
		 */
		$this->createIndex(
				'userProgress_currentLocationId_idx', 'userProgress', 'currentLocationId'
		);

		$this->addForeignKey(
				'userProgress_currentLocationId_location_locationId_fk', 'userProgress', 'currentLocationId', 'location', 'locationId', 'CASCADE'
		);

		/*
		 * columnName = currentSceneId
		 */
		$this->createIndex(
				'userProgress_currentSceneId_idx', 'userProgress', 'currentSceneId'
		);

		$this->addForeignKey(
				'userProgress_currentSceneId_scene_sceneId_fk', 'userProgress', 'currentSceneId', 'scene', 'sceneId', 'CASCADE'
		);

		/*
		 * columnName = currentButtonId
		 */
		$this->createIndex(
				'userProgress_currentButtonId_idx', 'userProgress', 'currentButtonId'
		);

		$this->addForeignKey(
				'userProgress_currentButtonId_sceneButton_sceneButtonId_fk', 'userProgress', 'currentButtonId', 'sceneButton', 'sceneButtonId', 'CASCADE'
		);
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		/*
		 * columnName = currentButtonId
		 */
		$this->dropForeignKey(
				'userProgress_currentButtonId_sceneButton_sceneButtonId_fk', 'userProgress'
		);

		$this->dropIndex(
				'userProgress_currentButtonId_idx', 'userProgress'
		);

		/*
		 * columnName = currentSceneId
		 */
		$this->dropForeignKey(
				'userProgress_currentSceneId_scene_sceneId_fk', 'userProgress'
		);

		$this->dropIndex(
				'userProgress_currentSceneId_idx', 'userProgress'
		);

		/*
		 * columnName = currentLocationId
		 */
		$this->dropForeignKey(
				'userProgress_currentLocationId_location_locationId_fk', 'userProgress'
		);
		
		$this->dropIndex(
				'userProgress_currentLocationId_idx', 'userProgress'
		);

		/*
		 * columnName = screenplayId
		 */
		$this->dropForeignKey(
				'userProgress_screenplayId_screenplay_screenplayId_fk', 'userProgress'
		);

		$this->dropIndex(
				'userProgress_screenplayId_idx', 'userProgress'
		);

		/*
		 * columnName = userId
		 */
		$this->dropForeignKey(
				'userProgress_userId_user_userId_fk', 'userProgress'
		);

		$this->dropIndex(
				'userProgress_userId_idx', 'userProgress'
		);
		$this->dropTable('userProgress');
	}

}
