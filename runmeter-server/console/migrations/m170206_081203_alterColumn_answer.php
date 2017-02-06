<?php

use yii\db\Migration;

class m170206_081203_alterColumn_answer extends Migration {

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp() {
        /*
         * columnName = answer
         */
        $this->dropForeignKey('sceneButton_answer_sceneButton_sceneButtonId_fk', 'sceneButton');
        $this->dropIndex('sceneButton_answer_idx', 'sceneButton');
        $this->dropColumn('sceneButton', 'answerTextButtonId');
        $this->addColumn('{{%sceneButtonTranslation}}', 'answer', $this->text());
    }

    public function safeDown() {
        $this->addColumn('sceneButton', 'answerTextButtonId', $this->integer());
        /*
         * columnName = answer
         */
       $this->createIndex('sceneButton_answer_idx', 'sceneButton', 'answerTextButtonId');
       $this->addForeignKey('sceneButton_answer_sceneButton_sceneButtonId_fk', 'sceneButton', 'answerTextButtonId', 'sceneButton', 'sceneButtonId', 'CASCADE');
       
       $this->dropColumn('{{%sceneButtonTranslation}}', 'answer');
        
    }

}
