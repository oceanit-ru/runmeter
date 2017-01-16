<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\models\SceneSearch;
use yii\helpers\Url;
use common\models\db\Scene;
use yii\widgets\Pjax;
use yii\grid\GridView;
use common\components\StringHelper;

/* @var $this yii\web\View */
/* @var $model common\models\db\Location */

$this->title = StringHelper::truncate($model->name, 20);
if (isset($model->screenplay)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Сценарии'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->screenplay->name, 20), 'url' => ['screenplays/view', 'id' => $model->screenplayId]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="location-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->locationId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->locationId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы действительно хотите удалить локацию?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'locationId',
			[
				'attribute' => 'screenplay',
				'value' => $model->screenplay->name
			],
            'name',
            'number',
			[
                'attribute'=>'image',
				'value'=>$model->getThumbUrl(),
				'format' => ['image']
            ],
            'createdAt',
            'updateAt',
        ],
    ]) ?>
	
	<h1><?= Html::encode("Сцены") ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать сцену'), ['scenes/create', 'locationId' => $model->locationId], ['class' => 'btn btn-success']) ?>
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
