<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scenebutton_translation`.
 */
class m170117_130934_create_sceneButton_translation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
         $this->createTable('{{%sceneButtonTranslation}}', [
			'sceneButtonId' => $this->integer()->notNull(),
			'language' => $this->string(16)->notNull(),
			'text' => $this->text(),
			'answer' => $this->text(),
		]);

		$this->addPrimaryKey('', '{{%sceneButtonTranslation}}', ['sceneButtonId', 'language']);
		
		/*
		 * columnName = sceneButtonId
		 */
		$this->createIndex(
				'sceneButtonTranslation_sceneButtonId_idx', 'sceneButtonTranslation', 'sceneButtonId'
		);

		$this->addForeignKey(
				'sceneBTranslation_sceneBId_sceneButton_sceneButtonId_fk', 'sceneButtonTranslation', 'sceneButtonId', 'sceneButton', 'sceneButtonId', 'CASCADE'
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
				'sceneBTranslation_sceneBId_sceneButton_sceneButtonId_fk', 'sceneButtonTranslation'
		);

		$this->dropIndex(
				'sceneButtonTranslation_sceneButtonId_idx', 'sceneButtonTranslation'
		);
		
        $this->dropTable('sceneButtonTranslation');
    }
}
