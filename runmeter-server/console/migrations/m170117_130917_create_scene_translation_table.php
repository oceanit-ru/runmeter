<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scene_translation`.
 */
class m170117_130917_create_scene_translation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%sceneTranslation}}', [
			'sceneId' => $this->integer()->notNull(),
			'language' => $this->string(16)->notNull(),
			'name' => $this->string(255),
		]);

		$this->addPrimaryKey('', '{{%sceneTranslation}}', ['sceneId', 'language']);
		
		/*
		 * columnName = sceneId
		 */
		$this->createIndex(
				'sceneTranslation_sceneId_idx', 'sceneTranslation', 'sceneId'
		);

		$this->addForeignKey(
				'sceneTranslation_sceneId_scene_sceneId_fk', 'sceneTranslation', 'sceneId', 'scene', 'sceneId', 'CASCADE'
		);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
		/*
		 * columnName = sceneId
		 */
		$this->dropForeignKey(
				'sceneTranslation_sceneId_scene_sceneId_fk', 'sceneTranslation'
		);

		$this->dropIndex(
				'sceneTranslation_sceneId_idx', 'sceneTranslation'
		);
		
        $this->dropTable('sceneTranslation');
    }
}
