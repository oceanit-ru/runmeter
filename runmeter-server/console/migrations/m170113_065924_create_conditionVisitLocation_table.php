<?php

use yii\db\Migration;

/**
 * Handles the creation of table `conditionvisitlocation`.
 */
class m170113_065924_create_conditionVisitLocation_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createTable('conditionVisitLocation', [
			'conditionVisitLocationId' => $this->primaryKey(),
			'sceneButtonId' => $this->integer()->notNull(),
			'locationId' => $this->integer()->notNull(),
			'condition' => $this->boolean()->notNull(),
			'createdAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP')->notNull(),
			'updateAt' => $this->dateTime()->defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP')->notNull()
		]);

		/*
		 * columnName = sceneButtonId
		 */
		$this->createIndex(
				'conditionVL_sceneButtonId_idx', 'conditionVisitLocation', 'sceneButtonId'
		);

		$this->addForeignKey(
				'conditionVL_sceneButtonId_sceneButton_sceneButtonId_fk', 'conditionVisitLocation', 'sceneButtonId', 'sceneButton', 'sceneButtonId', 'CASCADE'
		);

		/*
		 * columnName = locationId
		 */
		$this->createIndex(
				'conditionVL_locationId_idx', 'conditionVisitLocation', 'locationId'
		);

		$this->addForeignKey(
				'conditionVL_locationId_location_locationId_fk', 'conditionVisitLocation', 'locationId', 'location', 'locationId', 'CASCADE'
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
				'conditionVL_sceneButtonId_sceneButton_sceneButtonId_fk', 'conditionVisitLocation'
		);

		$this->dropIndex(
				'conditionVL_sceneButtonId_idx', 'conditionVisitLocation'
		);

		/*
		 * columnName = locationId
		 */
		$this->dropForeignKey(
				'conditionVL_locationId_location_locationId_fk', 'conditionVisitLocation'
		);

		$this->dropIndex(
				'conditionVL_locationId_idx', 'conditionVisitLocation'
		);

		$this->dropTable('conditionVisitLocation');
	}

}
