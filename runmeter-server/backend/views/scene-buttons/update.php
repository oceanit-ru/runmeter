<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\db\SceneButton */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Scene Button',
]) . $model->sceneButtonId;
if (isset($model->scene)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Screenplays'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => $model->scene->location->screenplay->name, 'url' => ['screenplays/view', 'id' => $model->scene->location->screenplayId]];
	$this->params['breadcrumbs'][] = ['label' => $model->scene->location->name, 'url' => ['locations/view', 'id' => $model->scene->locationId]];
	$this->params['breadcrumbs'][] = ['label' => $model->scene->name, 'url' => ['scenes/view', 'id' => $model->sceneId]];
}
$this->params['breadcrumbs'][] = ['label' => $model->sceneButtonId, 'url' => ['view', 'id' => $model->sceneButtonId]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="scene-button-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
