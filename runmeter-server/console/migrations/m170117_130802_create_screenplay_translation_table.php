<?php

use yii\db\Migration;

/**
 * Handles the creation of table `screenplay_translation`.
 */
class m170117_130802_create_screenplay_translation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
		$this->createTable('{{%screenplayTranslation}}', [
			'screenplayId' => $this->integer()->notNull(),
			'language' => $this->string(16)->notNull(),
			'name' => $this->string(255),
		]);

		$this->addPrimaryKey('', '{{%screenplayTranslation}}', ['screenplayId', 'language']);
		
		/*
		 * columnName = screenplayId
		 */
		$this->createIndex(
				'screenplayTranslation_screenplayId_idx', 'screenplayTranslation', 'screenplayId'
		);

		$this->addForeignKey(
				'screenplayTranslation_screenplayId_screenplay_screenplayId_fk', 'screenplayTranslation', 'screenplayId', 'screenplay', 'screenplayId', 'CASCADE'
		);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
		/*
		 * columnName = screenplayId
		 */
		$this->dropForeignKey(
				'screenplayTranslation_screenplayId_screenplay_screenplayId_fk', 'screenplayTranslation'
		);

		$this->dropIndex(
				'screenplayTranslation_screenplayId_idx', 'screenplayTranslation'
		);
		
        $this->dropTable('screenplayTranslation');
    }
}
