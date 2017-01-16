<?php

use yii\helpers\Html;
use common\components\StringHelper;


/* @var $this yii\web\View */
/* @var $model common\models\db\Scene */

$this->title = Yii::t('app', 'Новая сцена');
if (isset($model->location)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сценарии'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->location->screenplay->name, 20), 'url' => ['screenplays/view', 'id' => $model->location->screenplayId]];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->location->name, 20), 'url' => ['locations/view', 'id' => $model->locationId]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scene-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
