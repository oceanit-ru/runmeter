<?php

use yii\db\Migration;

/**
 * Handles the creation of table `location`.
 */
class m170113_065811_create_location_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('location', [
            'locationId' => $this->primaryKey(),
			'screenplayId' => $this->integer(),
			'name' => $this->string(),
			'number' => $this->integer(),
			'image' => $this->string(),
			'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
			'updateAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull()
        ]);
		
		/*
         * columnName = scenarioId
         */
        $this->createIndex(
            'location_screenplayId_idx',
            'location',
            'screenplayId'
        );
			
        $this->addForeignKey(
            'location_screenplayId_screenplay_screenplayId_fk',
            'location',
            'screenplayId',
            'screenplay',
            'screenplayId',
            'CASCADE'
        );
			
        
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'location_screenplayId_screenplay_screenplayId_fk',
            'location'
        );
			
        $this->dropIndex(
            'location_screenplayId_idx',
            'location'
        );
		
        $this->dropTable('location');
    }
}
