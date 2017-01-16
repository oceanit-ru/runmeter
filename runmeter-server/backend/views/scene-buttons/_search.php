<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SceneButtonSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scene-button-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'sceneButtonId') ?>

    <?= $form->field($model, 'sceneId') ?>

    <?= $form->field($model, 'text') ?>

    <?= $form->field($model, 'action') ?>

    <?= $form->field($model, 'answer') ?>

    <?php // echo $form->field($model, 'segueLocationId') ?>

    <?php // echo $form->field($model, 'segueSceneId') ?>

    <?php // echo $form->field($model, 'cost') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updateAt') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
