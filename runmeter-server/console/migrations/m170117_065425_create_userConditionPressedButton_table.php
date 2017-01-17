<?php

use yii\db\Migration;

/**
 * Handles the creation of table `userconditionpressedbutton`.
 */
class m170117_065425_create_userConditionPressedButton_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('userPressedButton', [
            'userPressedButtonId' => $this->primaryKey(),
			'screenplayId' => $this->integer()->notNull(),
			'sceneButtonId' => $this->integer()->notNull(),
			'userId' => $this->integer()->notNull(),
        ]);
		
		/*
         * columnName = conditionPressedButtonId
         */
        $this->createIndex(
            'userPB_sceneButtonId_idx',
            'userPressedButton',
            'sceneButtonId'
        );
			
        $this->addForeignKey(
            'userPB_sceneButtonId_sceneButton_sceneButtonId_fk',
            'userPressedButton',
            'sceneButtonId',
            'sceneButton',
            'sceneButtonId',
            'CASCADE'
        );
			
		/*
         * columnName = userId
         */
        $this->createIndex(
            'userPressedButton_userId_idx',
            'userPressedButton',
            'userId'
        );
			
        $this->addForeignKey(
            'userPressedButton_userId_user_userId_fk',
            'userPressedButton',
            'userId',
            'user',
            'userId',
            'CASCADE'
        );
		
		/*
         * columnName = screenplayId
         */
        $this->createIndex(
            'userPressedButton_screenplayId_idx',
            'userPressedButton',
            'screenplayId'
        );
			
        $this->addForeignKey(
            'userPressedButton_screenplayId_screenplay_screenplayId_fk',
            'userPressedButton',
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
         * columnName = conditionPressedButtonId
         */
        $this->dropForeignKey(
            'userPB_sceneButtonId_sceneButton_sceneButtonId_fk',
            'userPressedButton'
        );
		
        $this->dropIndex(
            'userPB_sceneButtonId_idx',
            'userPressedButton'
        );
		
		/*
         * columnName = userId
         */
        $this->dropForeignKey(
            'userPressedButton_userId_user_userId_fk',
            'userPressedButton'
        );
		
        $this->dropIndex(
            'userPressedButton_userId_idx',
            'userPressedButton'
        );
		
		/*
         * columnName = screenplayId
         */
        $this->dropForeignKey(
            'userPressedButton_screenplayId_screenplay_screenplayId_fk',
            'userPressedButton'
        );
		
        $this->dropIndex(
            'userPressedButton_screenplayId_idx',
            'userPressedButton'
        );
		
        $this->dropTable('userPressedButton');
    }
}
