<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\SceneSearch;
use yii\helpers\Url;
use common\models\db\Scene;
use yii\widgets\Pjax;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\db\Location */

$this->title = $model->name;
if (isset($model->screenplay)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Screenplays'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => $model->screenplay->name, 'url' => ['screenplays/view', 'id' => $model->screenplayId]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->locationId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->locationId], [
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
            'locationId',
            'screenplayId',
            'name',
            'number',
            'image',
            'createdAt',
            'updateAt',
        ],
    ]) ?>
	
	<h1><?= Html::encode("Scenes") ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Scene'), ['scenes/create', 'locationId' => $model->locationId], ['class' => 'btn btn-success']) ?>
    </p>
	<?php 
		$sceneSearchModel = new SceneSearch();
        $sceneDataProvider = $sceneSearchModel->search(Yii::$app->request->queryParams, $model->locationId);
	?>
	<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $sceneDataProvider,
        'filterModel' => $sceneSearchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'sceneId',
            'locationId',
            'name',
            'number',
            'displayedButtonCount',
            // 'createdAt',
            // 'updateAt',

            [
				'class' => 'yii\grid\ActionColumn',
				'urlCreator' => function ($action, $model, $key, $index, $this) {
					return Url::toRoute(['scenes/' . $action, 'id' => $model->sceneId]);
				}
			],
        ],
    ]); ?>

</div>
