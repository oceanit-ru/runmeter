<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
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
use yii\web\JsExpression;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\db\SceneButton */
$this->title = $model->sceneButtonId;
if (isset($model->scene)) {
	$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Screenplays'), 'url' => ['screenplays/index']];
	$this->params['breadcrumbs'][] = ['label' => $model->scene->location->screenplay->name, 'url' => ['screenplays/view', 'id' => $model->scene->location->screenplayId]];
	$this->params['breadcrumbs'][] = ['label' => $model->scene->location->name, 'url' => ['locations/view', 'id' => $model->scene->locationId]];
	$this->params['breadcrumbs'][] = ['label' => $model->scene->name, 'url' => ['scenes/view', 'id' => $model->sceneId]];
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="scene-button-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->sceneButtonId], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->sceneButtonId], [
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
            'sceneButtonId',
            'sceneId',
            'text',
            'action',
            'answer:ntext',
            'segueLocationId',
            'segueSceneId',
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
