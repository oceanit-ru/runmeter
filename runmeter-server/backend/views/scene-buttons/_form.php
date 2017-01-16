<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\db\SceneButton */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scene-button-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'action')->textInput() ?>

    <?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'segueLocationId')->textInput() ?>

    <?= $form->field($model, 'segueSceneId')->textInput() ?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
