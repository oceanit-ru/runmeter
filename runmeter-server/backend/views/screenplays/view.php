<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\LocationSearch;
use common\models\db\Location;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use common\components\StringHelper;

/* @var $this yii\web\View */
/* @var $model common\models\db\Screenplay */

$this->title = StringHelper::truncate($model->name, 20);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Screenplays'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="screenplay-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->screenplayId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->screenplayId], [
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
            'screenplayId',
            'name',
            'createdAt',
            'updateAt',
        ],
    ]) ?>
	
	
	<h1><?= Html::encode("Locations") ?></h1>
	
	<p>
        <?= Html::a(Yii::t('app', 'Create Location'), ['locations/create', 'screenplayId' => $model->screenplayId], ['class' => 'btn btn-success']) ?>
    </p>
	<?php 
		$locationSearchModel = new LocationSearch();
        $locationDataProvider = $locationSearchModel->search(Yii::$app->request->queryParams, $model->screenplayId);
	?>
	<?php Pjax::begin(); ?>    <?= GridView::widget([
			'dataProvider' => $locationDataProvider,
			'filterModel' => $locationSearchModel,
			'columns' => [
				['class' => 'yii\grid\SerialColumn'],

				'locationId',
				'screenplayId',
				'name',
				'number',
				'image',
				// 'createdAt',
				// 'updateAt',

				[
					'class' => 'yii\grid\ActionColumn',
					'urlCreator' => function ($action, $model, $key, $index, $this) {
						return Url::toRoute(['locations/' . $action, 'id' => $model->locationId]);
					}
				],
			],
		]); ?>
	<?php Pjax::end(); ?></div>

</div>
