<?php

use yii\helpers\Html;
use common\components\StringHelper;

/* @var $this yii\web\View */
/* @var $model common\models\db\Location */

$this->title = Yii::t('app', 'Редактирование {modelClass}: ', [
    'modelClass' => 'Локации',
]) . $model->name;
if (isset($model->screenplay)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сцены'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->screenplay->name, 20), 'url' => ['screenplays/view', 'id' => $model->screenplayId]];
}
$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->name, 20), 'url' => ['view', 'id' => $model->locationId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактирование');
?>
<div class="location-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
