<?php

use yii\db\Migration;

/**
 * Handles the creation of table `userloadedscenes`.
 */
class m170125_113648_create_userLoadedScenes_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createTable('userLoadedScenes', [
			'userProgressId' => $this->integer(),
			'sceneId' => $this->integer(),
		]);

		$this->addPrimaryKey('', 'userLoadedScenes', ['userProgressId', 'sceneId']);

		/*
		 * columnName = userProgressId
		 */
		$this->createIndex(
				'userLoadedScenes_userProgressId_idx', 'userLoadedScenes', 'userProgressId'
		);

		$this->addForeignKey(
				'userLS_userProgressId_userProgress_userProgressId_fk', 'userLoadedScenes', 'userProgressId', 'userProgress', 'userProgressId', 'CASCADE'
		);

		/*
		 * columnName = sceneId
		 */
		$this->createIndex(
				'userLoadedScenes_sceneId_idx', 'userLoadedScenes', 'sceneId'
		);

		$this->addForeignKey(
				'userLoadedScenes_sceneId_scene_sceneId_fk', 'userLoadedScenes', 'sceneId', 'scene', 'sceneId', 'CASCADE'
		);
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		$this->dropForeignKey(
				'userLS_userProgressId_userProgress_userProgressId_fk', 'userLoadedScenes'
		);

		$this->dropIndex(
				'userLoadedScenes_userProgressId_idx', 'userLoadedScenes'
		);

		$this->dropForeignKey(
				'userLoadedScenes_sceneId_scene_sceneId_fk', 'userLoadedScenes'
		);

		$this->dropIndex(
				'userLoadedScenes_sceneId_idx', 'userLoadedScenes'
		);

		$this->dropTable('userLoadedScenes');
	}

}
