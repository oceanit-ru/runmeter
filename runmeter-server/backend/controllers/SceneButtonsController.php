<?php

namespace backend\controllers;

use Yii;
use common\models\db\SceneButton;
use backend\models\SceneButtonSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\db\ConditionVisitLocation;
use common\models\db\ConditionLoadScene;
use common\models\db\ConditionPressedButton;
use kartik\grid\EditableColumnAction;
use yii\helpers\Json;

/**
 * SceneButtonsController implements the CRUD actions for SceneButton model.
 */
class SceneButtonsController extends Controller
{

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['POST'],
					'edit-condition-visit-location' => [			// identifier for your editable action
						'class' => EditableColumnAction::className(), // action class name
						'modelClass' => ConditionVisitLocation::className(), // the update model class
						'method' => 'POST'
					],
					'add-conditions-visit-location' => ['POST'],
					'delete-visit-vocation' => ['POST'],
					'edit-condition-load-scene' => [			// identifier for your editable action
						'class' => EditableColumnAction::className(), // action class name
						'modelClass' => ConditionLoadScene::className(), // the update model class
						'method' => 'POST'
					],
					'add-conditions-load-scene' => ['POST'],
					'edit-condition-pressed-button' => [			// identifier for your editable action
						'class' => EditableColumnAction::className(), // action class name
						'modelClass' => ConditionPressedButton::className(), // the update model class
						'method' => 'POST'
					],
					'add-conditions-pressed-button' => ['POST']
				],
			],
		];
	}

	/**
	 * Lists all SceneButton models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new SceneButtonSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
					'searchModel' => $searchModel,
					'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single SceneButton model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
					'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new SceneButton model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate($sceneId)
	{
		$model = new SceneButton();
		$model->sceneId = $sceneId;

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->sceneButtonId]);
		} else {
			return $this->render('create', [
						'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing SceneButton model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			return $this->redirect(['view', 'id' => $model->sceneButtonId]);
		} else {
			return $this->render('update', [
						'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing SceneButton model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$model = $this->findModel($id);
		$sceneId = $model->sceneId;
		$model->delete();


		return $this->redirect(['scenes/view', 'id' => $sceneId]);
	}

	public function actionEditConditionVisitLocation()
	{
		if (Yii::$app->request->post('hasEditable')) {
			$conditionId = Yii::$app->request->post('editableKey');
			$model = ConditionVisitLocation::findOne($conditionId);
			$out = Json::encode(['output' => '', 'message' => '']);
			$posted = current($_POST['ConditionVisitLocation']);
			$post = ['ConditionVisitLocation' => $posted];
			if ($model->load($post)) {
				$model->save();
				$output = '';
				$out = Json::encode(['output' => $output, 'message' => '']);
			}
			// return ajax json encoded response and exit
			echo $out;
			return;
		}
	}

	public function actionAddConditionsVisitLocation()
	{
		$model = new ConditionVisitLocation();
		$model->load(Yii::$app->request->post());
		$model->save();
		return;
	}

	public function actionDeleteVisitLocation($id)
	{
		$model = ConditionVisitLocation::findOne($id);
		if ($model !== null) {
			$model->delete();
		}
		return;
	}

	public function actionEditConditionLoadScene()
	{
		if (Yii::$app->request->post('hasEditable')) {
			$conditionId = Yii::$app->request->post('editableKey');
			$model = ConditionLoadScene::findOne($conditionId);
			$out = Json::encode(['output' => '', 'message' => '']);
			$posted = current($_POST['ConditionLoadScene']);
			$post = ['ConditionLoadScene' => $posted];
			if ($model->load($post)) {
				$model->save();
				$output = '';
				$out = Json::encode(['output' => $output, 'message' => '']);
			}
			// return ajax json encoded response and exit
			echo $out;
			return;
		}
	}

	public function actionAddConditionsLoadScene()
	{
		$model = new ConditionLoadScene();
		$model->load(Yii::$app->request->post());
		$model->save();
		return;
	}

	public function actionDeleteLoadScene($id)
	{
		$model = ConditionLoadScene::findOne($id);
		if ($model !== null) {
			$model->delete();
		}
		return;
	}

	public function actionEditConditionPressedButton()
	{
		if (Yii::$app->request->post('hasEditable')) {
			$conditionId = Yii::$app->request->post('editableKey');
			$model = ConditionPressedButton::findOne($conditionId);
			$out = Json::encode(['output' => '', 'message' => '']);
			$posted = current($_POST['ConditionPressedButton']);
			$post = ['ConditionPressedButton' => $posted];
			if ($model->load($post)) {
				$model->save();
				$output = '';
				$out = Json::encode(['output' => $output, 'message' => '']);
			}
			// return ajax json encoded response and exit
			echo $out;
			return;
		}
	}

	public function actionAddConditionsPressedButton()
	{
		$model = new ConditionPressedButton();
		$model->load(Yii::$app->request->post());
		$model->save();
		return;
	}

	public function actionDeletePressedButton($id)
	{
		$model = ConditionsPressedButton::findOne($id);
		if ($model !== null) {
			$model->delete();
		}
		return;
	}

	/**
	 * Finds the SceneButton model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return SceneButton the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = SceneButton::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

}
