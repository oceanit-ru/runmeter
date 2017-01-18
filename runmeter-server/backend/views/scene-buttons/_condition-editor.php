<?php
use kartik\grid\GridView;
use yii\data\ActiveDataProvider;
use common\models\db\ConditionVisitLocation;
use common\models\db\ConditionLoadScene;
use common\models\db\ConditionPressedButton;
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
<!-- Conditions Visit Location -->

<h2><?= Html::encode("Посещена локация") ?></h2>

<div class="scene-form">
	<?php 
		$modelConditionsVisitLocation = new ConditionVisitLocation();
		$modelConditionsVisitLocation->sceneButtonId = $model->sceneButtonId;

		$form = ActiveForm::begin([
			'id' => 'conditions-visit-location-form',
			'action' => 'add-conditions-visit-location',
			'options' => ['data' => ['gridview' => 'condition-visit-location-gridview']]
		]);

		echo Html::activeHiddenInput($modelConditionsVisitLocation, 'sceneButtonId');
		
		echo $form->field($modelConditionsVisitLocation, 'locationId')->widget(Select2::classname(), [
			'data' => ArrayHelper::map(Location::find()->where(['screenplayId' => $model->scene->location->screenplayId])->all(), 'locationId', 'name'),
			'options' => [
				'placeholder' => Yii::t('app', 'Выберите локацию ...')
			]
		])->label('Локация');

		echo $form->field($modelConditionsVisitLocation, 'condition')->widget(Select2::classname(), [
			'data' => ['Нет', 'Да'],
			'options' => [
				'placeholder' => Yii::t('app', 'Выберите условие ...')
			]
		])->label('Условие (посетил или нет)');
	?>

	<div class="form-group">
		<?= Html::buttonInput(Yii::t('app', 'Create'), ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' condition-save-button']) ?>
	</div>

	<?php ActiveForm::end(); ?>
</div>



<?php
	$conditionVisitLocationGridColumns = [
		[
			'attribute'=>'conditionVisitLocationId',
			'width'=>'100px',
		],
		[
			'class'=>'kartik\grid\EditableColumn',
			'attribute'=>'locationId',
			'editableOptions'=>[
				'header'=>'Локация',
				'inputType'=>\kartik\editable\Editable::INPUT_SELECT2,
				'formOptions' => ['action' => ['edit-condition-visit-location']],
				'options' => [
					'data' => ArrayHelper::map(Location::find()->where(['screenplayId' => $model->scene->location->screenplayId])->all(), 'locationId', 'name'),
				],
			],
			'value' => function($model){
				return isset($model->location) ? $model->location->name : null;
			},
			'refreshGrid' => true,
			'format'=>'text'
		],
		[
			'class'=>'kartik\grid\EditableColumn',
			'attribute'=>'condition',
			'editableOptions'=>[
				'header'=>'Условие (посетил или нет)',
				'inputType'=>\kartik\editable\Editable::INPUT_SELECT2,
				'formOptions' => ['action' => ['edit-condition-visit-location']],
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
					return [$action.'-visit-location'];
			},
			'buttons' =>[
				'delete' => function ($url, $model, $key) {
					return Html::button('<span class="glyphicon glyphicon-trash"></span>', 
							[
								'class' => 'btn btn-default' . ' condition-delete-button', 
								'data' => ['gridview' => 'condition-visit-location-gridview', 'url' => $url, 'id' => $key],
								'on' => 'deleteButtonClick(event)'
							]);
				}
			],
			'template'=>'{delete}'
		],
	];
	$conditionVisitLocationDataProvider = new ActiveDataProvider([
		'query' => ConditionVisitLocation::find()->where(['sceneButtonId' => $model->sceneButtonId]),
	]);
	echo GridView::widget([
		'dataProvider'=> $conditionVisitLocationDataProvider,
		'columns' => $conditionVisitLocationGridColumns,
		'id' => 'condition-visit-location-gridview',
		'pjax'=>true,
		'pjaxSettings'=>[
			'neverTimeout'=>true,
		]
	]);
?>

<!-- Conditions Load Scene -->

<h2><?= Html::encode("Загружена сцена") ?></h2>

<div class="scene-form">
	<?php 
		$modelConditionsLoadScene = new ConditionLoadScene();
		$modelConditionsLoadScene->sceneButtonId = $model->sceneButtonId;

		$form = ActiveForm::begin([
			'id' => 'conditions-load-scene-form',
			'action' => 'add-conditions-load-scene',
			'options' => ['data' => ['gridview' => 'condition-load-scene-gridview']]
		]);

		echo Html::activeHiddenInput($modelConditionsLoadScene, 'sceneButtonId');
		
		echo '<label class="control-label">' . Yii::t('app', 'Локация') . '</label>';
		echo Select2::widget([
			'name' => 'loaction-select',
			'data' => ArrayHelper::map(Location::find()->where(['screenplayId' => $model->scene->location->screenplayId])->all(), 'locationId', 'name'),
			'options' => [
				'id'=>'location-id',
				'placeholder' => Yii::t('app', 'Выберите локацию')
			],
			'pluginOptions' => [
				'allowClear' => true,
			],
		]);

		echo Html::hiddenInput('input-sceneId', $modelConditionsLoadScene->sceneId, ['id'=>'input-sceneId']);
		echo Html::hiddenInput('input-locationId', isset($modelConditionsLoadScene->scene->locationId) ? $modelConditionsLoadScene->scene->locationId : NULL, ['id'=>'input-locationId']);

		// Child # 1
		echo $form->field($modelConditionsLoadScene, 'sceneId')->widget(DepDrop::classname(), [
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
				'params'=>['input-sceneId', 'input-locationId']
			]
		])->label(Yii::t('app', 'Сцена'));
			
