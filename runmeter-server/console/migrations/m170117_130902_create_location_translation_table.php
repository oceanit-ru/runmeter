<?php

use yii\db\Migration;

/**
 * Handles the creation of table `location_translation`.
 */
class m170117_130902_create_location_translation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('{{%locationTranslation}}', [
			'locationId' => $this->integer()->notNull(),
			'language' => $this->string(16)->notNull(),
			'name' => $this->string(255),
		]);

		$this->addPrimaryKey('', '{{%locationTranslation}}', ['locationId', 'language']);
		
		/*
		 * columnName = locationId
		 */
		$this->createIndex(
				'locationTranslation_locationId_idx', 'locationTranslation', 'locationId'
		);

		$this->addForeignKey(
				'locationTranslation_locationId_location_locationId_fk', 'locationTranslation', 'locationId', 'location', 'locationId', 'CASCADE'
		);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
		/*
		 * columnName = locationId
		 */
		$this->dropForeignKey(
				'locationTranslation_locationId_location_locationId_fk', 'locationTranslation'
		);

		$this->dropIndex(
				'locationTranslation_locationId_idx', 'locationTranslation'
		);
		
        $this->dropTable('locationTranslation');
    }
}
