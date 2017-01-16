<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\db\Location */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="location-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'number')->textInput() ?>

	<?php
		echo $form->field($model, 'image')->widget(FileInput::className(), [
			'options' => ['accept' => 'image/*'],
			'pluginOptions' => [
				'initialPreview' => $model->getThumbUrl(),
				'initialPreviewAsData' => true,
				'showPreview' => true,
				'showCaption' => true,
				'showRemove' => true,
				'showUpload' => false
			]
		]);
	?>
	<!--<?= $form->field($model, 'image')->fileInput()->label('') ?>-->

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
