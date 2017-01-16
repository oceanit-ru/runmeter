<?php

use yii\db\Migration;

/**
 * Handles the creation of table `conditionpressedbutton`.
 */
class m170113_070009_create_conditionPressedButton_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('conditionPressedButton', [
            'conditionPressedButtonId' => $this->primaryKey(),
			'sceneButtonId' => $this->integer(),
			'verifiableSceneButtonId' => $this->integer(),
			'condition' => $this->boolean(),
			'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
			'updateAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull()
        ]);
		
		/*
         * columnName = sceneButtonId
         */
        $this->createIndex(
            'conditionPB_sceneButtonId_idx',
            'conditionPressedButton',
            'sceneButtonId'
        );
			
        $this->addForeignKey(
            'conditionPB_sceneButtonId_sceneButton_sceneButtonId_fk',
            'conditionPressedButton',
            'sceneButtonId',
            'sceneButton',
            'sceneButtonId',
            'CASCADE'
        );
		
		/*
         * columnName = verifiableSceneButtonId
         */
        $this->createIndex(
            'conditionPB_verifiableSceneButtonId_idx',
            'conditionPressedButton',
            'verifiableSceneButtonId'
        );
			
        $this->addForeignKey(
            'conditionPB_verifiableSceneButtonId_sceneButton_sceneButtonId_fk',
            'conditionPressedButton',
            'verifiableSceneButtonId',
            'sceneButton',
            'sceneButtonId',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
		/*
         * columnName = sceneButtonId
         */
        $this->dropForeignKey(
            'conditionPB_sceneButtonId_sceneButton_sceneButtonId_fk',
            'conditionPressedButton'
        );
		
        $this->dropIndex(
            'conditionPB_sceneButtonId_idx',
            'conditionPressedButton'
        );
			
        /*
         * columnName = verifiableSceneButtonId
         */
        $this->dropForeignKey(
            'conditionPB_verifiableSceneButtonId_sceneButton_sceneButtonId_fk',
            'conditionPressedButton'
        );
		
        $this->dropIndex(
            'conditionPB_verifiableSceneButtonId_idx',
            'conditionPressedButton'
        );
		
        $this->dropTable('conditionPressedButton');
    }
}
