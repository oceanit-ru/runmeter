<?php

use yii\db\Migration;
use common\models\db\User;

class m170131_104225_create_admin_usere extends Migration
{

	public function safeUp()
	{
		$this->insert('user', [
			'email' => Yii::$app->params['adminDefaultEmail'],
			'passwordHash' => Yii::$app->security->generatePasswordHash(Yii::$app->params['adminDefaultPassword']),
			'role' => User::ROLE_ADMIN,
		]);
	}

	public function safeDown()
	{
		
	}

}

