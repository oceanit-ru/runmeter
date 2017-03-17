<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\SceneButtonSearch;
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\grid\EditableColumn;
use common\components\StringHelper;
use common\models\db\SceneButton;

/* @var $this yii\web\View */
/* @var $model common\models\db\Scene */

$this->title = StringHelper::truncate($model->name, 20);
if (isset($model->location)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Screenplays'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->location->screenplay->name, 20), 'url' => ['screenplays/view', 'id' => $model->location->screenplayId]];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->location->name, 20), 'url' => ['locations/view', 'id' => $model->locationId]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scene-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->sceneId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->sceneId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы действительно хотите удалить сцену?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sceneId',
            [
				'attribute' =>'locationId',
				'value' => $model->location->name
			],
            'name',
			[
                'attribute'=>'image',
				'value'=>$model->getThumbUrl(),
				'format' => ['image']
            ],
            'number',
            'displayedButtonCount',
            'createdAt',
            'updateAt',
        ],
    ]) ?>
	<?php 
		$searchModel = new SceneButtonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model->sceneId);
		$dataProvider->sort = ['defaultOrder' => ['number'=>SORT_ASC]];
	?>
	<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
		'pjax'=>true,
		'pjaxSettings'=>[
			'neverTimeout'=>true,
		],
		'panel' => [
			'heading'=>'<h3 class="panel-title">Кнопки</h3>',
			'type'=>'info',
			'before'=>Html::a('<i class="glyphicon glyphicon-plus"></i> Создать кнопку', ['scene-buttons/create', 'sceneId' => $model->sceneId], ['class' => 'btn btn-success']),
			'after'=>Html::a('<i class="glyphicon glyphicon-repeat"></i> Обновить', ['index'], ['class' => 'btn btn-info']),
			'footer'=>false
		],
		'toolbar' => [
            'content' => "Убедитесь что порядковые номера не совпадают и раставленны в нужном порядке. Поменять их можно прямо в таблице."
		],
        'columns' => [
			[
				'class'=>'kartik\grid\EditableColumn',
				'attribute'=>'number',
				'editableOptions'=>[
					'header'=>'Порядковый номер',
					'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
					'formOptions' => ['action' => ['edit-scene-button']],
				],
				'refreshGrid' => true,
			],
            'sceneButtonId',
            [
				'attribute' => 'text',
				'headerOptions' => ['style' => 'width:30%'],
				'format' => 'ntext'
			],
            [
				'attribute' => 'action',
				'value' => function($model) {
					return $model->getActionAsString();
				}
			],	
			[
				'attribute' => 'answer',
				'headerOptions' => ['style' => 'width:20%'],
				'format' => 'ntext'
			],
			[
				'attribute' => 'segueLocationId',
				'headerOptions' => ['style' => 'width:20%'],
				'value' => function($model) {
					/* @var $model SceneButton */
					$value = '';
					if (isset($model->showTextButton)) {
						$value = ' => ' . Html::a($model->showTextButton->getShortText(), Url::toRoute(['scene-buttons/view?id=' . $model->showTextButtonId])) ;
					} 
					if (isset($model->segueSceneId)) {
						$value = ' => ' . Html::a($model->segueScene->name, Url::toRoute(['scenes/view?id=' . $model->segueSceneId])) . $value;
					}
					if (isset($model->segueLocation)) {
						$value = Html::a($model->segueLocation->name, Url::toRoute(['locations/view?id=' . $model->segueLocationId])) . $value;
					} else {
						$value = 'Нет перехода';
					}
					return $value;
				},
				'format' => 'raw',
				'label' => 'Переход'
			],
            'cost',
            [
				'class' => 'yii\grid\ActionColumn',
				'urlCreator' => function ($action, $model, $key, $index, $this) {
					return Url::toRoute(['scene-buttons/' . $action, 'id' => $model->sceneButtonId]);
				}
			],
        ],
    ]); ?>
	
	

</div>
