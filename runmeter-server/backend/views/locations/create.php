<?php

use yii\helpers\Html;
use common\components\StringHelper;


/* @var $this yii\web\View */
/* @var $model common\models\db\Location */

$this->title = Yii::t('app', 'Новая локация');
if (isset($model->screenplay)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сценарии'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->screenplay->name, 20), 'url' => ['screenplays/view', 'id' => $model->screenplayId]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
