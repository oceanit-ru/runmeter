<?php

use yii\db\Migration;

/**
 * Handles the creation of table `settings`.
 */
class m161108_104327_create_settings_table extends Migration
{

	/**
	 * @inheritdoc
	 */
	public function safeUp()
	{
		$this->createTable('settings', [
			'settingsId' => $this->primaryKey(),
			'initialReferencePeriod' => $this->decimal(6, 2),
			'maximumReferencePeriod' => $this->decimal(6, 2),
			'bonusDivider' => $this->integer(),
			'bonusThreshold' => $this->integer(),
			'maximumBonusesInReferencePeriod' => $this->integer(),
			'useDataEnteredByUser' => $this->boolean(),
		]);
		$this->insert('settings', [
			'settingsId' => 1,
			'initialReferencePeriod' => 24,
			'maximumReferencePeriod' => 36,
			'bonusDivider' => 100,
			'bonusThreshold' => 300,
			'maximumBonusesInReferencePeriod' => 1500,
			'useDataEnteredByUser' => 1,
        ]);
		$this->insert('settings', [
			'settingsId' => 0,
			'initialReferencePeriod' => 24,
			'maximumReferencePeriod' => 36,
			'bonusDivider' => 1000,
			'bonusThreshold' => 3000,
			'maximumBonusesInReferencePeriod' => 25,
			'useDataEnteredByUser' => 1,
        ]);
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		$this->dropTable('settings');
	}

}
