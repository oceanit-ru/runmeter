<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ScreenplaySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Сценарии');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="screenplay-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Создать сценарий'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'screenplayId',
            'name',
            'createdAt',
            'updateAt',
			[
				'class' => 'kartik\grid\ActionColumn',
				'dropdown' => false,
				'vAlign'=>'middle',
				'urlCreator' => function($action, $model, $key, $index) { 
						return [$action];
				},
				'buttons' =>[
					'update-at' => function ($url, $model, $key) {
						return Html::a('<span class="glyphicon glyphicon-refresh"></span>', ['update-at', 'id' => $model->screenplayId]);
					}
				],
				'template'=>'{update-at}'
			],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
