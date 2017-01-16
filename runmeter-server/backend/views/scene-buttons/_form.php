<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\db\Location;
use common\models\db\Scene;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\db\SceneButton */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scene-button-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]) ?>

	<?php
		echo $form->field($model, 'action')->widget(Select2::classname(), [
			'data' => \common\models\db\SceneButton::ACTION_TYPE,
			'options' => [
				'placeholder' => Yii::t('app', 'Выберите тип')
			],
			'pluginOptions' => [
				'allowClear' => true,
			],
		])->label(Yii::t('app', 'Тип'));
	?>

    <?= $form->field($model, 'answer')->textarea(['rows' => 6]) ?>

	<?php
		echo $form->field($model, 'segueLocationId')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(Location::find()->where(['screenplayId' => $model->scene->location->screenplayId])->all(), 'locationId', 'name'),
			'options' => [
				'id'=>'location-id',
				'placeholder' => Yii::t('app', 'Выберите локацию')
			],
			'pluginOptions' => [
				'allowClear' => true,
			],
		])->label(Yii::t('app', 'Локация'));
		
		
		echo Html::hiddenInput('input-segueSceneId', $model->segueSceneId, ['id'=>'input-segueSceneId']);
		echo Html::hiddenInput('input-segueLocationId', $model->segueLocationId, ['id'=>'input-segueLocationId']);
		
		// Child # 1
		echo $form->field($model, 'segueSceneId')->widget(DepDrop::classname(), [
			'options' => [
				'placeholder' => Yii::t('app', 'Выберите сцену')
				],
			'type' => DepDrop::TYPE_SELECT2,
			'select2Options'=>[
				'pluginOptions'=>['allowClear'=>true]
			],
			'pluginOptions'=>[
                'initialize'=>true,
				'depends'=>['location-id'],
				'url'=>Url::to(['/scenes/scenes']),
				'loadingText' => Yii::t('app', 'загружаем список сцен ...'),
				'params'=>['input-segueSceneId', 'input-segueLocationId']
			]
		])->label(Yii::t('app', 'Сцена'));
	?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
