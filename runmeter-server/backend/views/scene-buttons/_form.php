<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\db\Location;
use common\models\db\Scene;
use common\models\db\SceneButton;
use kartik\widgets\Select2;
use kartik\widgets\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use common\widgets\translatableTextArea\TranslatableTextArea;

/* @var $this yii\web\View */
/* @var $model common\models\db\SceneButton */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="scene-button-form">

    <?php $form = ActiveForm::begin(); ?>
	
	
    <?= $form->field($model, 'number')->textInput() ?>

	<?=
		TranslatableTextArea::widget([
			'model' => $model,
			'attribute' => 'text',
			'languageList' => [
				['language' => 'ru-RU', 'label' => 'Русский'],
				['language' => 'en-US', 'label' => 'English'],
			],
			'form' => $form
		])
	?>

	<?php
		echo $form->field($model, 'action')->widget(Select2::classname(), [
				'data' => SceneButton::ACTION_TYPE,
				'options' => [
					'placeholder' => Yii::t('app', 'Выберите тип')
				],
				'pluginOptions' => [
					//'allowClear' => true,
				],
				'pluginEvents' => [
					"select2:select" => "onTypeSelect",
				]
				])->label(Yii::t('app', 'Тип'))->hint('Hint');
	?>

	<?php
		echo $form->field($model, 'answerTextButtonId')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(SceneButton::find()->where(['sceneId' => $model->sceneId])->andWhere(['action' => ACTION_TYPE_TEXT])->all(), 'sceneButtonId', 'shortText'),
			'options' => [
				'placeholder' => Yii::t('app', 'Выберите кнопку с ответом')
			],
			'pluginOptions' => [
				'allowClear' => true,
			],
		])->label(Yii::t('app', 'Ответ'));
	?>

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
		echo Html::hiddenInput('input-showTextButtonId', $model->showTextButtonId, ['id'=>'input-showTextButtonId']);
		echo Html::hiddenInput('input-actionType', ACTION_TYPE_TEXT, ['id'=>'input-actionType']);
		
		// Child # 1
		echo $form->field($model, 'segueSceneId')->widget(DepDrop::classname(), [
			'options' => [
				'id'=>'scene-id',
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
		
		
		// Child # 2
		echo $form->field($model, 'showTextButtonId')->widget(DepDrop::classname(), [
			'options' => [
				'placeholder' => Yii::t('app', 'Выберите кнопку')
				],
			'type' => DepDrop::TYPE_SELECT2,
			'select2Options'=>[
				'pluginOptions'=>['allowClear'=>true]
			],
			'pluginOptions'=>[
                'initialize'=>true,
				'depends'=>['scene-id'],
				'url'=>Url::to(['/scene-buttons/scene-buttons']),
				'loadingText' => Yii::t('app', 'Загружаем список кнопок ...'),
				'params'=>['input-showTextButtonId', 'input-segueSceneId', 'input-actionType']
			]
		])->label(Yii::t('app', 'Сцена'));
	?>

    <?= $form->field($model, 'cost')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Создать') : Yii::t('app', 'Сохранить'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
	
	<?php
		$actionTypeText = ACTION_TYPE_TEXT;
		$actionTypeQuestion = ACTION_TYPE_QUESTION;
		$actionTypeSegue = ACTION_TYPE_SEGUE;
		$script = <<< JS
			function onTypeSelect(event) {
				var selectedId = event.params.data.id; 
				if (selectedId == $actionTypeText) {
					$("[name='SceneButton[answerTextButtonId]']").prop('disabled', false);
					$("[name='SceneButton[segueLocationId]']").prop('disabled', false);
					$("[name='SceneButton[segueSceneId]']").prop('disabled', false);
					$("[name='SceneButton[showTextButtonId]']").prop('disabled', false);
					$(".field-scenebutton-action > .hint-block").text("Описание сцены или ответ. Если передана в качестве параметра при открытии сцены или как ответ, то игнориует все ограничения на видимость. На экране всегда отображаеться одна такая кнопка. В случае скрытия на ее месте отображаеться следующая удовлетворяющая условиям, если таких нет, то описание сцены (первая кнопка типа текст).");
				} else if (selectedId == $actionTypeQuestion) {
					$("[name='SceneButton[answerTextButtonId]']").prop('disabled', false);
					$("[name='SceneButton[segueLocationId]']").prop('disabled', true);
					$("[name='SceneButton[segueSceneId]']").prop('disabled', true);
					$("[name='SceneButton[showTextButtonId]']").prop('disabled', true);
					$(".field-scenebutton-action > .hint-block").text("Вопрос требующий ответа. При нажатии текст на кнопке с ответом заменяет верхнюю кнопку с текстом игнорируя все ограничения.");
				} else if (selectedId == $actionTypeSegue) {
					$("[name='SceneButton[answerTextButtonId]']").prop('disabled', true);
					$("[name='SceneButton[segueLocationId]']").prop('disabled', false);
					$("[name='SceneButton[segueSceneId]']").prop('disabled', false);
					$("[name='SceneButton[showTextButtonId]']").prop('disabled', false);
					$(".field-scenebutton-action > .hint-block").text("Переход на другую сцену, в том числе на сцену другой локации. По умолчанию при переходе отображается описание сцены кнопка с текстом, но кнопку можно выбрать.");
				}
			}
JS;
		//маркер конца строки, обязательно сразу, без пробелов и табуляции
		$this->registerJs($script, yii\web\View::POS_READY);
	?>

</div>
