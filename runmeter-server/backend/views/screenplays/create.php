<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\db\Screenplay */

$this->title = Yii::t('app', 'Create Screenplay');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Screenplays'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="screenplay-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
