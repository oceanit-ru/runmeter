<?php

use yii\db\Migration;

/**
 * Handles the creation of table `scene`.
 */
class m170113_065832_create_scene_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createTable('scene', [
			'sceneId' => $this->primaryKey(),
			'locationId' => $this->integer(),
			'name' => $this->string(),
			'number' => $this->integer(),
			'displayedButtonCount' => $this->integer(),
			'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
			'updateAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull()
		]);
		
		/*
         * columnName = locationId
         */
        $this->createIndex(
            'scene_locationId_idx',
            'scene',
            'locationId'
        );
			
        $this->addForeignKey(
            'scene_locationId_location_loactionId_fk',
            'scene',
            'locationId',
            'location',
            'locationId',
            'CASCADE'
        );
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		// <move in public function down()>
        $this->dropForeignKey(
            'scene_locationId_location_loactionId_fk',
            'scene'
        );
			
        $this->dropIndex(
            'scene_locationId_idx',
            'scene'
        );
        // </move in public function down()>
		
		$this->dropTable('scene');
	}

}