//		echo $form->field($modelConditionsLoadScene, 'sceneId')->widget(Select2::classname(), [
//			'data' => ArrayHelper::map(Scene::find()->where(['locationId' => $model->scene->locationId])->all(), 'sceneId', 'name'),
//			'options' => [
//				'placeholder' => Yii::t('app', 'Выберите сцену ...')
//			]
//		])->label('Сцена');

		echo $form->field($modelConditionsLoadScene, 'condition')->widget(Select2::classname(), [
			'data' => ['Нет', 'Да'],
			'options' => [
				'placeholder' => Yii::t('app', 'Выберите условие ...')
			]
		])->label('Условие (загружена или нет)');
	?>

	<div class="form-group">
		<?= Html::buttonInput(Yii::t('app', 'Create'), ['class' => ($model->isNewRecord ? 'btn btn-success' : 'btn btn-primary') . ' condition-save-button']) ?>
	</div>

	<?php ActiveForm::end(); ?>
</div>



<?php
	$conditionLoadSceneGridColumns = [
		[
			'attribute'=>'conditionLoadSceneId',
			'width'=>'100px',
		],
		[
			'class'=>'kartik\grid\EditableColumn',
			'attribute'=>'sceneId',
			'editableOptions'=>[
				'header'=>'Сцена',
				'inputType'=>\kartik\editable\Editable::INPUT_SELECT2,
				'formOptions' => ['action' => ['edit-condition-load-scene']],
				'options' => [
					'data' => ArrayHelper::map(Scene::find()->where(['locationId' => $model->scene->locationId])->all(), 'sceneId', 'name'),
				],
			],
			'value' => function($model){
				return isset($model->scene) ? $model->scene->name : null;
			},
			'refreshGrid' => true,
			'format'=>'text'
		],
		[
			'class'=>'kartik\grid\EditableColumn',
			'attribute'=>'condition',
			'editableOptions'=>[
				'header'=>'Условие (посетил или нет)',
				'inputType'=>\kartik\editable\Editable::INPUT_SELECT2,
				'formOptions' => ['action' => ['edit-condition-load-scene']],
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
					return [$action.'-load-scene'];
			},
			'buttons' =>[
				'delete' => function ($url, $model, $key) {
					return Html::button('<span class="glyphicon glyphicon-trash"></span>', 
							[
								'class' => 'btn btn-default' . ' condition-delete-button', 
								'data' => ['gridview' => 'condition-load-scene-gridview', 'url' => $url, 'id' => $key],
								'onclick' => 'deleteButtonClick(event)'
							]);
				}
			],
			'template'=>'{delete}'
		],
	];
	$conditionLoadSceneDataProvider = new ActiveDataProvider([
		'query' => ConditionLoadScene::find()->where(['sceneButtonId' => $model->sceneButtonId]),
	]);
	echo GridView::widget([
		'dataProvider'=> $conditionLoadSceneDataProvider,
		'columns' => $conditionLoadSceneGridColumns,
		'id' => 'condition-load-scene-gridview',
		'pjax'=>true,
		'pjaxSettings'=>[
			'neverTimeout'=>true,
		]
	]);
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
			'name' => 'loaction-select-2',
			'data' => ArrayHelper::map(Location::find()->where(['screenplayId' => $model->scene->location->screenplayId])->all(), 'locationId', 'name'),
			'options' => [
				'id'=>'location-id-2',
				'placeholder' => Yii::t('app', 'Выберите локацию')
			],
			'pluginOptions' => [
				'allowClear' => true,
			],
		]);

		echo Html::hiddenInput('input-verifiableSceneButtonId', $modelConditionsPressedButton->verifiableSceneButtonId, ['id'=>'input-verifiableSceneButtonId']);
		echo Html::hiddenInput('input-sceneId-2', isset($modelConditionsPressedButton->verifiableSceneButton->sceneId) ? $modelConditionsPressedButton->verifiableSceneButton->sceneId : NULL, ['id'=>'input-sceneId-2']);
		echo Html::hiddenInput('input-locationId-2', isset($modelConditionsPressedButton->verifiableSceneButton->scene->locationId) ? $modelConditionsPressedButton->verifiableSceneButton->scene->locationId : NULL, ['id'=>'input-locationId-2']);

		// Child # 1
		echo '<label class="control-label">' . Yii::t('app', 'Сцена') . '</label>';
		echo DepDrop::widget([
			'name' => 'scene-select',
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
				'depends'=>['location-id-2'],
				'url'=>Url::to(['/scenes/scenes']),
				'loadingText' => Yii::t('app', 'загружаем список сцен ...'),
				'params'=>['input-sceneId-2', 'input-locationId-2']
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
				'depends'=>['scene-id'],
				'url'=>Url::to(['/scene-buttons/scene-buttons']),
				'loadingText' => Yii::t('app', 'загружаем список кнопок ...'),
				'params'=>['input-verifiableSceneButtonId', 'input-sceneId-2']
			]
		])->label(Yii::t('app', 'Кнопка'));
		
		
//		echo $form->field($modelConditionsPressedButton, 'verifiableSceneButtonId')->widget(Select2::classname(), [
//			'data' => ArrayHelper::map(SceneButton::find()->where(['sceneId' => $model->sceneId])->all(), 'sceneButtonId', 'shortText'),
//			'options' => [
//				'placeholder' => Yii::t('app', 'Выберите кнопку ...')
//			]
//		])->label('Кнопка');

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
			'attribute'=>'conditionPressedButtonId',
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
				'header'=>'Условие (посетил или нет)',
				'inputType'=>\kartik\editable\Editable::INPUT_SELECT2,
				'formOptions' => ['action' => ['edit-condition-load-scene']],
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

