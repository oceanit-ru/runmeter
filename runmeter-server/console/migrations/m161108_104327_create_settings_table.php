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
			'isDebugSettings' => $this->boolean(),
			'initialReferencePeriod' => $this->decimal(6, 2),
			'maximumReferencePeriod' => $this->decimal(6, 2),
			'bonusDivider' => $this->integer(),
			'bonusThreshold' => $this->integer(),
			'maximumBonusesInReferencePeriod' => $this->integer(),
			'useDataEnteredByUser' => $this->boolean(),
		]);
		$this->insert('settings', [
			'isDebugSettings' => true,
			'initialReferencePeriod' => 24,
			'maximumReferencePeriod' => 36,
			'bonusDivider' => 100,
			'bonusThreshold' => 3000,
			'maximumBonusesInReferencePeriod' => 1500,
			'useDataEnteredByUser' => 1,
		]);
		$this->insert('settings', [
			'isDebugSettings' => false,
			'initialReferencePeriod' => 24,
			'maximumReferencePeriod' => 36,
			'bonusDivider' => 100,
			'bonusThreshold' => 3000,
			'maximumBonusesInReferencePeriod' => 100,
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
