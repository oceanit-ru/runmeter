<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\FileInput;
use common\widgets\translatableTextInput\TranslatableTextInput;

/* @var $this yii\web\View */
/* @var $model common\models\db\Location */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="location-form">

    <?php $form = ActiveForm::begin(); ?>

	<?=
		TranslatableTextInput::widget([
			'model' => $model,
			'attribute' => 'name',
			'languageList' => [
				['language' => 'ru-RU', 'label' => 'Русский'],
				['language' => 'en-US', 'label' => 'English'],
			],
			'form' => $form
		])
	?>

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
