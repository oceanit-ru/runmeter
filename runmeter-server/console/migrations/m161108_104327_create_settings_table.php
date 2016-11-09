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
	}

	/**
	 * @inheritdoc
	 */
	public function safeDown()
	{
		$this->dropTable('settings');
	}

}
