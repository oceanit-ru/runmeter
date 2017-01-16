<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\Location */

$this->title = Yii::t('app', 'Create Location');
if (isset($model->screenplay)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Screenplays'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => $model->screenplay->name, 'url' => ['screenplays/view', 'id' => $model->screenplayId]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
