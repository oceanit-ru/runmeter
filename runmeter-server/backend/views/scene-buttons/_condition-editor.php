<?php
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use common\models\db\ConditionPressedButton;
use common\models\db\ConditionShowButton;
use yii\helpers\ArrayHelper;
use common\models\db\Location;
use common\models\db\Scene;
use common\models\db\SceneButton;
use yii\bootstrap\ActiveForm;
use kartik\widgets\Select2;
use yii\helpers\Html;
use kartik\widgets\DepDrop;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\db\SceneButton */
?>

<!-- Conditions Pressed Button -->

<h2><?= Html::encode("Нажата кнопка") ?></h2>

<div class="scene-form">
	<?php 
		$modelConditionsPressedButton = new ConditionPressedButton();
		$modelConditionsPressedButton->sceneButtonId = $model->sceneButtonId;

		$form = ActiveForm::begin([
			'id' => 'conditions-pressed-button-form',
			'action' => 'add-conditions-pressed-button',
			'options' => ['data' => ['gridview' => 'condition-pressed-button-gridview']]
		]);

		echo Html::activeHiddenInput($modelConditionsPressedButton, 'sceneButtonId');
		
		echo '<label class="control-label">' . Yii::t('app', 'Локация') . '</label>';
		echo Select2::widget([
			'name' => 'loaction-select-cpbf',
			'data' => ArrayHelper::map(Location::find()->where(['screenplayId' => $model->scene->location->screenplayId])->all(), 'locationId', 'name'),
			'options' => [
				'id'=>'location-id-cpbf',
				'placeholder' => Yii::t('app', 'Выберите локацию')
			],
			'pluginOptions' => [
				'allowClear' => true,
			],
		]);

		echo Html::hiddenInput('input-verifiableSceneButtonId-cpbf', $modelConditionsPressedButton->verifiableSceneButtonId, ['id'=>'input-verifiableSceneButtonId-cpbf']);
		echo Html::hiddenInput('input-sceneId-cpbf', isset($modelConditionsPressedButton->verifiableSceneButton->sceneId) ? $modelConditionsPressedButton->verifiableSceneButton->sceneId : NULL, ['id'=>'input-sceneId-cpbf']);
		echo Html::hiddenInput('input-locationId-cpbf', isset($modelConditionsPressedButton->verifiableSceneButton->scene->locationId) ? $modelConditionsPressedButton->verifiableSceneButton->scene->locationId : NULL, ['id'=>'input-locationId-cpbf']);

		// Child # 1
		echo '<label class="control-label">' . Yii::t('app', 'Сцена') . '</label>';
		echo DepDrop::widget([
			'name' => 'scene-select-cpbf',
			'options' => [
				'id'=>'scene-id-cpbf',
				'placeholder' => Yii::t('app', 'Выберите сцену')
				],
			'type' => DepDrop::TYPE_SELECT2,
			'select2Options'=>[
				'pluginOptions'=>['allowClear'=>true]
			],
			'pluginOptions'=>[
				'initialize'=>true,
				'depends'=>['location-id-cpbf'],
				'url'=>Url::to(['/scenes/scenes']),
				'loadingText' => Yii::t('app', 'загружаем список сцен ...'),
				'params'=>['input-sceneId-cpbf', 'input-locationId-cpbf']
			]
		]);
		
		// Child # 2
		echo $form->field($modelConditionsPressedButton, 'verifiableSceneButtonId')->widget(DepDrop::classname(), [
			'options' => [
				'placeholder' => Yii::t('app', 'Выберите кнопку')
				],
			'type' => DepDrop::TYPE_SELECT2,
			'select2Options'=>[
				'pluginOptions'=>['allowClear'=>true]
			],
			'pluginOptions'=>[
				'initialize'=>true,
				'depends'=>['scene-id-cpbf'],
				'url'=>Url::to(['/scene-buttons/scene-buttons']),
				'loadingText' => Yii::t('app', 'загружаем список кнопок ...'),
				'params'=>['input-verifiableSceneButtonId-cpbf', 'input-sceneId-cpbf']
			]
		])->label(Yii::t('app', 'Кнопка'));

		echo $form->field($modelConditionsPressedButton, 'condition')->widget(Select2::classname(), [
			'data' => ['Нет', 'Да'],
			'options' => [
				'placeholder' => Yii::t('app', 'Выберите условие ...')
			]
		])->label('Условие (нажата или нет)');
	?>

	<div class="form-group">
		<?= Html::buttonInput(Yii::t('app', 'Create'), ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' condition-save-button']) ?>
	</div>

	<?php ActiveForm::end(); ?>
