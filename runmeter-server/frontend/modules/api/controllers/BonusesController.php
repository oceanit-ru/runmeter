<?php

namespace frontend\modules\api\controllers;

class BonusesController extends \yii\web\Controller
{
    public function actionDeposit()
    {
        return $this->render('deposit');
    }

    public function actionGet()
    {
        return $this->render('get');
    }

}
