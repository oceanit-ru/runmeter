<?php

use yii\db\Migration;

/**
 * Handles the creation of table `userconditionloadscene`.
 */
class m170117_065405_create_userConditionLoadScene_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('userLoadScene', [
            'userLoadSceneId' => $this->primaryKey(),
			'screenplayId' => $this->integer()->notNull(),
			'sceneId' => $this->integer()->notNull(),
			'userId' => $this->integer()->notNull(),
        ]);
		
		/*
         * columnName = conditionLoadSceneId
         */
        $this->createIndex(
            'userLS_sceneId_idx',
            'userLoadScene',
            'sceneId'
        );
			
        $this->addForeignKey(
            'userLS_sceneId_scene_sceneId_fk',
            'userLoadScene',
            'sceneId',
            'scene',
            'sceneId',
            'CASCADE'
        );
			
		/*
         * columnName = userId
         */
        $this->createIndex(
            'userLoadScene_userId_idx',
            'userLoadScene',
            'userId'
        );
			
        $this->addForeignKey(
            'userLoadScene_userId_user_userId_fk',
            'userLoadScene',
            'userId',
            'user',
            'userId',
            'CASCADE'
        );
		
		/*
         * columnName = screenplayId
         */
        $this->createIndex(
            'userLoadScene_screenplayId_idx',
            'userLoadScene',
            'screenplayId'
        );
			
        $this->addForeignKey(
            'userLoadScene_screenplayId_screenplay_screenplayId_fk',
            'userLoadScene',
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
         * columnName = conditionLoadSceneId
         */
        $this->dropForeignKey(
            'userLS_sceneId_scene_sceneId_fk',
            'userLoadScene'
        );
		
        $this->dropIndex(
            'userLS_sceneId_idx',
            'userLoadScene'
        );
		
		/*
         * columnName = userId
         */
        $this->dropForeignKey(
            'userLoadScene_userId_user_userId_fk',
            'userLoadScene'
        );
		
        $this->dropIndex(
            'userLoadScene_userId_idx',
            'userLoadScene'
        );
		
		/*
         * columnName = screenplayId
         */
        $this->dropForeignKey(
            'userLoadScene_screenplayId_screenplay_screenplayId_fk',
            'userLoadScene'
        );
		
        $this->dropIndex(
            'userLoadScene_screenplayId_idx',
            'userLoadScene'
        );
		
        $this->dropTable('userLoadScene');
    }
}
