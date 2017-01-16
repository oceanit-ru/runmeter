<?php

use yii\helpers\Html;
use common\components\StringHelper;

/* @var $this yii\web\View */
/* @var $model common\models\db\Screenplay */

$this->title = Yii::t('app', 'Редактрование {modelClass}: ', [
    'modelClass' => 'Сценария',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сценарии'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->screenplayId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактирование');
?>
<div class="screenplay-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
