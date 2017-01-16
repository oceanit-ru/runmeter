<?php

use yii\helpers\Html;
use common\components\StringHelper;

/* @var $this yii\web\View */
/* @var $model common\models\db\Scene */

$this->title = Yii::t('app', 'Редактирование {modelClass}: ', [
    'modelClass' => 'сцены',
]) . $model->name;
if (isset($model->location)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сценарии'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->location->screenplay->name, 20), 'url' => ['screenplays/view', 'id' => $model->location->screenplayId]];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->location->name, 20), 'url' => ['locations/view', 'id' => $model->locationId]];
}
$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->name, 20), 'url' => ['view', 'id' => $model->sceneId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Редактирование');
?>
<div class="scene-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
