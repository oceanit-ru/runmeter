<?php

use yii\db\Migration;

/**
 * Handles the creation of table `userconditionvisitlocation`.
 */
class m170117_065255_create_userConditionVisitLocation_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('userVisitLocation', [
            'userVisitLocationId' => $this->primaryKey(),
			'screenplayId' => $this->integer()->notNull(),
			'locationId' => $this->integer()->notNull(),
			'userId' => $this->integer()->notNull(),
        ]);
		
		/*
         * columnName = conditionVisitLocationId
         */
        $this->createIndex(
            'userVL_locationId_idx',
            'userVisitLocation',
            'locationId'
        );
			
        $this->addForeignKey(
            'userVL_locationId_location_locationId_fk',
            'userVisitLocation',
            'locationId',
            'location',
            'locationId',
            'CASCADE'
        );
			
		/*
         * columnName = userId
         */
        $this->createIndex(
            'userVisitLocation_userId_idx',
            'userVisitLocation',
            'userId'
        );
			
        $this->addForeignKey(
            'userVisitLocation_userId_user_userId_fk',
            'userVisitLocation',
            'userId',
            'user',
            'userId',
            'CASCADE'
        );
		
		/*
         * columnName = screenplayId
         */
        $this->createIndex(
            'userVisitLocation_screenplayId_idx',
            'userVisitLocation',
            'screenplayId'
        );
			
        $this->addForeignKey(
            'userVisitLocation_screenplayId_screenplay_screenplayId_fk',
            'userVisitLocation',
            'screenplayId',
            'screenplay',
            'screenplayId',
            'CASCADE'
        );
			
        
        // </move in public function down()>
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
		/*
         * columnName = conditionVisitLocationId
         */
        $this->dropForeignKey(
            'userVL_locationId_location_locationId_fk',
            'userVisitLocation'
        );
		
        $this->dropIndex(
            'userVL_locationId_idx',
            'userVisitLocation'
        );
		
		/*
         * columnName = userId
         */
        $this->dropForeignKey(
            'userVisitLocation_userId_user_userId_fk',
            'userVisitLocation'
        );
		
        $this->dropIndex(
            'userVisitLocation_userId_idx',
            'userVisitLocation'
        );
		
		/*
         * columnName = screenplayId
         */
        $this->dropForeignKey(
            'userVisitLocation_screenplayId_screenplay_screenplayId_fk',
            'userVisitLocation'
        );
		
        $this->dropIndex(
            'userVisitLocation_screenplayId_idx',
            'userVisitLocation'
        );
		
        $this->dropTable('userVisitLocation');
    }
}
