<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\SceneButtonSearch;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;
use common\components\StringHelper;

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
            'number',
            'displayedButtonCount',
            'createdAt',
            'updateAt',
        ],
    ]) ?>
	
	<h1><?= Html::encode("Кнопки") ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать кнопку'), ['scene-buttons/create', 'sceneId' => $model->sceneId], ['class' => 'btn btn-success']) ?>
    </p>
	<?php 
		$searchModel = new SceneButtonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $model->sceneId);
	?>
	<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sceneButtonId',
            'text',
            [
				'attribute' => 'action',
				'value' => function($model) {
					return $model->getActionAsString();
				}
			],
            'answer:ntext',
            // 'segueLocationId',
            // 'segueSceneId',
            'cost',
            // 'createdAt',
            // 'updateAt',

            [
				'class' => 'yii\grid\ActionColumn',
				'urlCreator' => function ($action, $model, $key, $index, $this) {
					return Url::toRoute(['scene-buttons/' . $action, 'id' => $model->sceneButtonId]);
				}
			],
        ],
    ]); ?>
	
	

</div>
