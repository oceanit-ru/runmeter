<?php

use yii\db\Migration;

/**
 * Handles the creation of table `uservisitedlocations`.
 */
class m170125_113703_create_userVisitedLocations_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createTable('userVisitedLocations', [
			'userProgressId' => $this->integer(),
			'locationId' => $this->integer(),
		]);
		
		$this->addPrimaryKey('', 'userVisitedLocations', ['userProgressId', 'locationId']);

		/*
		 * columnName = userProgressId
		 */
		$this->createIndex(
				'userVisitedLocations_userProgressId_idx', 'userVisitedLocations', 'userProgressId'
		);

		$this->addForeignKey(
				'userVL_userProgressId_userProgress_userProgressId_fk', 'userVisitedLocations', 'userProgressId', 'userProgress', 'userProgressId', 'CASCADE'
		);

		/*
		 * columnName = locationId
		 */
		$this->createIndex(
				'userVisitedLocations_locationId_idx', 'userVisitedLocations', 'locationId'
		);

		$this->addForeignKey(
				'userVisitedLocations_locationId_location_locationId_fk', 'userVisitedLocations', 'locationId', 'location', 'locationId', 'CASCADE'
		);
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		$this->dropForeignKey(
				'userVL_userProgressId_userProgress_userProgressId_fk', 'userVisitedLocations'
		);

		$this->dropIndex(
				'userVisitedLocations_userProgressId_idx', 'userVisitedLocations'
		);

		$this->dropForeignKey(
				'userVisitedLocations_locationId_location_locationId_fk', 'userVisitedLocations'
		);

		$this->dropIndex(
				'userVisitedLocations_locationId_idx', 'userVisitedLocations'
		);

		$this->dropTable('userVisitedLocations');
	}

}
