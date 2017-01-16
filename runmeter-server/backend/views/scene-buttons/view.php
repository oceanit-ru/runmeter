<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\components\StringHelper;

/* @var $this yii\web\View */
/* @var $model common\models\db\SceneButton */
$this->title = $model->getShortText();
if (isset($model->scene)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Screenplays'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->scene->location->screenplay->name, 20), 'url' => ['screenplays/view', 'id' => $model->scene->location->screenplayId]];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->scene->location->name, 20), 'url' => ['locations/view', 'id' => $model->scene->locationId]];
	$this->params['breadcrumbs'][] = ['label' => StringHelper::truncate($model->scene->name, 20), 'url' => ['scenes/view', 'id' => $model->sceneId]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scene-button-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Редактировать'), ['update', 'id' => $model->sceneButtonId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Удалить'), ['delete', 'id' => $model->sceneButtonId], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Вы точно хотите удалить этот элемент?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'sceneButtonId',
            [
				'attribute' => 'sceneId',
				'value' => $model->scene->name
			],
            'text',
			[
				'attribute' => 'action',
				'value' => $model->getActionAsString()
			],
            'answer:ntext',
			[
				'attribute' => 'segueLocationId',
				'value' => $model->segueLocation->name
			],
			[
				'attribute' => 'segueSceneId',
				'value' => $model->segueScene->name
			],
            'cost',
            'createdAt',
            'updateAt',
        ],
    ]) ?>
	
	<h1><?= Html::encode("Условия видимости") ?></h1>
	<?=	
			$this->render('_condition-editor', ['model' => $model]);
	?>
	
	<script type="text/javascript">
		var _csrf = '<?=Yii::$app->request->getCsrfToken()?>';
		$(document).ready(function () {
			$('.condition-save-button').click(function() {
				var form = $(this).parents('form:first');
				// return false if form still have some validation errors
				if (form.find('.has-error').length) 
				{
					return false;
				}
				// submit form
				$.ajax({
					url    : form.attr('action'),
					type   : 'post',
					data   : form.serialize(),
					success: function (response) 
					{
						form[0].reset();
						$.pjax.reload({container:'#' + form.data("gridview") + '-pjax'});
					},
					error  : function () 
					{
					}
				});
				return false; // return false to cancel form action
			});
		});
		function deleteButtonClick(event) {
			console.log(event);
			var button = $(event.target);
			if (!button.prev().is('button')) {
				button = button.parents('button:first');
			}
			$.ajax({
				url    : button.data('url') + '?id=' + button.data('id'),
				type   : 'post',
				data   : {'_csrf-backend': _csrf},
				success: function (response) 
				{
					$.pjax.reload({container:'#' + button.data("gridview") + '-pjax'});
				},
				error  : function () 
				{
				}
			});
			return false; // return false to cancel form action
		}
	</script>

</div>
