<?php

namespace frontend\modules\api\controllers;

class AuthorizationController extends \yii\web\Controller
{
    public function actionLogin()
    {
        return $this->render('login');
    }

}
