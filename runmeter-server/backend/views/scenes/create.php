<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\Scene */

$this->title = Yii::t('app', 'Create Scene');
if (isset($model->location)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Screenplays'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => $model->location->screenplay->name, 'url' => ['screenplays/view', 'id' => $model->location->screenplayId]];
	$this->params['breadcrumbs'][] = ['label' => $model->location->name, 'url' => ['locations/view', 'id' => $model->locationId]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scene-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