</div>



<?php
	$conditionPressedButtonGridColumns = [
		[
			'attribute'=>'verifiableSceneButtonId',
			'width'=>'100px',
		],
		[
			'class'=>'kartik\grid\EditableColumn',
			'attribute'=>'verifiableSceneButtonId',
			'editableOptions'=>[
				'header'=>'Кнопка',
				'inputType'=>\kartik\editable\Editable::INPUT_SELECT2,
				'formOptions' => ['action' => ['edit-condition-pressed-button']],
				'options' => [
					'data' => ArrayHelper::map(SceneButton::find()->where(['sceneId' => $model->sceneId])->all(), 'sceneButtonId', 'text'),
				],
			],
			'value' => function($model){
				return isset($model->verifiableSceneButton) ? $model->verifiableSceneButton->text : null;
			},
			'refreshGrid' => true,
			'format'=>'text'
		],
		[
			'class'=>'kartik\grid\EditableColumn',
			'attribute'=>'condition',
			'editableOptions'=>[
				'header'=>'Условие (нажата или нет)',
				'inputType'=>\kartik\editable\Editable::INPUT_SELECT2,
				'formOptions' => ['action' => ['edit-condition-pressed-button']],
				'options' => [
					'data' => ['Нет', 'Да'],
				],
			],
			'refreshGrid' => true,
			'format'=>'boolean'
		],
		[
			'class' => 'kartik\grid\ActionColumn',
			'dropdown' => false,
			'vAlign'=>'middle',
			'urlCreator' => function($action, $model, $key, $index) { 
					return [$action.'-pressed-button'];
			},
			'buttons' =>[
				'delete' => function ($url, $model, $key) {
					return Html::button('<span class="glyphicon glyphicon-trash"></span>', 
							[
								'class' => 'btn btn-default' . ' condition-delete-button', 
								'data' => ['gridview' => 'condition-pressed-button-gridview', 'url' => $url, 'id' => $key],
								'onclick' => 'deleteButtonClick(event)'
							]);
				}
			],
			'template'=>'{delete}'
		],
	];
	$conditionPressedButtonDataProvider = new ActiveDataProvider([
		'query' => ConditionPressedButton::find()->where(['sceneButtonId' => $model->sceneButtonId]),
	]);
	echo GridView::widget([
		'dataProvider'=> $conditionPressedButtonDataProvider,
		'columns' => $conditionPressedButtonGridColumns,
		'id' => 'condition-pressed-button-gridview',
		'pjax'=>true,
		'pjaxSettings'=>[
			'neverTimeout'=>true,
		]
	]);
?>

<!-- Conditions Show Button -->

<h2><?= Html::encode("Показывается с/без кнопки") ?></h2>

