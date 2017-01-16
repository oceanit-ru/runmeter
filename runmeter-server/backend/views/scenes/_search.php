<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SceneSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scene-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sceneId') ?>

    <?= $form->field($model, 'locationId') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'displayedButtonCount') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updateAt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
