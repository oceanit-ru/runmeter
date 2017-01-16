<?php

use yii\helpers\Html;
use common\components\StringHelper;


/* @var $this yii\web\View */
/* @var $model common\models\db\SceneButton */

$this->title = Yii::t('app', 'Новая кнопка');
if (isset($model->scene)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сценарии'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->scene->location->screenplay->name, 20), 'url' => ['screenplays/view', 'id' => $model->scene->location->screenplayId]];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->scene->location->name, 20), 'url' => ['locations/view', 'id' => $model->scene->locationId]];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->scene->name, 20), 'url' => ['scenes/view', 'id' => $model->sceneId]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scene-button-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