<div class="scene-form">
	<?php 
		$modelConditionsShowButton = new ConditionShowButton();
		$modelConditionsShowButton->sceneButtonId = $model->sceneButtonId;
		$modelConditionsShowButton->sceneButtonId = $model->sceneButtonId;
		$modelConditionsShowButton->sceneButtonId = $model->sceneButtonId;

		$formSB = ActiveForm::begin([
			'id' => 'conditions-show-button-form',
			'action' => 'add-conditions-show-button',
			'options' => ['data' => ['gridview' => 'condition-show-button-gridview']]
		]);

		echo Html::activeHiddenInput($modelConditionsShowButton, 'sceneButtonId');
		echo $form->field($modelConditionsShowButton, 'verifiableSceneButtonId')->widget(Select2::classname(), [
			'name' => 'show-button-select-csb',
					'data' => ArrayHelper::map(SceneButton::find()->where(['sceneId' => $model->sceneId])->andWhere(['<>', 'sceneButtonId', $model->sceneButtonId])->all(), 'sceneButtonId', 'shortText'),
			'options' => [
				'id'=>'show-button-id-csb',
				'placeholder' => Yii::t('app', 'Выберите локацию')
			],
			'pluginOptions' => [
				'allowClear' => true,
			],
		])->label(Yii::t('app', 'Кнопка'));

		echo $form->field($modelConditionsShowButton, 'condition')->widget(Select2::classname(), [
			'data' => ['Не видна', 'Видна'],
			'options' => [
				'placeholder' => Yii::t('app', 'Выберите условие ...')
			]
		])->label('Условие (видна или нет)');
	?>

	<div class="form-group">
		<?= Html::buttonInput(Yii::t('app', 'Create'), ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' condition-save-button']) ?>
	</div>

	<?php ActiveForm::end(); ?>
</div>



<?php
	$conditionShowButtonGridColumns = [
		[
			'attribute'=>'verifiableSceneButtonId',
			'width'=>'100px',
		],
		[
			'class'=>'kartik\grid\EditableColumn',
			'attribute'=>'verifiableSceneButtonId',
			'editableOptions'=>[
				'header'=>'Кнопка',
				'inputType'=>\kartik\editable\Editable::INPUT_SELECT2,
				'formOptions' => ['action' => ['edit-condition-show-button']],
				'options' => [
					'data' => ArrayHelper::map(SceneButton::find()->where(['sceneId' => $model->sceneId])->all(), 'sceneButtonId', 'text'),
				],
			],
			'value' => function($model){
				return isset($model->verifiableSceneButton) ? $model->verifiableSceneButton->text : null;
			},
			'refreshGrid' => true,
			'format'=>'text'
		],
		[
			'class'=>'kartik\grid\EditableColumn',
			'attribute'=>'condition',
			'editableOptions'=>[
				'header'=>'Условие (видна или нет)',
				'inputType'=>\kartik\editable\Editable::INPUT_SELECT2,
				'formOptions' => ['action' => ['edit-condition-show-button']],
				'options' => [
					'data' => ['Не видна', 'Видна'],
				],
			],
			'refreshGrid' => true,
			'format'=>'boolean'
		],
		[
			'class' => 'kartik\grid\ActionColumn',
			'dropdown' => false,
			'vAlign'=>'middle',
			'urlCreator' => function($action, $model, $key, $index) { 
					return [$action.'-show-button'];
			},
			'buttons' =>[
				'delete' => function ($url, $model, $key) {
					return Html::button('<span class="glyphicon glyphicon-trash"></span>', 
							[
								'class' => 'btn btn-default' . ' condition-delete-button', 
								'data' => ['gridview' => 'condition-show-button-gridview', 'url' => $url, 'id' => $key],
								'onclick' => 'deleteButtonClick(event)'
							]);
				}
			],
			'template'=>'{delete}'
		],
	];
	$conditionShowButtonDataProvider = new ActiveDataProvider([
		'query' => ConditionShowButton::find()->where(['sceneButtonId' => $model->sceneButtonId])->andWhere(['<>','verifiableSceneButtonId', $model->sceneButtonId]),
	]);
	echo GridView::widget([
		'dataProvider'=> $conditionShowButtonDataProvider,
		'columns' => $conditionShowButtonGridColumns,
		'id' => 'condition-show-button-gridview',
		'pjax'=>true,
		'pjaxSettings'=>[
			'neverTimeout'=>true,
		]
	]);
?>

