<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\SceneButton */

$this->title = Yii::t('app', 'Create Scene Button');
if (isset($model->scene)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Screenplays'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => $model->scene->location->screenplay->name, 'url' => ['screenplays/view', 'id' => $model->scene->location->screenplayId]];
	$this->params['breadcrumbs'][] = ['label' => $model->scene->location->name, 'url' => ['locations/view', 'id' => $model->scene->locationId]];
	$this->params['breadcrumbs'][] = ['label' => $model->scene->name, 'url' => ['scenes/view', 'id' => $model->sceneId]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scene-button-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
