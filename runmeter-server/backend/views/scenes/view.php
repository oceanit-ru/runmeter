<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\SceneButtonSearch;
use yii\helpers\Url;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model common\models\db\Scene */

$this->title = $model->name;
if (isset($model->location)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Screenplays'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => $model->location->screenplay->name, 'url' => ['screenplays/view', 'id' => $model->location->screenplayId]];
	$this->params['breadcrumbs'][] = ['label' => $model->location->name, 'url' => ['locations/view', 'id' => $model->locationId]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scene-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->sceneId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->sceneId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sceneId',
            'locationId',
            'name',
            'number',
            'displayedButtonCount',
            'createdAt',
            'updateAt',
        ],
    ]) ?>
	
	<h1><?= Html::encode("Scene Buttons") ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Scene Button'), ['scene-buttons/create', 'sceneId' => $model->sceneId], ['class' => 'btn btn-success']) ?>
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
            'sceneId',
            'text',
            'action',
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
